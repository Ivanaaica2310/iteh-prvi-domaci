<?php

include('config/db_connect.php');

$query = "SELECT * FROM comic ORDER BY title ASC"; // upit za vracanje svih knjiga iz baze
$result = mysqli_query($conn, $query); // vracanje tabele za dati upit
$comics = mysqli_fetch_all($result, MYSQLI_ASSOC); // pretvaranje tabele u asoc niz
mysqli_free_result($result); // brisanje tabele iz memorije

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="container">
    <div class="row">
        <?php foreach ($comics as $comic) : ?>
            <div class="col s12 m6 l4 xl3">
                <div class="card z-depth-0 radius-card">
                    <img src="img/icon.png" alt="icon" class="icon-card">
                    <div class="card-content center">
                        <h5><?php echo htmlspecialchars($comic['title']); ?></h5>
                        <h6>By <?php echo htmlspecialchars($comic['author']); ?></h6>
                    </div>
                    <div class="card-action right-align radius-card">
                        <a href="comic.php?id=<?php echo $comic['id']; ?>" class="deep-purple-text text-darken-2">
                            More Info
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('templates/footer.php'); ?>

</html>