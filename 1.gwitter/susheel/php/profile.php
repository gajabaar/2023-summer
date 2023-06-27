<?php
session_start();
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username; ?>/Gwitter</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/profile.css">

    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" crossorigin="anonymous">'



    <script src="../assets/js/profile.js" defer charset="utf-8">

    </script>
</head>

<body>

    <header>
        <!-- The <i> tag below includes the bullhorn icon from Font Awesome -->
        <a href="#">
            <h1 class="site-title"><i class="far fa-hand-lizard"></i> Gwitter</h1>
        </a>

        <nav class="navbar">
            <ul class="navlist">
                <li class="navitem navlink active"><a href="#">Home</a></li>
                <li class="navitem navlink"><a href="#">Trending</a></li>
                <li class="navitem navlink"><a href="#">People</a></li>
                <li class="navitem navbar-search">
                    <input type="text" id="navbar-search-input" placeholder="Search...">
                    <button type="button" id="navbar-search-button"><i class="fas fa-search"></i></button>
                </li>
            </ul>
        </nav>
    </header>

    <main class="twit-container">

        <article class="twit">
            <div class="twit-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div class="twit-content">
                <p class="twit-text">
                    Watching my web dev lecture... This class is so awesome!
                </p>
                <p class="twit-author">
                    <a href="#">CSMajor2020</a>
                </p>
            </div>
        </article>

        <article class="twit">
            <div class="twit-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div class="twit-content">
                <p class="twit-text">
                    Anyone missing baseball? It'd be fun to be able to watch the Beavs right now!
                </p>
                <p class="twit-author">
                    <a href="#">BeaverBeliever</a>
                </p>
            </div>
        </article>

        <article class="twit">
            <div class="twit-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div class="twit-content">
                <p class="twit-text">
                    A body in motion must remain in motion unless acted upon by an outside force.
                </p>
                <p class="twit-author">
                    <a href="#">NewtonRulez</a>
                </p>
            </div>
        </article>

        <article class="twit">
            <div class="twit-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div class="twit-content">
                <p class="twit-text">
                    Huh?
                </p>
                <p class="twit-author">
                    <a href="#">ConfusedTweeterer</a>
                </p>
            </div>
        </article>

        <article class="twit">
            <div class="twit-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div class="twit-content">
                <p class="twit-text">
                    Why did the calf cross the road?
                </p>
                <p class="twit-author">
                    <a href="#">Setup</a>
                </p>
            </div>
        </article>

        <article class="twit">
            <div class="twit-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div class="twit-content">
                <p class="twit-text">
                    To get to the udder side!
                </p>
                <p class="twit-author">
                    <a href="#">Punchline</a>
                </p>
            </div>
        </article>

        <article class="twit">
            <div class="twit-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div class="twit-content">
                <p class="twit-text">
                    Any questions about flexboxes?
                </p>
                <p class="twit-author">
                    <a href="#">Hess</a>
                </p>
            </div>
        </article>

        <article class="twit">
            <div class="twit-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div class="twit-content">
                <p class="twit-text">
                    Friendly reminder: your taxes were due yesterday.
                </p>
                <p class="twit-author">
                    <a href="#">TheIRS</a>
                </p>
            </div>
        </article>

    </main>

    <button type="button" id="create-twit-button"><i class="fas fa-bullhorn"></i></button>

    <div id="modal-backdrop" class="hidden"></div>
    <div id="create-twit-modal" class="hidden">
        <div class="modal-dialog">

            <div class="modal-header">
                <h3>Create a Gweet</h3>
                <button type="button" class="modal-close-button">&times;</button>
            </div>

            <div class="modal-body">
                <div class="twit-input-element">
                    <label for="twit-text-input">Twit text</label>
                    <textarea id="twit-text-input"></textarea>
                </div>
                <div class="twit-input-element">
                    <label for="twit-attribution-input">Author</label>
                    <input type="text" id="twit-attribution-input">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="modal-cancel-button">Cancel</button>
                <button type="button" class="modal-accept-button">Create Gweet</button>
            </div>

        </div>
    </div>

</body>

</html>