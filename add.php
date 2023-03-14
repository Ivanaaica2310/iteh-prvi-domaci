<?php

include('config/db_connect.php');
include('models/Comic.php');

$title = $author = $year = $genre = $price = $abstract = $country = '';

$errors = [
    'title' => '', 'author' => '', 'year' => '',
    'genre' => '', 'price' => '', 'abstract' => '',
    'country' => ''
];

if (isset($_POST['add'])) {

    if (empty($_POST['title'])) {
        $errors['title'] = 'Title is required!';
    } else {
        $title = $_POST['title'];
    }

    if (empty($_POST['author'])) {
        $errors['author'] = 'Author is required!';
    } else {
        $author = $_POST['author'];
    }

    if (empty($_POST['year'])) {
        $errors['year'] = 'Year is required!';
    } else {
        $yearStr = $_POST['year'];
        // gledamo da li unos ima 4 cifre
        // i gledamo da li je unesen broj, ako nije unesen broj intval vraća 1
        // intval ~= strtoint
        if (strlen($yearStr) != 4 || intval($yearStr) == 1) {
            $errors['year'] = 'Wrong input for year!';
        } else {
            $year = intval($yearStr);
            // date("Y") trenutna godina
            if ($year < 1301 || $year > date("Y")) {
                $errors['year'] = 'Wrong input for year!';
            }
        }
    }

    if (empty($_POST['genre'])) {
        $errors['genre'] = 'Genre is required!';
    } else {
        $genre = $_POST['genre'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $genre)) {
            $errors['genre'] = 'Wrong input for the genre!';
            $genre = '';
        }
    }

    if (empty($_POST['price'])) {
        $errors['price'] = 'Price is required!';
    } else {
        $priceStr = $_POST['price'];
        // i gledamo da li je unesen broj, ako nije unesen broj intval vraća 1
        // intval ~= strtoint
        if (strlen($priceStr) > 7 || intval($priceStr) == 1) {
            $errors['price'] = 'Wrong input for price!';
        } else {
            $price = intval($priceStr);
            if ($price < 1 || $price > 1000000) {
                $errors['price'] = 'Wrong input for price!';
            }
        }
    }

    if (empty($_POST['abstract'])) {
        $errors['abstract'] = 'Abstract is required!';
    } else {
        $abstract = $_POST['abstract'];
    }

    include('ajax/countries.php');

    if (empty($_POST['country'])) {
        $errors['country'] = 'Country is required!';
    } else {
        $country = $_POST['country'];
        if (!in_array($country, $country_list)) {
            $errors['country'] = 'No such country exists!';
        }
    }

    if (!array_filter($errors)) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];
        $price = $_POST['price'];
        $abstract = $_POST['abstract'];
        $conutry = $_POST['country'];
        $userid = $_POST['userid'];

        $newComic = new Comic(
            null,
            $userid,
            $title,
            $author,
            $year,
            $genre,
            $price,
            $abstract,
            $country,
            null
        );

        $newComic->createComic();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<section class="container">
    <h4 class="center">Post a comic</h4>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="white form" method="POST">
        <label for="title">Book title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>

        <label for="author">Book author:</label>
        <input type="text" name="author" value="<?php echo htmlspecialchars($author) ?>" onkeyup="suggestAuthor(this.value)">
        <div class="red-text"><?php echo $errors['author']; ?></div>
        <p><span id="authorSuggest"></span></p>

        <label for="year">Year of production:</label>
        <input type="text" name="year" value="<?php echo htmlspecialchars($year) ?>">
        <div class="red-text"><?php echo $errors['year']; ?></div>

        <label for="genre">Genre:</label>
        <input type="text" name="genre" value="<?php echo htmlspecialchars($genre) ?>" onkeyup="suggestGenre(this.value)">
        <div class="red-text"><?php echo $errors['genre']; ?></div>
        <p><span id="genreSuggest"></span></p>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?php echo htmlspecialchars($price) ?>">
        <div class="red-text"><?php echo $errors['price']; ?></div>

        <label for="abstract">Abstract:</label>
        <input type="text" name="abstract" value="<?php echo htmlspecialchars($abstract) ?>">
        <div class="red-text"><?php echo $errors['abstract']; ?></div>

        <label for="country">Country:</label>
        <input type="text" name="country" value="<?php echo htmlspecialchars($country); ?>" onkeyup="suggestCountry(this.value)">
        <div class=" red-text"><?php echo $errors['country']; ?></div>
        <p><span id="countrySuggest"></span></p>

        <input type="hidden" name="userid" value="<?php echo $loggedId; ?>">

        <div class="center">
            <input type="submit" name="add" value="Post a comic" class="btn deep-purple darken-2 z-depth-0">
        </div>
    </form>


</section>

<?php include('templates/footer.php'); ?>

<script>
    function suggestAuthor(str = "") {
        if (str.length == 0) {
            document.getElementById("authorSuggest").innerHTML = "";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("authorSuggest").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/authors.php?query=" + str, true);
            xmlhttp.send();
        }
    }
</script>

<script>
    function suggestGenre(str = "") {
        if (str.length == 0) {
            document.getElementById("genreSuggest").innerHTML = "";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("genreSuggest").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/genre.php?query=" + str, true);
            xmlhttp.send();
        }
    }
</script>

<script>
    function suggestCountry(str = "") {
        if (str.length == 0) {
            document.getElementById("countrySuggest").innerHTML = "";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("countrySuggest").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/countries.php?qc=" + str, true);
            xmlhttp.send();
        }
    }
</script>

</html>