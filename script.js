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

const button = (action, movie_id) => {
    axios
        .post('../sources/movieButtons.php', {action, movie_id})
        .then(result => {
            return action
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
    if (check) {
        check.forEach(element => element.remove())
    }
}
