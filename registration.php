<?php

include('config/db_connect.php');
include('models/User.php');

// promenljive u formi
$email = $username = $password = $confirmPassword = '';

// niz u kom će za svako polje biti ispisana greška prilikom validacije
$errors = ['email' => '', 'username' => '', 'password' => '', 'confirmPassword' => ''];

if (isset($_POST['registration'])) { // kada pritisnemo submit dugme sa nazivom registration

    if (empty($_POST['email'])) {  // provera da li je prazno polje
        $errors['email'] = 'Email is required!';  // greška koja se upisuje u niz grešaka
    } else {
        $email = $_POST['email']; // dodela vrednosti kako bi u slučaju ispravnosti forme ostala upisana za ponovni unos
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email address!';
        }
    }

    if (empty($_POST['username'])) {
        $errors['username'] = 'Username is required!';
    } else {
        $username = $_POST['username'];

        // provera da li već postoji korisničko ime koje je uneto
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $userWithSameUsername = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        if ($userWithSameUsername != null) { // ako niz nije prazan - imamo korisnike sa tim username
            $errors['username'] = "User with username $username already exists!";
        }
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required!';
    } else {
        $password = $_POST['password'];
        if (strlen($password) < 8) {   // provera da li je password kraći od 8 znakova
            $errors['password'] = 'Password must be at least 8 characters long!';
        }
    }

    if (empty($_POST['confirmPassword'])) {
        $errors['confirmPassword'] = 'Password confirmation is required!';
    } else {
        $confirmPassword = $_POST['confirmPassword'];
        if ($confirmPassword != $password) {   // provera da li se šifre slažu
            $errors['confirmPassword'] = 'Passwords do not match!';
            $confirmPassword = '';
            $password = '';
        }
    }

    if (!array_filter($errors)) {  // ako niz grešaka ima samo false vrednosti tj. prazne stringove 
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $newUser = new User(null, $email, $username, $password, null);
        $newUser->createUser();
    }
}


?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>

<section class="container">
    <h4 class="center">Create account to post comics</h4>

    <!-- FORM -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="white form" method="POST">
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>

        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
        <div class="red-text"><?php echo $errors['username']; ?></div>

        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
        <div class="red-text"><?php echo $errors['password']; ?></div>

        <label for="confirmPassword">Confirm password:</label>
        <input type="password" name="confirmPassword" value="<?php echo htmlspecialchars($confirmPassword); ?>">
        <div class="red-text"><?php echo $errors['confirmPassword']; ?></div>

        <div class="center">
            <input type="submit" name="registration" value="Create account" class="btn deep-purple darken-2 z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php') ?>

</html>