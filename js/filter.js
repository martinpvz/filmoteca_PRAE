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
                            <input type="radio" name="anio" id="${year.year}">
                            <label for="${year.year}">${year.year}</label>
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
                            <input type="radio" name="area" id="${area.area}">
                            <label for="${area.area}">${area.area}</label>
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


// parámetros de la URL actual
var params = new URLSearchParams(window.location.search);
var queryParams = '?' + params.toString();
var addLink = document.querySelector('.addmedia');
console.log(queryParams)
addLink.href = addLink.getAttribute('href') + queryParams;
