// let regularFilter = '';
// let responsiveFilter = ''; // aqui esta guardado

// function handleResponsiveFilter() {
//     const screenWidth = window.innerWidth;
//     if (screenWidth <= 880) {
//         if( document.getElementById('classify-regular').innerText != "" ) {
//             console.log('entro')
//             responsiveFilter = document.getElementById('classify-regular').innerHTML;
//             console.log(responsiveFilter)
//             document.getElementById('filter__responsive--section').innerHTML = responsiveFilter;
//             document.getElementById('classify-regular').innerHTML = "";
//             getName('anio')
//             getName('area')
//             getName('category')
//             getName('subcategory')
//             getName('type')
//             getName('subtype')
//         }
//     } else {
//         if( document.getElementById('filter__responsive--section').innerText != "" ) {  
//             console.log('entro') 
//             regularFilter = document.getElementById('filter__responsive--section').innerHTML;
//             document.getElementById('classify-regular').innerHTML = regularFilter;
//             document.getElementById('filter__responsive--section').innerHTML = "";
//             getName('anio')
//             getName('area')
//             getName('category')
//             getName('subcategory')
//             getName('type')
//             getName('subtype')
//         }
//     } 
// }

function firstResponsiveFilter() {
    const screenWidth = window.innerWidth;
    if( screenWidth <= 880) {
        //regularFilter = document.getElementById('classify-regular').innerHTML;
        document.getElementById('classify-regular').innerHTML = "";
    } else if ( screenWidth > 880) {
        //responsiveFilter = document.getElementById('filter__responsive').innerHTML;
        document.getElementById('filter__responsive--section').innerHTML = "";
    }
}

// Agregar el evento de cambio de tamaño de pantalla
// window.addEventListener("resize", handleResponsiveFilter);

firstResponsiveFilter();


const url = new URL(window.location.href);
// Obtener el valor de "error" de la URL
const cdc = url.searchParams.get("cdc");
const type = url.searchParams.get("type");
// document.getElementById('classify-regular').style.display = 'flex'

const Category = document.getElementById("category");
const Subcategory = document.getElementById("subcategory");
const Type = document.getElementById("type");
const Subtype = document.getElementById("subtype");
const loader1 = document.getElementsByClassName("loaderText")[0];
const loader2 = document.getElementsByClassName("loaderText")[1];
const loaders = document.getElementById("loadersMedia");

Subcategory.style.display = "none";
Type.style.display = "none";
Subtype.style.display = "none";
loader1.style.display = "none";
loader2.style.display = "none";
loaders.style.display = "none";




// let categories = '';
// let categoriesShort = '';
// let subcategories = '';
// let subcategoriesShort = '';
// let types = '';
// let typesShort = '';
// let subtypes = '';
// let subtypesShort = '';


if (cdc != null) {
    const cdcTitle = "CDC " + (cdc.charAt(0).toUpperCase() + cdc.slice(1));
    document.getElementById("title-mobile").innerText = cdcTitle;
    document.getElementById("title-desktop").innerText = cdcTitle;
} else if (type != null) {
    const typeTitle = (type.charAt(0).toUpperCase() + type.slice(1));
    Category.style.display = "none";
    document.getElementById("title-mobile").innerText = typeTitle;
    document.getElementById("title-desktop").innerText = typeTitle;
}


let info = {
    year: "",
    area: "",
    category: "",
    subcategory: "",
    type: "",
    subtype: "",
}

let value = {...info}



function getSelectedOption(category) {
    var options = document.getElementsByName(category);
    for (var i = 0; i < options.length; i++) {
        if (options[i].checked) {
            return options[i].id;
        }
    }
    return null;
}

document.getElementById('filter').addEventListener('change', function() {
    const anio = getSelectedOption('anio');
    const area = getSelectedOption('area');
    const category = getSelectedOption('category');
    const subcategory = getSelectedOption('subcategory');
    const type = getSelectedOption('type');
    const subtype = getSelectedOption('subtype');
    
    var filtro = {
        anio,
        area,
        category,
        subcategory,
        type,
        subtype
    };

    for(let f in filtro) {
        if(filtro[f] != null) {
            if (url.searchParams.get(f) == null) {
                url.searchParams.append(f, filtro[f]);
            } else {
                url.searchParams.set(f, filtro[f]);
            }
            window.history.replaceState({}, '', url);

        }
    }

});

