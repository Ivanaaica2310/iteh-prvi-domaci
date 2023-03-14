<?php

class Comic
{
    public $id;
    public $userid;
    public $title;
    public $author;
    public $year;
    public $genre;
    public $price;
    public $abstract;
    public $country;
    public $created_at;

    public function __construct(
        $id,
        $userid,
        $title,
        $author,
        $year,
        $genre,
        $price,
        $abstract,
        $country,
        $created_at
    ) {
        $this->id = $id;
        $this->userid = $userid;
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->genre = $genre;
        $this->price = $price;
        $this->abstract = $abstract;
        $this->country = $country;
        $this->created_at = $created_at;
    }

    public function createComic()
    {
        $host = 'localhost';
        $user = 'admin';
        $password = 'admin';
        $database = 'comicshop';
        $conn = mysqli_connect($host, $user, $password, $database);

        $query = "INSERT INTO book(userid, title, author, year, genre, price, abstract, country)
            VALUES($this->userid, '$this->title', '$this->author', '$this->year',
                '$this->genre', '$this->price', '$this->abstract', '$this->country')";

        if (mysqli_query($conn, $query)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
