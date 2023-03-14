<?php

include('config/session.php');

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: login.php');
}

?>

<head>
    <title>ComicShop</title>
    <linK rel="icon" href="img/icon.png">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .title-text {
            font-size: xx-large;
        }

        .nav-text {
            font-size: large;
            font-weight: 600;
        }

        .icon-card {
            width: 100px;
            margin: 40px auto -30px;
            display: block;
            position: relative;
            top: -30px;
        }

        .radius-card {
            border-radius: 20px;
        }

        .form {
            padding: 10px;
            margin-left: 25%;
            width: 50%;
            text-align: center;
            border-radius: 15px;
        }
    </style>
</head>

<body class=" deep-purple lighten-5">
    <nav class=" deep-purple darken-3">
        <div class="container">
            <a href="index.php" class="title-text">ComicShop</a>

            <?php if ($loggedId != 0) : ?>
                <ul class="right hide-on-small-and-down navul">
                    <li>Hi, <?php echo $loggedUsername ?></li>
                    <li>
                        <a href="profile.php?id=<?php echo $loggedId ?>" class="btn white deep-purple-text nav-text z-depth-0">
                            Your profile
                        </a>
                    </li>
                    <li>
                        <a href="add.php" class="btn white deep-purple-text nav-text z-depth-0">
                            Add a comic
                        </a>
                    </li>
                    <li style="padding-left: 15px;">
                        <form action="" method="POST">
                            <input type="submit" name="logout" value="logout" class="btn white deep-purple-text nav-text z-depth-0">
                        </form>
                    </li>
                </ul>
            <?php else : ?>
                <ul class="right hide-on-small-and-down navul">
                    <li>
                        <a href="registration.php" class="btn white deep-purple-text nav-text z-depth-0">
                            Register
                        </a>
                    </li>
                    <li>
                        <a href="login.php" class="btn white deep-purple-text nav-text z-depth-0">
                            Login
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </nav>