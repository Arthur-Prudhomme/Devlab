const instantResearch = (path) => {
    let query = document.getElementById('search_bar').value
    axios
        .post(path, {query})
        .then(result => {
            destroySearchResults()
            let occurence = 5
            for (let i = 0; i < occurence; i++) {
                addSearchResult(result.data.results[i].title, result.data.results[i].id)
            }
        })
        .catch(console.log)
}

const button = (action) => {
    let promise = axios
        .post('#', {action})
    promise
        .then(result => {
            return action
        })
        .catch(error => console.log(error))
}
function addSearchResult(movie_title,movie_id){
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
