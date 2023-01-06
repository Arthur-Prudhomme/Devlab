const instantResearch = (path, isForUser, isForInvite, album_id, owner_id) => {
    let query
    if(isForUser === 0) {
        query = document.getElementById('search_bar').value
    }else{
        query = document.getElementById('user_search_bar').value
    }
    axios
        .post(path, {query})
        .then(result => {
            destroyAllOccurrence("search_proposal")
            let occurrence = 5
            if(isForUser === 0){
                for (let i = 0; i < occurrence; i++) {
                    addMovieToSearchResults(result.data.results[i].title, result.data.results[i].id)
                }
            }else{
                destroyAllOccurrence("user_search_proposal")
                if (result.data.length < occurrence) {
                    occurrence = result.data.length
                }

                if(isForInvite === 0) {
                    for (let i = 0; i < occurrence; i++) {
                        addUserToSearchResults(result.data[i].username)
                    }
                }else{
                    for (let i = 0; i < occurrence; i++) {
                        addUserToInvitationList(result.data[i].username, album_id, owner_id, result.data[i].id)
                    }
                }
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

const likeAlbum = (album_id, user_id) => {
    axios
        .post('../sources/likeAlbum.php', {album_id, user_id})
        .then(result => {
            let divToDestroy = document.getElementById("l"+album_id)
            divToDestroy.remove()
        })
        .catch(console.log)
}

const sendInvitation = (album_id, owner_id, invited_id) => {
    axios
        .post('../sources/sendInvitation.php', {album_id, owner_id, invited_id})
        .then(result => {
            document.getElementById("user_search_bar").value = ''
            destroyAllOccurrence('user_invitation_proposal')
        })
        .catch(console.log)
}

const allAlbum = () => {
    axios
        .post('../sources/allGenre.php')
        .then(result => {
            let exist = document.getElementById('genre_title_list')
            if (exist !== null) {
                destroyAllOccurrence("genre_title_list")
            }else{
                let list = document.getElementById("genre_list");
                let genre_num = result.data.genres.length
                for(let i = 0; i < genre_num; i++){
                    let genre = document.createElement("a");
                    let li = document.createElement("li");
                    genre.innerText = result.data.genres[i].name;
                    genre.href = '../pages/genre.php?id='+ result.data.genres[i].id +'&page=1&order=desc';
                    li.id = "genre_title_list";
                    li.appendChild(genre)
                    list.appendChild(li);
                }
            }
        })
        .catch(console.log)
}

function accountNav() {
    let exist = document.getElementById('account_choice')
    if (exist !== null) {
        destroyAllOccurrence("account_choice")
    }else{
        for(let i = 0; i < 2; i++) {
            let innerText
            let href
            if (i === 0) {
                innerText = 'Profil'
                href = '../pages/profil.php'
            } else{
                innerText = 'Logout'
                href = '../actions/logout.php'
            }
            let list = document.getElementById("account_nav");
            let choice = document.createElement("a");
            let li = document.createElement("li");
            choice.innerText = innerText;
            choice.href = href;
            li.id = "account_choice";
            li.appendChild(choice)
            list.appendChild(li);
        }
    }
}

function addMovieToSearchResults(movie_title, movie_id) {
    let list = document.getElementById("search_results");
    let a = document.createElement("a");
    let li = document.createElement("li");
    a.href = '../pages/movie.php?id=' + movie_id;
    a.innerText = movie_title;
    li.id = "search_proposal";
    li.appendChild(a)
    list.appendChild(li);
}

function addUserToSearchResults(username) {
    let list = document.getElementById("user_search_results");
    let a = document.createElement("a");
    let li = document.createElement("li");
    a.href = '../pages/profil.php?username=' + username;
    a.innerText = username;
    li.id = "user_search_proposal";
    li.appendChild(a)
    list.appendChild(li);
}

function addUserToInvitationList(username, album_id, owner_id , invited_id){
    let list = document.getElementById("user_invitation_list");
    let a = document.createElement("a");
    let li = document.createElement("li");
    a.innerText = username;
    a.href = '#';
    a.addEventListener("click", function() {sendInvitation(album_id, owner_id, invited_id)})
    li.id = "user_invitation_proposal";
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

const removeFromAlbum = (div_id, album_id) => {
    axios
        .post('../sources/removeFromAlbum.php', {div_id, album_id})
        .then(result => {
            let divToDestroy = document.getElementById(div_id)
            divToDestroy.remove()
        })
        .catch(console.log)
}