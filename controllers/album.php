<?php

class Album
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=devlab;host=127.0.0.1', 'root', '');
    }

    public function getAllAlbumFromUserId(int $user_id): array
    {
        $query = 'SELECT * FROM `album` WHERE `user_id` =?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($user_id));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllMoviesFromAlbumId(int $album_id): array
    {
        $query = 'SELECT * FROM `album_content` WHERE `album_id` =?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($album_id));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertMovieIntoAlbum(int $album_id, int $movie_id, bool $deleteIfExist)
    {
        $query = 'SELECT * FROM album_content WHERE `album_id` = :album_id AND `movie_id` = :movie_id';
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'album_id' => $album_id,
            'movie_id' => $movie_id
        ]);
        $statement = $statement->fetch();

        if (isset($statement['album_id']) && $deleteIfExist == 1) {
            $query = 'DELETE FROM album_content WHERE `album_id` = :album_id AND `movie_id` = :movie_id';
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                'album_id' => $album_id,
                'movie_id' => $movie_id
            ]);
        } elseif (isset($statement['album_id']) && $deleteIfExist == 0) {
            return 'The movie is already in this album';
        } else {
            $query = 'INSERT INTO album_content (album_id, movie_id) VALUES (:album_id, :movie_id)';
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                'album_id' => $album_id,
                'movie_id' => $movie_id
            ]);
        }
    }

    public function removeMovieFromAlbum(int $album_id, int $movie_id)
    {
        $query = 'DELETE FROM album_content WHERE `album_id` = :album_id AND `movie_id` = :movie_id';
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'album_id' => $album_id,
            'movie_id' => $movie_id
        ]);
    }

    public function getAlbumIdByNameAndUserId(int $user_id, string $album_name): int
    {
        $query = 'SELECT id FROM `album` WHERE `user_id` = :user_id AND `name` = :album_name';
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'user_id' => $user_id,
            'album_name' => $album_name
        ]);
        $statement = $statement->fetch();
        return $statement['id'];
    }

    public function createAlbum($user_id, $album_name, $album_visibility)
    {
        $query = 'INSERT INTO album (user_id, name, is_private) VALUES (:user_id, :album_name, :album_visibility)';
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'user_id' => $user_id,
            'album_name' => $album_name,
            'album_visibility' => $album_visibility
        ]);
    }

    public function deleteAlbum($album_id)
    {
        $query = 'DELETE FROM album_content WHERE `album_id` =?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($album_id));

        $query = 'DELETE FROM album WHERE `id` =?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($album_id));

        header("Location: ./albums.php");
    }

    public function isWatchedOrWatchLater($album_id):bool
    {
        $query = 'SELECT * FROM `album` WHERE `id` =?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($album_id));
        $statement = $statement->fetch();
        if($statement['is_watched'] === 1 || $statement['is_watch_later'] === 1){
            return true;
        }else{
            return false;
        }
    }

    public function getFirstMovieInAlbum($album_id)
    {
        $query = 'SELECT `movie_id` FROM `album_content` WHERE `album_id`=?';

        $statement = $this->pdo->prepare($query);
        $statement->execute(array($album_id));
        $statement = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
        $value = count($statement) - 1;
        if($value < 0){
            return null;
        }else {
            return json_encode($statement[$value]);
        }
    }

    public function getFirstAlbumFromLikedAlbums()
    {

    }
}