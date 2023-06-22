const modal = document.querySelector(".modal__section");
const triggers = document.getElementsByClassName("trigger");
const closeButton = document.querySelector(".modal__header--img");
const file = document.getElementById("rute_input");
let selectedMedia = null;

const username = document.getElementById('username-text');
(async () => {
    username.innerText = await getUsername();
})();

// FUNCTION TO DISABLE SCROLL WHEN MENU SOMEONE´S INSIDE THE MENU
function disableScroll(){  
    window.scrollTo(0, 0);
}


const addMedia = document.getElementById('add-media');

function listarCDC() {
    fetch(`./backend/cdc/cdc-list.php`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0 && cdc != null) {
                cdc_name = cdc;
                let cdc_id = "";
                for( let cdc of data ) {
                    if(cdc.name.toLowerCase().includes(cdc_name.toLowerCase())) {
                        cdc_id = cdc.id;
                    }
                }
                if(currentCDC == cdc_id) {
                    const template = /*html*/ `    
                    <a href="./add.php" class="card addmedia" id="add-media">
                        <img src="./img/blue.jpeg">
                        <div class="card--text card--add">
                            <div class="card--add__img"></div>
                            <span>Agregar</span>
                        </div>
                    </a>
                    `;
                    console.log(template)
                    document.getElementById('media').insertAdjacentHTML('afterbegin', template);
                    
                }
            }
        })
        .then(() => {
            const addMedia = document.getElementById('add-media');
            if (addMedia) {
                if(cdc != null) {
                    addMedia.href = './add.php?cdc=' + cdc;
                } else if (type != null) {
                    addMedia.href = './add.php?type=' + type;
                }
            }
            listarMedia(currentUserType);
        })
        .catch(error => console.error('Error al realizar la petición', error));
}


listarCDC()


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

            // Eliminar el elemento de imagen existente
            const modalMedia = document.getElementById('modal-media');
            if (modalMedia) {
                modalMedia.remove();
            }

            // Verificar el tipo de medio y establecer el elemento correspondiente en el DOM
            if (info.type == 2) {
                const video = document.createElement('video');
                video.id = 'modal-media';
                video.src = info.resource;
                video.controls = true;
                video.autoplay = false;
                video.loop = false;
                document.querySelector('.modal__content--img').appendChild(video);
            } else {
                const img = document.createElement('img');
                img.id = 'modal-media';
                img.src = info.resource;
                document.querySelector('.modal__content--img').appendChild(img);
            }

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
        const info = photoInfo.find( photo => photo.media_id == selectedMedia );
        const modifyMediaWrapper = document.getElementById('modify-media-wrapper');

        // Eliminar el elemento de imagen o video existente
        const modifyMedia = document.getElementById('modify-media');
        if (modifyMedia) {
            modifyMedia.remove();
        }

        // Verificar el tipo de medio y establecer el elemento correspondiente en el DOM
        if (info.type == 2) {
            const video = document.createElement('video');
            video.id = 'modify-media';
            video.src = info.resource;
            video.controls = true;
            modifyMediaWrapper.appendChild(video);
        } else {
            const img = document.createElement('img');
            img.id = 'modify-media';
            img.src = info.resource;
            modifyMediaWrapper.appendChild(img);
        }

        const date = new Date(info.date);
        const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
        const dateFinal = date.toLocaleDateString('es-MX', options).replace(/(\d{2})\/(\d{2})\/(\d{4})/, '$3-$2-$1');
        document.getElementById("date").value = dateFinal;
        document.getElementById('description').value = info.description;
        /*document.getElementById('modal-download').href = info.resource;*/
        } 
    } catch(e) { console.log(e) }

    toggleModal()
    //document.querySelector('.classify').style.display = "none";
    document.querySelector('.classify').classList.add('hide');
    document.querySelector(".gallery").style.display = "none"
    document.querySelector(".modify").style.display = "flex"
    document.querySelector('.filter__button').classList.add('hide');
    window.scrollTo(0, 0);
}

