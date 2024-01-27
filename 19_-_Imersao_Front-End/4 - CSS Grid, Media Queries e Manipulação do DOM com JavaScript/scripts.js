//console.log("Hello Word"); // Testar o js

const firstCard = document.querySelector('.cards'); // pega pela class mas apenas o primeiro elemento
const cards = document.querySelectorAll('.cards'); // pega pela class todos elementos, retorna um array1


//---------------------------------------------------------------//

const searchInput = document.getElementById('search-input'); // joga a referência do id do elemento para manipulação
const resultsArtists = document.getElementById('result-artist'); 
const resultsPlaylists = document.getElementById('result-playlists'); 

function requestApi(searchTerm) {
    const url = `http://localhost:3000/artists?name_like=${searchTerm}`; //query string para esse ?name_like é apenas para já filtrar resultado no json, provável seja implementação do json_server
    fetch(url) //consumir API
       .then((response) => response.json()) // promisse fica escutando até responder na resposta 
       .then((result) => displayResults(result));
}

function displayResults(result) {
    const artistName = document.getElementById('artist-name');
    const artistImage = document.getElementById('artist-img');
    
    result.forEach(element => {
        artistName.innerText = element.name;
        artistImage.src = element.urlImg;
    });
    
    resultsArtists.classList.remove('hidden');
    resultsPlaylists.classList.add('hidden');
}


// Escutar eventos no js
//document.addEventListener('input', () => { } ) //  arrow function;
//document.addEventListener('input', function () {}) // javascript raiz função anonima

document.addEventListener('input', () => { 
    const searchTerm = searchInput.value.toLowerCase();
    if (searchTerm === '') { // === valores iguais e do mesmo tipo
        resultsPlaylists.classList.add('hidden');
        resultsArtists.classList.remove('hidden');
        return;
    }
    
    requestApi(searchTerm);
});