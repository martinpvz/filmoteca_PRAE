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

Subcategory.style.display = "none";
Type.style.display = "none";
Subtype.style.display = "none";
loader1.style.display = "none";
loader2.style.display = "none";



let categories = '';
let categoriesShort = '';
let subcategories = '';
let subcategoriesShort = '';
let types = '';
let typesShort = '';
let subtypes = '';
let subtypesShort = '';


if (cdc != null) {
    console.log(cdc);
    const cdcTitle = "CDC " + (cdc.charAt(0).toUpperCase() + cdc.slice(1));
    document.getElementById("title-mobile").innerText = cdcTitle;
    document.getElementById("title-desktop").innerText = cdcTitle;
} else if (type != null) {
    console.log(type);
    const typeTitle = (type.charAt(0).toUpperCase() + type.slice(1));
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


///////////// ------------------------ FILTROS ------------------------ //////////////

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
        console.log(templateShort);
        console.log(template);
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
    console.log(data)
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
    console.log(name)
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
    const rute = document.getElementById("rute");
    let text = ""
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
            text = "";
            for (let v in value) {
                if(value[v] != "") {
                    text += value[v] + "/";
                }
            }
            // rute.value = " " + label.textContent + " ";
            rute.value = text;
            console.log(value)
            document.getElementById("filter").style.display = "none";
            loader1.style.display = "flex";
            loader2.style.display = "flex";
            updateFilter(info, name);
        });
    }
}