function deleteMedia() {
    fetch(`./backend/media/media-delete.php?id=${selectedMedia}&type=${type}`)
        .then(response => response.json())
        .then(data => {
            if (data.estatus == "Correcto") {
                location.reload();
            }
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

function closeModify() {
    document.querySelector('.classify').classList.remove('hide');
    // document.querySelector('.classify').style.display = "flex";
    document.querySelector(".gallery").style.display = "flex"
    document.querySelector(".modify").style.display = "none";
    const error = document.getElementById('form__error')
    error.style.display = "none";
    // if (window.innerWidth < 880) {
    //     document.querySelector(".filter__button").style.display = "flex"
    // }
    document.querySelector(".filter__button").classList.remove('hide');
    window.scrollTo(0, 0);
}

try {
    const edit = document.querySelector(".content__edit");
    edit.addEventListener("click", toggleEdit);
} catch(e) {}

async function star( id ) {
    fetch(`./backend/favourite/make-favourite.php?id=${id}&type=${type}`)
        .then(response => response.json())
        .then(data => {
            console.log(data)
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

let currentPage = 1;

function createTemplate(startIndex, endIndex, currentUserType) {
    let template = '';
    for (let index = startIndex; index < endIndex; index++) {
        const photo = photoInfo[index];
        if (!photo) {
            break;
        }
        
        // Plantilla proporcionada
        if (photo.type == "1") {
            if (photo.favourite == "1" && (currentUserType == "1" || currentUserType == "2" || currentUserType == "3")) {
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
            } else if (photo.favourite == "0" && (currentUserType == "1" || currentUserType == "2" || currentUserType == "3")) {
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
            if (photo.favourite == "1" && (currentUserType == "1" || currentUserType == "2" || currentUserType == "3")) {
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
            } else if (photo.favourite == "0" && (currentUserType == "1" || currentUserType == "2" || currentUserType == "3")) {
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
    }
    return template;
}

function removeChildrenExceptAddMedia(parentElement) {
    let currentNode = parentElement.firstChild;
    while (currentNode) {
        if (currentNode.id === 'add-media') {
            currentNode = currentNode.nextSibling;
            continue;
        }
        const nodeToRemove = currentNode;
        currentNode = currentNode.nextSibling;
        parentElement.removeChild(nodeToRemove);
    }
}

function updatePhotos(currentUserType) {
    fetch(`./backend/media/media-list.php?cdc=${cdc}&type=${type}`)
        .then(response => response.json())
        .then(data => {
            photoInfo = data;
            const startIndex = (currentPage - 1) * 10;
            const endIndex =currentPage * 10;
            const template = createTemplate(startIndex, endIndex, currentUserType);

            const addMedia = document.getElementById('add-media');
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
            
            if(data.length > 10) {
                document.getElementById("arrows").style.display = "flex";
            }
        })
        .catch(error => console.error('Error al realizar la petición', error));
}




function listarMedia(currentUserType) {
    if (photoInfo.length === 0) {
        fetch(`./backend/media/media-list.php?cdc=${cdc}&type=${type}`)
            .then(response => response.json())
            .then(data => {
                photoInfo = data;
                const startIndex = (currentPage - 1) * 10;
                const endIndex =currentPage * 10;
                const template = createTemplate(startIndex, endIndex, currentUserType);

                const addMedia = document.getElementById('add-media');
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
                
                if(data.length > 10) {
                    document.getElementById("arrows").style.display = "flex";
                }
            })
            .catch(error => console.error('Error al realizar la petición', error));
    } else {
        const startIndex = (currentPage - 1) * 10;
        const endIndex = currentPage * 10;
        const template = createTemplate(startIndex, endIndex, currentUserType);

        const mediaContainer = document.getElementById('media');
        const addMedia = document.getElementById('add-media');
        
        // Vacía el contenedor antes de agregar la nueva plantilla, pero conserva el elemento "add-media"
        removeChildrenExceptAddMedia(mediaContainer);

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
        
        if(photoInfo.length > 10) {
            //document.getElementById("arrows").style.display = "flex";
            setTimeout(function() {
                document.getElementById("media").style.display = "block";
                document.getElementById("arrows").style.display = "flex";
                loaders.style.display = "none";
            }, 600);
        }
    }
}

function changePage(direction) {
    if (direction === "left" && currentPage > 1) {
        currentPage--;
        if(currentPage === 1) {
            document.getElementById("arrow-left").style.visibility = "hidden";
        }
        document.getElementById("arrow-right").style.visibility = "visible";
    } else if (direction === "right" && currentPage * 10 < photoInfo.length) {
        currentPage++;
        if( (currentPage + 1) * 10 > photoInfo.length ) {
            document.getElementById("arrow-right").style.visibility = "hidden";
        }
        document.getElementById("arrow-left").style.visibility = "visible";
    }
    document.getElementById("media").style.display = "none";
    document.getElementById("arrows").style.display = "none";
    window.scroll({
        top: 0,
        behavior: 'smooth'
    });
    loaders.style.display = "flex";
    
    listarMedia(currentUserType);
}
