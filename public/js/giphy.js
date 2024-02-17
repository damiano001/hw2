document.querySelector('.giphy-icon').addEventListener('click', openGiphyModal);

//Gestione apertura modale
function openGiphyModal() {
    const modal = document.querySelector('.giphy-modal');
    modal.style.display = 'block';

    const apiKey = 'OeXnZUCnTL66VXADW2LdUz7ZP9BlTfR4';
    const url = `https://api.giphy.com/v1/gifs/trending?api_key=${apiKey}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const gifsContainer = document.querySelector('.gifs-container');
            gifsContainer.innerHTML = '';

            data.data.forEach(gif => {
                const img = document.createElement('img');
                img.src = gif.images.fixed_height.url;
                img.alt = gif.title;
                img.addEventListener('click', () => {

                    document.querySelector('#selected-gif-url').value = gif.images.original.url; //assegna l'url della gif selezionata ad un campo con id selected-gif-url

                    modal.style.display = 'none';
                });

                gifsContainer.appendChild(img);
            });
        })
        .catch(error => console.error(error));
}


//Gestione chiusura modale 
function closeModal() {
    const modal = document.querySelector('.giphy-modal');
    modal.style.display = 'none';
}

document.querySelector('.close-modal').addEventListener('click', closeModal);
