const instantResearch = (path) => {
    let query = document.getElementById('search_bar').value
    axios
        .post(path, {query})
        .then(result => {
            destroyAllOccurrence("search_proposal")
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
                destroyAllOccurrence("album_addTo")
            }else{
                let list = document.getElementById("album_list");
                result.data.forEach(element => {
                    let albums = document.createElement("button");
                    let li = document.createElement("li");
                    albums.innerText = element.name;
                    albums.addEventListener("click", function() {addToAlbum(element.id,movie_id)})
                    li.id = "album_addTo";
                    li.appendChild(albums)
                    list.appendChild(li);
                })
                let newAlbum = document.createElement("button");
                let li = document.createElement("li");
                newAlbum.innerText = "new album";
                newAlbum.addEventListener("click", function() {addAlbumForm()})
                li.id = "album_addTo";
                li.appendChild(newAlbum)
                list.appendChild(li);
            }
        })
        .catch(console.log)
}

const addToAlbum = (album_id, movie_id) => {
    axios
        .post('../sources/addToAlbum.php', {album_id, movie_id})
        .then(result => {
            destroyAllOccurrence("album_addTo")
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

function destroyAllOccurrence(elements_id) {
    let check = document.querySelectorAll(`[id=`+ elements_id +`]`);
    check.forEach(element => element.remove())
}

function addAlbumForm(){
    destroyAllOccurrence("album_addTo")
    for(let i = 0; i < 3; i++){
        let typeValue
        let idValue
        if(i === 0){
            typeValue = "input"
            idValue = "input"
        }else if(i === 1){
            typeValue = "select"
            idValue = "select"
        }else{
            typeValue = "button"
            idValue = "button"
        }
        let list = document.getElementById("album_list");
        let element = document.createElement(typeValue);
        let li = document.createElement("li");
        li.id = "album_addTo";
        element.id = idValue;
        if(i === 1){
            let choice1 = document.createElement("option");
            choice1.innerText = "public";
            let choice2 = document.createElement("option");
            choice2.innerText = "private";
            element.appendChild(choice1)
            element.appendChild(choice2)
        }else if(i === 2){
            element.innerText = "create album";
            element.addEventListener("click", function() {addAlbum(getElementValueById("input"),getElementValueById("select"))})
        }
        li.appendChild(element);
        list.appendChild(li);
    }
}

function getElementValueById(id_name){
    return document.getElementById(id_name).value
}

const addAlbum = (album_name, album_visibility) => {
    if(album_visibility === "public"){
        album_visibility = 0
    }else{
        album_visibility = 1
    }
    axios
        .post('../sources/addAlbum.php', {album_name, album_visibility})
        .then(result => {
            destroyAllOccurrence("album_addTo")
        })
        .catch(console.log)
}