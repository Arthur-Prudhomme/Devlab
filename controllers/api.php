<?php

class API
{

    private static $APIkey = 'e62f0ff469851025669bbc2c9d762e25';

    public function getTrending($page)
    {
        $data = file_get_contents('https://api.themoviedb.org/3/trending/movie/day?api_key=' . self::$APIkey . '&page=' . $page);
        return json_decode($data, true);
    }

    public function getTopRated($page)
    {
        $data = file_get_contents('https://api.themoviedb.org/3/movie/top_rated?api_key=' . self::$APIkey . '&page=' . $page);
        return json_decode($data, true);
    }

    public function getMovie($movie_id)
    {
        $data = file_get_contents('https://api.themoviedb.org/3/movie/' . $movie_id . '?api_key=' . self::$APIkey);
        return json_decode($data, true);
    }

    public function getCast($movie_id)
    {
        $data = file_get_contents('https://api.themoviedb.org/3/movie/' . $movie_id . '/credits?api_key=' . self::$APIkey);
        return json_decode($data, true);
    }

    public function getImg($path, $size)
    {
        return 'https://image.tmdb.org/t/p/w' . $size . $path;
    }

    public function getPoster($path)
    {
        return 'https://image.tmdb.org/t/p/original' . $path;
    }

    public function getAllGenre()
    {
        $data = file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=' . self::$APIkey);
        return json_decode($data, true);
    }

    public function getMovieByGenre($genre_id, $page, $order)
    {
        $data = file_get_contents('https://api.themoviedb.org/3/discover/movie?api_key=' . self::$APIkey . '&with_genres=' . $genre_id . '&page=' . $page . '&sort_by=' . $order);
        return json_decode($data, true);
    }

    public function getMovieBySearch($keyword, $page)
    {
        $data = file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=' . self::$APIkey . '&query=' . urlencode($keyword) . '&page=' . $page);
        return json_decode($data, true);
    }

    public function getPerson($person_id)
    {
        $data = file_get_contents('https://api.themoviedb.org/3/person/' . $person_id . '?api_key=' . self::$APIkey);
        return json_decode($data, true);
    }

    public function getMovieByPerson($person_id, $page)
    {
        $data = file_get_contents('https://api.themoviedb.org/3/discover/movie?api_key=' . self::$APIkey . '&with_people=' . $person_id . '&page=' . $page);
        return json_decode($data, true);
    }
}