function listYears() {
    fetch(`./backend/filter/filter-list-year.php?cdc=${cdc}`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0) {
                console.log(data)
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
    fetch(`./backend/filter/filter-list-area.php?cdc=${cdc}`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0) {
                console.log(data)
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
                console.log(data)
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

listCategories();

function listSubCategories() {
    fetch(`./backend/filter/filter-list-subcategory.php?cdc=${cdc}`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0) {
                console.log(data)
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
                console.log(data)
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
                console.log(data)
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
//////////////// ------------------------------------ ////////////////////////






// SHOW MENU ON ALMOST ALL PAGES
function mostrarMenu() {
    document.getElementById('options').style.display = 'block'
    document.body.style.overflow = "hidden";
}

// QUIT MENU AND SHOW REGULAR PAGE IN ALMOST ALL PAGES
function mostrarPantalla() {
    document.getElementById('options').style.display = 'none'
    document.body.style.overflow = "auto";
}

// SHOW FILTERS, IT DISABLES THE MAIN AND THE FOOTER AND SHOWS THE FILTER
function mostrarFiltros() {
    document.getElementById('main__media').style.display = 'none'
    document.getElementById('footer__media').style.display = 'none'
    document.getElementById('filter__responsive').style.display = 'block'
    window.scrollTo(0, 0);
}

// SHOW MEDIA WHEN DE X BUTTON OF THE FILTER IS PUSHED
function mostrarMedia() {
    document.getElementById('main__media').style.display = 'flex'
    document.getElementById('footer__media').style.display = 'block'
    document.getElementById('filter__responsive').style.display = 'none'
    document.querySelector('.body__add').style.backgroundColor = '#F4F4F4';
    window.scrollTo(0, 0);
}
function toggleFilter() {
    if (window.innerWidth <= 880) {
    document.getElementById('main__media').style.display = 'none'
    document.getElementById('footer__media').style.display = 'none'
    document.getElementById('filter__responsive').style.display = 'block'
    window.scrollTo(0, 0);
    document.querySelector('.body__add').style.backgroundColor = '#043B9C';
    }
}
// LOGIC FOR THE PROFILE MENU WHEN CLICKED ON FULL SCREEN

document.getElementById('profile').onclick = function(){
    toggleProfileInfo();
};
document.addEventListener('click', function(event) {
    if (!event.target.closest('#profile')) {
        document.getElementById('profile-info').style.display = 'none';
    }
});
function toggleProfileInfo() {
    if (document.getElementById('profile-info').style.display == 'flex') {
        document.getElementById('profile-info').style.display = 'none';
    } else {
        document.getElementById('profile-info').style.display = 'flex';
    }
}

const file = document.getElementById("rute_input");
file.addEventListener("click", toggleFilter);

// FUNCTION TO DISABLE SCROLL WHEN MENU SOMEONE´S INSIDE THE MENU
function disableScroll(){  
    window.scrollTo(0, 0);
}


const update = document.getElementById("submit");


function verifyFilter() {
    let correctFilter = false;
    
    const anio = document.querySelector('#category-year input[type="radio"]:checked')?.value || "";
    if (anio == "") {
        correctFilter = false;
    } else {
        correctFilter = true;
    }
    
    const area = document.querySelector('#category-area input[type="radio"]:checked')?.value || "";
    if (area == "") {
        correctFilter = false;
    } else {
        correctFilter = true;
    }
    
    if (checkContent('category')) {
        console.log("hola soy la funcion")
        // check if there is a category selected
        const category = document.querySelector('#category-category input[type="radio"]:checked')?.value || "";
        if (category == "") {
            correctFilter = false;
        } else {
            correctFilter = true;
        }
    }

    if (checkContent('subcategory')) {
        // check if there is a subcategory selected
        const subcategory = document.querySelector('#category-subcategory input[type="radio"]:checked')?.value || "";
        if (subcategory == "") {
            correctFilter = false;
        } else {
            correctFilter = true;
        }
    }

    if (checkContent('type')) {
        // check if there is a type selected
        const type = document.querySelector('#category-type input[type="radio"]:checked')?.value || "";
        if (type == "") {
            correctFilter = false;
        } else {
            correctFilter = true;
        }
    }

    if (checkContent('subtype')) {
        // check if there is a subtype selected
        const subtype = document.querySelector('#category-subtype input[type="radio"]:checked')?.value || "";
        if (subtype == "") {
            correctFilter = false;
        } else {
            correctFilter = true;
        }
    }
    return correctFilter;
}

function Base64(imagen) {
    return new Promise((resolve, reject) => {
        // Crear un objeto FileReader para leer el archivo de imagen
        var reader = new FileReader();

        // Escuchar el evento "load" para obtener la cadena Base64 del archivo de imagen
        reader.addEventListener('load', function() {
            // Obtener la cadena Base64 del archivo de imagen
            var imagen_base64 = reader.result;

            // Resolver la promesa con la cadena Base64 de la imagen
            resolve(imagen_base64);
        });

        // Escuchar el evento "error" en caso de que ocurra un error de lectura
        reader.addEventListener('error', function(error) {
            // Rechazar la promesa con el error de lectura
            reject(error);
        });

        // Leer el archivo de imagen como una URL de datos
        reader.readAsDataURL(imagen);
    });
}


async function addMedia(data) {
    const response = await fetch(`./backend/media/media-add.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    const result = await response.json();
    console.log(result);

    const error = document.getElementById('form__error')
    if(result.estatus == "Correcto") {
        setTimeout(function() {
            error.style.display = "flex"
            document.getElementById('form__error--text').innerText = "Media agregada correctamente"
            error.style.backgroundColor = "#228B22";
        }, 1000);
    }
}

update.addEventListener("click", function(event) {
    const error = document.getElementById('form__error')

    const date = document.getElementById("date").value;
    const description = document.getElementById("description").value;
    var select = document.querySelector('.input__option');
    var selected = select.value;
    if (selected == "image") {
        selected = 1;
    } else if (selected == "video") {
        selected = 2;
    } else { 
        selected = 0;
    }
    const resource = document.getElementById("file").value;
    const year_id = info.year != "" ? info.year : null;
    const area_id = info.area != "" ? info.area : null;
    const cdc_id = info.cdc != "" ? info.cdc : null;
    const category_id = info.category != "" ? info.category : null;
    const subcategory_id = info.subcategory != "" ? info.subcategory : null;
    const type_id = info.type != "" ? info.type : null;
    const subtype_id = info.subtype != "" ? info.subtype : null;

    const form = document.getElementById("form__add");

    const imagen = form.file.files[0];

    // aqui va a ir 
    var loader = document.querySelector('.loader');
    loader.style.visibility = 'visible';
    loader.style.opacity = '1';


    if (date === "" || description === "" || rute === "" || resource === "" || !selected ) {
        document.getElementById('form__error--text').innerText = "Existen campos vacíos";
        setTimeout(function() {
            error.style.backgroundColor = "#e83845";
            error.style.display = "flex"
        }, 1000);
        event.preventDefault();
    } else if(!verifyFilter()) {
        document.getElementById('form__error--text').innerText = "Faltan categorías por seleccionar";
        setTimeout(function() {
            error.style.backgroundColor = "#e83845";
            error.style.display = "flex"
        }, 1000);
        event.preventDefault();
    } else {
        Base64(imagen)
        .then(function(imagen_base64) {
            console.log(imagen_base64);
            const post = {
                date: date,
                description: description,
                type: selected,
                resource: imagen_base64,
                year_id: year_id,
                area_id: area_id,
                cdc_id: cdc_id,
                category_id: category_id,
                subcategory_id: subcategory_id,
                type_id: type_id,
                subtype_id: subtype_id
            }
            addMedia(post);
        })
        .catch(function(error) {
            console.log(error);
        });
    }

    setTimeout(function() {
        loader.style.visibility = 'hidden';
        loader.style.opacity = '0';
    }, 1000);
});