/////

function makeTemplate(data, name) {
    let template = '';
    let templateShort = '';
    data.forEach(e => {
        template += /*html*/`
            <div class="category__option">
                <input type="radio" name="${name}" id="${e.id}${e.name}" class="${e.id}">
                <label for="${e.id}${e.name}">${e.name}</label>
                <span>${e.total}</span>
            </div>
        `;
    });
    if( name == "category") {
        categories = template;
    } else if (name == "subcategory") {
        subcategories = template;
    } else if (name == "type") {
        types = template;
    } else if (name == "subtype") {
        subtypes = template;
    }
    if (data.length > 6) {
        for (let i = 0; i < 6; i++) {
            templateShort += /*html*/`
                <div class="category__option">
                    <input type="radio" name="${name}" id="${data[i].id}${data[i].name}" class="${data[i].id}">
                    <label for="${data[i].id}${data[i].name}">${data[i].name}</label>
                    <span>${data[i].total}</span>
                </div>
            `;
        }
        try {
            document.getElementById('see-more-' + name).style.display = "flex";
        } catch (error) {}
        if( name == "category") {
            categoriesShort = templateShort;
        } else if (name == "subcategory") {
            subcategoriesShort = templateShort;
        } else if (name == "type") {
            typesShort = templateShort;
        } else if (name == "subtype") {
            subtypesShort = templateShort;
        }
        return templateShort;
    } else  {
        try {
            document.getElementById('see-more-' + name).style.display = "none";
        } catch (error) {}
    }
    return template;
}

function selectDefault(name) {
    // Obtener el contenedor de la categoría
    let categoryContainer = document.querySelector('#category-' + name);

    // Obtener todos los labels dentro del contenedor de la categoría
    let labels = categoryContainer.querySelectorAll('.category__option label');

    // Recorrer los labels y buscar el que coincide con el valor del año
    labels.forEach(label => {
        if (label.textContent === value[name]) {
            let input = label.previousElementSibling;
            if (input) {
                input.checked = true;
            }
        }
    });
}

