const instantResearch = () => {
    let tmdb = "https://api.themoviedb.org/3/search/movie"
    let query = document.getElementById('search_bar').value
    let promise = axios
        .get(tmdb, { params: { api_key: 'e62f0ff469851025669bbc2c9d762e25',query: query, page: 1 } })
        promise
            .then(result => {
                for (let i = 0; i < 5; i++) {
                    console.log(result.data.results[i].title)
                }
                return '---------------------------'
            })
            .then(id_country => console.log(id_country))
            .catch(error => console.log(error))
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