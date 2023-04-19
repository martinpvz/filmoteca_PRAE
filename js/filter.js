const url = new URL(window.location.href);
// Obtener el valor de "error" de la URL
const cdc = url.searchParams.get("cdc");
const type = url.searchParams.get("type");


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
            console.log(filtro[f]);
            if (url.searchParams.get(f) == null) {
                url.searchParams.append(f, filtro[f]);
            } else {
                url.searchParams.set(f, filtro[f]);
            }
            window.history.replaceState({}, '', url);

        }
    }

    // just get the params of the url and put them in a string, print it 
    // and you will see what you need
    //
    var params = url.searchParams.toString();
    fetch(`./backend/filter/filter-list.php?${params}`)
        .then(response => response.json())
        .then(data => {
            console.log(data)
        })
        .catch(error => console.error('Error al realizar la petición', error));
        
    console.log(params);
    console.log(filtro);

});

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
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

listAreas();

let categories = '';
let categoriesShort = '';

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
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

listCategories();

let subcategories = '';
let subcategoriesShort = '';

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
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

listSubCategories();

let types = '';
let typesShort = '';

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
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

listTypes();

let subtypes = '';
let subtypesShort = '';

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
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

listSubTypes();

function changeCategory(type) {
    const text = document.getElementById(`see-more-${type}`);
    const arrow = document.getElementById(`see-more-img-${type}`);
    let variable;
    let variableShort;
    if (type == 'category') {
        variable = categories;
        variableShort = categoriesShort;
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
        arrow.style.backgroundImage = 'url(./img/up-arrow.png)';
    } else {
        text.innerText = 'Ver más';
        document.getElementById(`category-${type}`).innerHTML = variableShort;
        arrow.style.backgroundImage = 'url(./img/down-arrow.png)';
    }
}

// parámetros de la URL actual
try {
    var params = new URLSearchParams(window.location.search);
    var queryParams = '?' + params.toString();
    var addLink = document.querySelector('.addmedia');
    console.log(queryParams)
    addLink.href = addLink.getAttribute('href') + queryParams;
} catch (error) {}