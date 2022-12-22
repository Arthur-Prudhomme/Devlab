<?php
class Album{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=devlab;host=127.0.0.1', 'root', '');
    }
    public function getAllAlbumFromUserId(int $user_id): array{
        $query = 'SELECT * FROM `album` WHERE `user_id` =?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($user_id));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllMoviesFromAlbumId(int $album_id): array{
        $query = 'SELECT * FROM `album_content` WHERE `album_id` =?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($album_id));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertMovieIntoAlbum(int $album_id, int $movie_id){
        $query = 'INSERT INTO album_content (album_id, movie_id)
                    VALUES (:album_id, :movie_id)';
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'album_id' => $album_id,
            'movie_id' => $movie_id
        ]);
    }
    public function removeMovieFromAlbum(int $album_id, int $movie_id){
        $query = 'DELETE FROM album_content WHERE `movie_id` = :album_id AND `movie_id` = :movie_id';
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'album_id' => $album_id,
            'movie_id' => $movie_id
        ]);
    }
    public function createAlbum(){

    }
    public function deleteAlbum(){

    }
}