async function updateFilter(data, name) {
    data.cdc = cdc;
    data.typeE = type;
    const response = await fetch(`./backend/filter/filter-update.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    const result = await response.json();

    // if theres something selected in the years section of the filter
    if(value.year != "" && value.area == "" && value.category == "" && value.subcategory == "" && value.type == "" && value.subtype == "") { 
        let templateY = makeTemplate(result['years'], "anio");
        document.getElementById('category-year').innerHTML = templateY;
        getName("anio");
    
        selectDefault("year");
    
        let templateA = makeTemplate(result['areas'], "area");
        document.getElementById('category-area').innerHTML = templateA;
        getName("area");
    
        selectDefault("area");
    
        let templateC = makeTemplate(result['categories'], "category");
        document.getElementById('category-category').innerHTML = templateC;
        getName("category");
    
        selectDefault("category");
    } else if(value.year != "" && value.area != "" && value.category == "" && value.subcategory == "" && value.type == "" && value.subtype == "") {
        let templateC = makeTemplate(result['categories'], "category");
        document.getElementById('category-category').innerHTML = templateC;
        getName("category");
    
        selectDefault("category");
    } else if(value.year != "" && value.area != "" && value.category != "" && value.subcategory == "" && value.type == "" && value.subtype == "") {
        let templateS = makeTemplate(result['subcategories'], "subcategory");
        document.getElementById('category-subcategory').innerHTML = templateS;
        getName("subcategory");

        selectDefault("subcategory");
    } else if(value.year != "" && value.area != "" && value.category != "" && value.subcategory != "" && value.type == "" && value.subtype == "") {
        let templateT = makeTemplate(result['types'], "type");
        document.getElementById('category-type').innerHTML = templateT;
        getName("type");

        selectDefault("type");
    } else if(value.year != "" && value.area != "" && value.category != "" && value.subcategory != "" && value.type != "" && value.subtype == "") {
        let templateSt = makeTemplate(result['subtypes'], "subtype");
        document.getElementById('category-subtype').innerHTML = templateSt;
        getName("subtype");

        selectDefault("subtype");
    } else if(value.year == "" && value.area != "" && value.category == "" && value.subcategory == "" && value.type == "" && value.subtype == "") {
        let templateC = makeTemplate(result['categories'], "category");
        document.getElementById('category-category').innerHTML = templateC;
        getName("category");
    
        selectDefault("category");
    } else if(value.year == "" && value.area != "" && value.category != "" && value.subcategory == "" && value.type == "" && value.subtype == "") {
        let templateS = makeTemplate(result['subcategories'], "subcategory");
        document.getElementById('category-subcategory').innerHTML = templateS;
        getName("subcategory");

        selectDefault("subcategory");
    } else if(value.year == "" && value.area != "" && value.category != "" && value.subcategory != "" && value.type == "" && value.subtype == "") {
        let templateT = makeTemplate(result['types'], "type");
        document.getElementById('category-type').innerHTML = templateT;
        getName("type");

        selectDefault("type");
    } else if(value.year == "" && value.area != "" && value.category != "" && value.subcategory != "" && value.type != "" && value.subtype == "") {
        let templateSt = makeTemplate(result['subtypes'], "subtype");
        document.getElementById('category-subtype').innerHTML = templateSt;
        getName("subtype");

        selectDefault("subtype");
    } else if(value.year == "" && value.area != "" && value.category == "" && value.subcategory == "" && value.type == "" && value.subtype == "") {
        let templateC = makeTemplate(result['categories'], "category");
        document.getElementById('category-category').innerHTML = templateC;
        getName("category");
    
        selectDefault("category");
    } else if(value.year == "" && value.area == "" && value.category != "" && value.subcategory == "" && value.type == "" && value.subtype == "") {
        let templateS = makeTemplate(result['subcategories'], "subcategory");
        document.getElementById('category-subcategory').innerHTML = templateS;
        getName("subcategory");

        selectDefault("subcategory");
    } else if(value.year == "" && value.area == "" && value.category != "" && value.subcategory != "" && value.type == "" && value.subtype == "") {
        let templateT = makeTemplate(result['types'], "type");
        document.getElementById('category-type').innerHTML = templateT;
        getName("type");

        selectDefault("type");
    } else if(value.year == "" && value.area == "" && value.category != "" && value.subcategory != "" && value.type != "" && value.subtype == "") {
        let templateSt = makeTemplate(result['subtypes'], "subtype");
        document.getElementById('category-subtype').innerHTML = templateSt;
        getName("subtype");

        selectDefault("subtype");
    }
    if(name == "anio") {
        Subcategory.style.display = "none";
        Type.style.display = "none";
        Subtype.style.display = "none";
    } else if(name == "area") {
        Subcategory.style.display = "none";
        Type.style.display = "none";
        Subtype.style.display = "none";
    } else if(name == "category") {
        if(checkContent("subcategory")) {
            Subcategory.style.display = "flex";
        } else {
            Subcategory.style.display = "none";
        }
        Type.style.display = "none";
        Subtype.style.display = "none";
    } else if(name == "subcategory") {
        if(checkContent("type")) {
            Type.style.display = "flex";
        } else {
            Type.style.display = "none";
        }
        Subtype.style.display = "none";
    } else if(name == "type") {
        if(checkContent("subtype")) {
            Subtype.style.display = "flex";
        } else {
            Subtype.style.display = "none";
        }
    }

    setTimeout(function() {
        document.getElementById("filter").style.display = "flex";
        loader1.style.display = "none";
        loader2.style.display = "none";
    }, 1000);
}

function makeMedia(data) {
    if(data != false ) {
        let template = '';
        photoInfo = data;
        data.forEach(photo => {
            if(photo.type == "1") {
                if(photo.favourite == "1" && (currentUserType == "1" || currentUserType == "2" || currentUserType == "3")) {
                    template += /*html*/`
                    <div class="media__img">
                        <img src="${photo.resource}" alt="" class="trigger" id="${photo.media_id}">
                        <div class="media__img--button">
                            <a href="${photo.resource}" download class="download">
                                <span class="download__img"></span>
                            </a>
                        </div>
                        <span class="favourite" id="favourite${photo.media_id}" style="background-image: url(./img/star.png)" onclick="star(${photo.media_id})"></span>
                    </div>
                    `;
                } else if(photo.favourite == "0" && (currentUserType == "1" || currentUserType == "2" || currentUserType == "3"))  {
                    template += /*html*/`
                    <div class="media__img">
                        <img src="${photo.resource}" alt="" class="trigger" id="${photo.media_id}">
                        <div class="media__img--button">
                            <a href="${photo.resource}" download class="download">
                                <span class="download__img"></span>
                            </a>
                        </div>
                        <span class="favourite" id="favourite${photo.media_id}" style="background-image: url(./img/starWhite.png)" onclick="star(${photo.media_id})"></span>
                    </div>
                    `;
                } else {
                    template += /*html*/`
                    <div class="media__img">
                        <img src="${photo.resource}" alt="" class="trigger" id="${photo.media_id}">
                        <div class="media__img--button">
                            <a href="${photo.resource}" download class="download">
                                <span class="download__img"></span>
                            </a>
                        </div>
                    </div>
                    `;
                }
            } else {
                // aqui vamos a modificar ahorita
                if(photo.favourite == "1" && (currentUserType == "1" || currentUserType == "2" || currentUserType == "3")) {
                    template += /*html*/`
                    <div class="media__img">
                        <video src="${photo.resource}" alt="" class="trigger" id="${photo.media_id}"></video>
                        <div class="media__img--button">
                            <a href="${photo.resource}" download class="download">
                                <span class="download__img"></span>
                            </a>
                        </div>
                        <span class="favourite" id="favourite${photo.media_id}" style="background-image: url(./img/star.png)" onclick="star(${photo.media_id})"></span>
                    </div>
                    `;
                } else if(photo.favourite == "0" && (currentUserType == "1" || currentUserType == "2" || currentUserType == "3"))  {
                    template += /*html*/`
                    <div class="media__img">
                        <video src="${photo.resource}" alt="" class="trigger" id="${photo.media_id}"></video>
                        <div class="media__img--button">
                            <a href="${photo.resource}" download class="download">
                                <span class="download__img"></span>
                            </a>
                        </div>
                        <span class="favourite" id="favourite${photo.media_id}" style="background-image: url(./img/starWhite.png)" onclick="star(${photo.media_id})"></span>
                    </div>
                    `;
                } else {
                    template += /*html*/`
                    <div class="media__img">
                        <video src="${photo.resource}" alt="" class="trigger" id="${photo.media_id}"></video>
                        <div class="media__img--button">
                            <a href="${photo.resource}" download class="download">
                                <span class="download__img"></span>
                            </a>
                        </div>
                    </div>
                    `;
                }
            }
        });


        if (addMedia) {
            const mediaElement = document.getElementById('media');
            mediaElement.innerHTML = addMedia.outerHTML + template;
        } else {
            document.getElementById('media').innerHTML = template;
        }
        function windowOnClick(event) {
            if (event.target === modal) {
                toggleModal();
            }
        }
        for (let trigger of triggers) {
            trigger.addEventListener("click", toggleModal);
        }
        closeButton.addEventListener("click", toggleModal);
        window.addEventListener("click", windowOnClick);
        // make a timer of 1 second to show the media
        setTimeout(function() {
            document.getElementById("media").style.display = "block";
            loaders.style.display = "none";
        }, 1000);

    }
}


async function updateMedia(data) {
    const response = await fetch('./backend/media/media-update.php', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json();
    console.log(result);
    if(result.estatus == "Correcto") {
        makeMedia(result.data)
    } else {
        makeMedia(false)
    }
}


function checkContent(name) {
    const category = document.querySelector('#category-' + name);
    if (category.innerHTML == '') {
        return false;
    } else {
        return true;
    }
}

const getName = (name) => {
    // obtener las categorias
    const type = document.getElementsByName(name);
    // Verificar qué elemento está seleccionado
    for (let i = 0; i < type.length; i++) {
        type[i].addEventListener("click", function() {
            const label = document.querySelector(`label[for="${type[i].id}"]`);
            const clase = type[i].classList.toString();
            if (name == "category") {
                info.category = clase;
                value.category = label.textContent;
                // erase all other values
                info.subcategory = "";
                info.type = "";
                info.subtype = "";
                value.subcategory = "";
                value.type = "";
                value.subtype = "";
            } else if (name == "subcategory") {
                info.subcategory = clase;
                value.subcategory = label.textContent; 
                // erase all other values
                info.type = "";
                info.subtype = "";
                value.type = "";
                value.subtype = "";
            } else if (name == "type") {
                info.type = clase;
                value.type = label.textContent;
                // erase all other values
                info.subtype = "";
                value.subtype = "";
            } else if (name == "subtype") {
                info.subtype = clase;
                value.subtype = label.textContent;
            }  else if (name == "anio") {
                info.year = clase;
                value.year = label.textContent;
                // erase all other values
                info.area = "";
                info.category = "";
                info.subcategory = "";
                info.type = "";
                info.subtype = "";
                value.area = "";
                value.category = "";
                value.subcategory = "";
                value.type = "";
                value.subtype = "";
            }  else if (name == "area") {
                info.area = clase;
                value.area = label.textContent;
                // erase all other values
                info.category = "";
                info.subcategory = "";
                info.type = "";
                info.subtype = "";
                value.category = "";
                value.subcategory = "";
                value.type = "";
                value.subtype = "";
            }

            document.getElementById("filter").style.display = "none";
            document.getElementById("media").style.display = "none";
            loader1.style.display = "flex";
            loader2.style.display = "flex";
            loaders.style.display = "flex";
            updateFilter(info, name);
            updateMedia(info)
        });
    }
}

function listYears() {
    fetch(`./backend/filter/filter-list-year.php?cdc=${cdc}&type=${type}`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0) {
                let template = '';
                data.forEach(year => {
                    template += /*html*/`
                        <div class="category__option">
                            <input type="radio" name="anio" id="${year.id}${year.year}" class="${year.id}">
                            <label for="${year.id}${year.year}">${year.year}</label>
                            <span>${year.total}</span>
                        </div>
                    `;
                });
            document.getElementById('category-year').innerHTML = template;
            }

            getName("anio");
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

listYears();


function listAreas() {
    fetch(`./backend/filter/filter-list-area.php?cdc=${cdc}&type=${type}`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0) {
                let template = '';
                data.forEach(area => {
                    template += /*html*/`
                        <div class="category__option">
                            <input type="radio" name="area" id="${area.id}${area.area}" class="${area.id}">
                            <label for="${area.id}${area.area}">${area.area}</label>
                            <span>${area.total}</span>
                        </div>
                    `;
                });
            document.getElementById('category-area').innerHTML = template;
            }
            getName("area");
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

listAreas();

function listCategories() {
    fetch(`./backend/filter/filter-list-category.php?cdc=${cdc}`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0) {
                let template = '';
                let templateShort = '';
                data.forEach(category => {
                    template += /*html*/`
                        <div class="category__option">
                            <input type="radio" name="category" id="${category.id}${category.category}" class="${category.id}">
                            <label for="${category.id}${category.category}">${category.category}</label>
                            <span>${category.total}</span>
                        </div>
                    `;
                });
                for (let i = 0; i < 6; i++) {
                    templateShort += /*html*/`
                        <div class="category__option">
                            <input type="radio" name="category" id="${data[i].id}${data[i].category}" class="${data[i].id}">
                            <label for="${data[i].id}${data[i].category}">${data[i].category}</label>
                            <span>${data[i].total}</span>
                        </div>
                    `;
                }
                // aqui tiene que ir
                document.getElementById('category-category').innerHTML = templateShort;
                categories = template;
                categoriesShort = templateShort;
            }
            getName("category");
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

if (cdc != null) { 
    listCategories();
}

function listSubCategories() {
    fetch(`./backend/filter/filter-list-subcategory.php?cdc=${cdc}`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0) {
                let template = '';
                let templateShort = '';
                data.forEach(category => {
                    template += /*html*/`
                        <div class="category__option">
                            <input type="radio" name="subcategory" id="${category.id}${category.category}" class="${category.id}">
                            <label for="${category.id}${category.category}">${category.category}</label>
                            <span>${category.total}</span>
                        </div>
                    `;
                });
                for (let i = 0; i < 6; i++) {
                    templateShort += /*html*/`
                        <div class="category__option">
                            <input type="radio" name="subcategory" id="${data[i].id}${data[i].category}" class="${data[i].id}">
                            <label for="${data[i].id}${data[i].category}">${data[i].category}</label>
                            <span>${data[i].total}</span>
                        </div>
                    `;
                }
                // aqui tiene que ir
                document.getElementById('category-subcategory').innerHTML = templateShort;
                subcategories = template;
                subcategoriesShort = templateShort;
            }
            getName("subcategory");
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

// listSubCategories();

function listTypes() {
    fetch(`./backend/filter/filter-list-type.php?cdc=${cdc}`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0) {
                let template = '';
                let templateShort = '';
                data.forEach(type => {
                    template += /*html*/`
                        <div class="category__option">
                            <input type="radio" name="type" id="${type.id}${type.type}" class="${type.id}">
                            <label for="${type.id}${type.type}">${type.type}</label>
                            <span>${type.total}</span>
                        </div>
                    `;
                });
                for (let i = 0; i < 6; i++) {
                    templateShort += /*html*/`
                        <div class="category__option">
                            <input type="radio" name="type" id="${data[i].id}${data[i].type}" class="${data[i].id}">
                            <label for="${data[i].id}${data[i].type}">${data[i].type}</label>
                            <span>${data[i].total}</span>
                        </div>
                    `;
                }
                // aqui tiene que ir
                document.getElementById('category-type').innerHTML = templateShort;
                types = template;
                typesShort = templateShort;
            }
            getName("type");
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

// listTypes();

function listSubTypes() {
    fetch(`./backend/filter/filter-list-subtype.php?cdc=${cdc}`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0) {
                let template = '';
                let templateShort = '';
                data.forEach(type => {
                    template += /*html*/`
                        <div class="category__option">
                            <input type="radio" name="subtype" id="${type.id}${type.subtype}2" class="${type.id}">
                            <label for="${type.id}${type.subtype}2">${type.subtype}</label>
                            <span>${type.total}</span>
                        </div>
                    `;
                });
                for (let i = 0; i < 6; i++) {
                    templateShort += /*html*/`
                        <div class="category__option">
                            <input type="radio" name="subtype" id="${data[i].id}${data[i].subtype}2" class="${data[i].id}">
                            <label for="${data[i].id}${data[i].subtype}2">${data[i].subtype}</label>
                            <span>${data[i].total}</span>
                        </div>
                    `;
                }
                // aqui tiene que ir
                document.getElementById('category-subtype').innerHTML = templateShort;
                subtypes = template;
                subtypesShort = templateShort;
            }
            getName("subtype");
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

// listSubTypes();


function changeCategory(type) {
    const text = document.getElementById(`see-more-${type}-text`);
    const arrow = document.getElementById(`see-more-img-${type}`);
    let variable;
    let variableShort;
    let selectedValue = "";
    if (type == 'category') {
        variable = categories;
        variableShort = categoriesShort;
        selectedValue = document.querySelector('#category-category input[type="radio"]:checked')?.value || "";
    } else if (type == 'subcategory') {
        variable = subcategories;
        variableShort = subcategoriesShort;
    } else if (type == 'type') {
        variable = types;
        variableShort = typesShort;
    } else if (type == 'subtype') {
        variable = subtypes;
        variableShort = subtypesShort;
    }


    if (text.innerText == 'Ver más') {
        text.innerText = 'Ver menos';
        document.getElementById(`category-${type}`).innerHTML = variable;
        if (window.innerWidth <= 880) { 
            arrow.style.backgroundImage = 'url(./img/up-arrowW.png)';
        } else {
            arrow.style.backgroundImage = 'url(./img/up-arrow.png)';
        }
        getName(type);
        selectDefault(type);
        
    } else {
        text.innerText = 'Ver más';
        document.getElementById(`category-${type}`).innerHTML = variableShort;
        if (window.innerWidth <= 880) { 
            arrow.style.backgroundImage = 'url(./img/down-arrowW.png)';
        } else {
            arrow.style.backgroundImage = 'url(./img/down-arrow.png)';
        }
        getName(type);
        selectDefault(type);
    }
}




////