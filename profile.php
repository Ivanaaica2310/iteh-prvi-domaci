<?php

include('config/db_connect.php');

if (isset($_GET['id'])) {
    $userid = mysqli_real_escape_string($conn, $_GET['id']);
}


$query = "SELECT * FROM comic WHERE userid='$userid'";  // vadimo samo knjige ulogovanog korisnika
$result = mysqli_query($conn, $query);
$comics = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<?php if ($userid != $loggedId) : ?>

    <h1 class="center">You have no permission to view this profile!</h1>
    <div class="center">
        <a href="index.php" class="btn center deep-purple darken-2">Return</a>
    </div>

<?php elseif ($comics != null) : ?>

    <div class="container">
        <h2 class="center">Comics you've posted</h2>
        <div class="row">
            <?php foreach ($comics as $comic) : ?>
                <div class="col s12 m6 l4 xl3">
                    <div class="card z-depth-0 radius-card">
                        <img src="img/icon.png" alt="icon" class="icon-card">
                        <div class="card-content center">
                            <h5><?php echo htmlspecialchars($comic['title']); ?></h5>
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

<?php else : ?>

    <h1 class="center">You have not posted any comics!</h1>
    <div class="center">
        <a href="add.php" class="btn center deep-purple darken-2">Return</a>
    </div>

<?php endif; ?>

<?php include('templates/footer.php'); ?>

</html>