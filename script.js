const instantResearch = (path) => {
    let query = document.getElementById('search_bar').value
    axios
        .post(path, {query})
        .then(result => {
            destroySearchResults()
            let occurrence = 5
            for (let i = 0; i < occurrence; i++) {
                addSearchResult(result.data.results[i].title, result.data.results[i].id)
            }
        })
        .catch(console.log)
}

const watchedOrWatchLater = (action, movie_id) => {
    axios
        .post('../sources/movieButtons.php', {action, movie_id})
        .then(result => {
            return action
        })
        .catch(console.log)
}

const addTo = (movie_id) => {
    axios
        .post('../sources/allAlbums.php')
        .then(result => {
            let exist = document.getElementById('album_addTo')
            if (exist !== null) {
                let destroy = document.querySelectorAll(`[id="album_addTo"]`);
                destroy.forEach(element => element.remove())
            }else{
                let list = document.getElementById("album_list");
                result.data.forEach(element => {
                    let button = document.createElement("button");
                    let li = document.createElement("li");
                    button.innerText = element.name;
                    button.addEventListener("click", function() {addToAlbum(element.id,movie_id)})
                    li.id = "album_addTo";
                    li.appendChild(button)
                    list.appendChild(li);
                })
            }
        })
        .catch(console.log)
}

const addToAlbum = (album_id, movie_id) => {
    axios
        .post('../sources/addToAlbum.php', {album_id, movie_id})
        .then(result => {
            let closeAlbumList = document.querySelectorAll(`[id="album_addTo"]`);
            closeAlbumList.forEach(element => element.remove())
        })
        .catch(console.log)
}

function addSearchResult(movie_title, movie_id) {
    let list = document.getElementById("search_results");
    let a = document.createElement("a");
    let li = document.createElement("li");
    a.href = '../pages/movie.php?id=' + movie_id;
    a.innerText = movie_title;
    li.id = "search_proposal";
    li.appendChild(a)
    list.appendChild(li);
}

function destroySearchResults() {
    let check = document.querySelectorAll(`[id="search_proposal"]`);
    check.forEach(element => element.remove())
}
