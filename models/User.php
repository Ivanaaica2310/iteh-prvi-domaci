<?php

class User
{
    public $id;
    public $email;
    public $username;
    public $password;
    public $created_at;

    public function __construct(
        $id,
        $email,
        $username,
        $password,
        $created_at
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->created_at = $created_at;
    }

    public function createUser()
    {
        $host = 'localhost';
        $user = 'admin';
        $password = 'admin';
        $database = 'comicshop';
        $conn = mysqli_connect($host, $user, $password, $database);

        $query = "INSERT INTO user(email, username, password) 
            VALUES('$this->email', '$this->username', '$this->password')";

        if (mysqli_query($conn, $query)) {
            header('Location: login.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
