function requestApi(searchTerm) {
    const url = `http://localhost:3001/artists?name_like=${searchTerm}`; 
    fetch(url) 
       .then((response) => response.json())
       .then((result) => displayResults(result));
}

function displayResults(result) {
    const resultsArtists = document.getElementById('result-artist'); 
    const resultsPlaylists = document.getElementById('result-playlists');
    
    const artistName = document.getElementById('artist-name');
    const artistImage = document.getElementById('artist-img');
    
    result.forEach(element => {
        artistName.innerText = element.name;
        artistImage.src = element.urlImg;
    });
    
    resultsArtists.classList.remove('hidden');
    resultsPlaylists.classList.add('hidden');
}

document.addEventListener('input', () => { 
    const resultsArtists = document.getElementById('result-artist'); 
    const resultsPlaylists = document.getElementById('result-playlists');
    const searchInput = document.getElementById('search-input'); 

    const searchTerm = searchInput.value.toLowerCase(); 
    if (searchTerm === '') {
        resultsPlaylists.classList.remove('hidden');
        resultsArtists.classList.add('hidden');
        return;
    }
    
    requestApi(searchTerm);
});