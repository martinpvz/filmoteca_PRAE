const modal = document.querySelector(".modal__section");
const triggers = document.getElementsByClassName("trigger");
const closeButton = document.querySelector(".modal__header--img");
const file = document.getElementById("rute_input");
let selectedMedia = null;

// FUNCTION TO DISABLE SCROLL WHEN MENU SOMEONE´S INSIDE THE MENU
function disableScroll(){  
    window.scrollTo(0, 0);
}

console.log(currentCDC)

if ( (currentCDC == '1' && cdc == 'chamontoya') || (currentCDC == '2' && cdc == 'zacatlán') || (currentCDC == '3' && cdc == 'cuacuila') ) {
    const template = /*html*/ `    
    <a href="./add.php" class="card addmedia" id="add-media">
        <img src="./img/blue.jpeg">
        <div class="card--text card--add">
            <div class="card--add__img"></div>
            <span>Agregar</span>
        </div>
    </a>
    `;
    document.getElementById('media').insertAdjacentHTML('afterbegin', template);
}


const addMedia = document.getElementById('add-media');
let photoInfo = [];


// LOGIC FOR THE VISUALIZATION OF AN IMAGE OR VIDEO
function toggleModal( event ) {
    try {
        if ( event.target.id != '' ) {
            selectedMedia = event.target.id;
            const info = photoInfo.find( photo => photo.media_id == event.target.id )
            document.getElementById('modal-description').innerText = 'Descripción: ' + info.description;
            const date = new Date(info.date);
            const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            const dateFinal = date.toLocaleDateString('es-MX', options).replace(/\-/g, '/');
            document.getElementById('modal-date').innerText = 'Fecha: ' + dateFinal;
            document.getElementById('modal-media').src = info.resource;
            document.getElementById('modal-download').href = info.resource;
        }
    } catch(e) {}

    modal.classList.toggle("show-modal");
    
    if (modal.classList.contains("show-modal")) {
        //window.addEventListener('scroll', disableScroll);
        document.body.style.overflow = "hidden";

    } else {
        //window.removeEventListener('scroll', disableScroll);  
        document.body.style.overflow = "auto";
    }
}


function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}

function toggleEdit() {
    try {
        if ( selectedMedia != null ) {
            console.log( "hola soy el edit222")
            console.log( selectedMedia )
            console.log( photoInfo )
            const info = photoInfo.find( photo => photo.media_id == selectedMedia )
            console.log( info )
            document.getElementById('modify-photo').src = info.resource;
            const date = new Date(info.date);
            const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            const dateFinal = date.toLocaleDateString('es-MX', options).replace(/(\d{2})\/(\d{2})\/(\d{4})/, '$3-$2-$1');
            document.getElementById("date").value = dateFinal;
            document.getElementById('description').value = info.description;
            /*document.getElementById('modal-download').href = info.resource;*/
        } 
    } catch(e) { console.log("holita") }

    toggleModal()
    document.querySelector('.classify').style.display = "none";
    document.querySelector(".gallery").style.display = "none"
    document.querySelector(".modify").style.display = "flex"
    document.querySelector(".filter__button").style.display = "none"
    window.scrollTo(0, 0);
}


function deleteMedia() {
    fetch(`./backend/media/media-delete.php?id=${selectedMedia}`)
        .then(response => response.json())
        .then(data => {
            if (data.estatus == "Correcto") {
                location.reload();
            }
        })
        .catch(error => console.error('Error al realizar la petición', error));
}



function closeModify() {
    document.querySelector('.classify').style.display = "flex";
    document.querySelector(".gallery").style.display = "flex"
    document.querySelector(".modify").style.display = "none"
    if (window.innerWidth < 880) {
        document.querySelector(".filter__button").style.display = "flex"
    }
    window.scrollTo(0, 0);
}

const edit = document.querySelector(".content__edit");
edit.addEventListener("click", toggleEdit);



async function star( id ) {
    fetch(`./backend/favourite/make-favourite.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.estatus == "Correcto") {
                if (document.getElementById(`favourite${id}`).style.backgroundImage.includes("star.png")) {
                    document.getElementById(`favourite${id}`).style.backgroundImage = "url(./img/starWhite.png)";
                } else {
                    document.getElementById(`favourite${id}`).style.backgroundImage = "url(./img/star.png)";
                }
            }
        })
        .catch(error => console.error('Error al realizar la petición', error));
}




function listarMedia() {
    fetch(`./backend/media/media-list.php?cdc=${cdc}&type=${type}`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0) {
                let template = '';
                photoInfo = data;
                data.forEach(photo => {
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
                });
            if (addMedia) {
                addMedia.insertAdjacentHTML('afterend', template);
            } else {
                document.getElementById('media').insertAdjacentHTML('afterbegin', template);
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
            
        }
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

listarMedia();

