const url = new URL(window.location.href);
// Obtener el valor de "error" de la URL
const cdc = url.searchParams.get("cdc");
const type = url.searchParams.get("type");


const Category = document.getElementById("category");
const Subcategory = document.getElementById("subcategory");
const Type = document.getElementById("type");
const Subtype = document.getElementById("subtype");

//Subcategory.style.display = "none";
//Type.style.display = "none";
//Subtype.style.display = "none";


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

async function updateFilter(data) {
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
    console.log(result)
    //return result;
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
            } else if (name == "subcategory") {
                info.subcategory = clase;
                value.subcategory = label.textContent;
            } else if (name == "type") {
                info.type = clase;
                value.type = label.textContent;
            } else if (name == "subtype") {
                info.subtype = clase;
                value.subtype = label.textContent;
            }  else if (name == "anio") {
                info.year = clase;
                value.year = label.textContent;
            }  else if (name == "area") {
                info.area = clase;
                value.area = label.textContent;
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
            updateFilter(info);
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
            getName("category");
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
            getName("subcategory");
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
            getName("type");
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
            getName("subtype");
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

listSubTypes();


function changeCategory(type) {
    const text = document.getElementById(`see-more-${type}`);
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
        arrow.style.backgroundImage = 'url(./img/up-arrow.png)';
        getName(type);
        
    } else {
        text.innerText = 'Ver más';
        document.getElementById(`category-${type}`).innerHTML = variableShort;
        arrow.style.backgroundImage = 'url(./img/down-arrow.png)';
        getName(type);
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
    window.scrollTo(0, 0);
}
function toggleFilter() {
    if (window.innerWidth < 880) {
    document.getElementById('main__media').style.display = 'none'
    document.getElementById('footer__media').style.display = 'none'
    document.getElementById('filter__responsive').style.display = 'block'
    window.scrollTo(0, 0);
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

update.addEventListener("click", function(event) {
    const error = document.getElementById('form__error')
    const date = document.getElementById("date").value;
    const description = document.getElementById("description").value;
    const rute = document.getElementById("rute").value;
    const file = document.getElementById("file").value;

    if (date === "" || description === "" || rute === "" || file === "") {
        error.style.display = "flex"
        event.preventDefault();
    }
});


// Logic for filter section (so it can appear in the rute form)
// Obtener los elementos de radio
// const anios = document.getElementsByName("anio");
// const area = document.getElementsByName("area");
// const category = document.getElementsByName("category");

// console.log(anios)

// const rute = document.getElementById("rute");
// // Verificar qué elemento está seleccionado
// for (let i = 0; i < anios.length; i++) {
//     anios[i].addEventListener("click", function() {
//         console.log("El elemento seleccionado es " + anios[i].id);
//         rute.value = anios[i].id + ", "
//     });
// }

// let selected = true
// for (let i = 0; i < area.length; i++) {
//     area[i].addEventListener("click", function() {
//         if (selected) {
//             console.log("El elemento seleccionado es " + area[i].id);
//             rute.value += area[i].id + ", "
//             selected = false
//         }
//     });
// }

// for (let i = 0; i < category.length; i++) {
//     category[i].addEventListener("click", function() {
//         if (selected) {
//             console.log("El elemento seleccionado es " + category[i].id);
//             rute.value += category[i].id + ", "
//             selected = false
//         }
//     });
// }