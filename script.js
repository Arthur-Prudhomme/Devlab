const instantResearch = () => {
    let tmdb = "https://api.themoviedb.org/3/search/movie"
    let query = document.getElementById('search_bar').value
    let promise = axios
        .get(tmdb, { params: { api_key: 'e62f0ff469851025669bbc2c9d762e25',query: query, page: 1 } })
        promise
            .then(result => {
                destroySearchResults()
                let occurence = 5
                for (let i = 0; i < occurence; i++) {
                    console.log(result.data.results[i].title)
                    addSearchResult(result.data.results[i].title, result.data.results[i].id)
                }
            })
            .catch(error => {
                console.log(error)
                destroySearchResults()
            })
}

const button = (action) => {
    let promise = axios
        .post('#', { action } )
    promise
        .then(result => {
            return action
        })
        .then(id_country => console.log(id_country))
        .catch(error => console.log(error))
}

function addSearchResult(movie_title, movie_id){
    let list = document.getElementById("search_results");
    let a = document.createElement("a");
    let li = document.createElement("li");
    a.href = './pages/movie.php?id=' + movie_id;
    a.innerText = movie_title;
    li.id = "search_proposal";
    li.appendChild(a)
    list.appendChild(li);
}

function destroySearchResults(){
    let check = document.querySelectorAll(`[id="search_proposal"]`);
    if(check){
        check.forEach(element => element.remove())
    }
}