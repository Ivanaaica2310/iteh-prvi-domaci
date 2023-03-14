<?php

include('config/db_connect.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // uzimamo strip iz baze
    $query = "SELECT * FROM comic WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $comic = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    $userid = $comic['userid'];

    // uzimamo korisnika koji je postavio strip
    $query = "SELECT * FROM user WHERE id = $userid";
    $result = mysqli_query($conn, $query);
    $creator = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
}

if (isset($_POST['delete'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);

    $query = "DELETE FROM comic WHERE id = $id AND userid = $userid";
    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<?php if ($comic == null) : ?>
    <h1 class="center">There is no such comic!</h1>
    <div class="center">
        <a href="index.php" class="btn center deep-purple darken-2">Return</a>
    </div>

<?php else : ?>
    <div class="container center">
        <div class="card z-depth-0 radius-card" style="padding-bottom: 30px;">
            <img src="img/icon.png" alt="icon" class="icon-card">
            <h3><?php echo $comic['title']; ?></h3>
            <h4>Author:<?php echo $comic['author']; ?></h4>
            <h6 style="padding-left: 100px; padding-right:100px;"><?php echo $comic['abstract']; ?></h6>
            <h5>Genre: <?php echo $comic['genre']; ?></h5>
            <h5>Year: <?php echo $comic['year']; ?></h5>
            <h5>Price: $<?php echo $comic['price']; ?></h5>
            <h6>Posted at: <?php echo date($comic['created_at']); ?></h6>

            <?php if ($userid == $loggedId) { ?>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" style="padding-top:20px">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                    <input type="submit" name="delete" value="delete" class="btn center deep-purple darken-2">
                </form>

            <?php } else { ?>

                <h6>Posted by: <?php echo $creator['username']; ?></h6>

            <?php }; ?>


        </div>
    </div>

<?php endif; ?>

<?php include('templates/footer.php'); ?>

</html>