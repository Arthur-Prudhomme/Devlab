const instantResearch = (check_path) => {
    let query = document.getElementById('search_bar').value
    axios
        .post('#', {query, check_path})
        .then(result => {
            addSearchResult()
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

function addSearchResult(search_results) {
    for (let i = 0; i < 5; i++) {
        let list = document.getElementById("search_results");
        let a = document.createElement("a");
        let li = document.createElement("li");
        a.href = '/pages/movie.php?id=' + search_results.results[i].id;
        a.innerText = search_results.results[i].title;
        li.id = "search_proposal";
        li.appendChild(a)
        list.appendChild(li);
    }
}