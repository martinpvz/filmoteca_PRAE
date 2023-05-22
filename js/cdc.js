const username = document.getElementById('username-text');
(async () => {
    username.innerText = await getUsername();
})();

const addCard = document.getElementById('add-card');

function listarCDC() {
    fetch(`./backend/cdc/cdc-list.php`)
        .then(response => response.json())
        .then(data => {
            if (Object.keys(data).length > 0) {
                let template = '';
                // make cdc.name to a single word, without spaces, to use for a link
                data.forEach(cdc => {
                const cdcName = cdc.name.replace(' ', '-').toLowerCase();
                const cdcLink = cdcName.split('-')[1] ? cdcName.split('-')[1] : cdcName.split('-')[0];
                template += /*html*/`
                    <a href="./media.php?cdc=${cdcLink}" class="card">  
                        <img src="${cdc.image}" alt="cdc">
                        <div class="card--text">
                            ${cdc.name}
                        </div>
                    </a>
                `;
            });
            if (addCard) {
                addCard.insertAdjacentHTML('afterend', template);
            } else {
                document.getElementById('cards').insertAdjacentHTML('afterbegin', template);
            }
        }
        })
        .catch(error => console.error('Error al realizar la petición', error));
}

listarCDC();