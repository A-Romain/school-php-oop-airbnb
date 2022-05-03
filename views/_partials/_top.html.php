<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/reset.css" rel="stylesheet">
    <title><?= $title_tag ?></title>
</head>
<body>

<header>
    <div class="container_header">
        <div class="logo">
            <img src="/assets/img/kamehouse.jpg">
        </div>
        <div class="nav_bar">
            <nav>
                <ul>
                    <li><a href="/annonces">Annonces</a> </li>
                    <li><a href="/reservation">Réservation</a></li>
                    <li><a href="/new-annonce">Ajout Annonce</a></li>
                    <?php
                        if (isset($_SESSION["user_id"])) {
                            ?>
                            <li><a href="/deconnexion">Deconnexion</a></li>
                            <?php
                        }
                        else {
                            ?>
                            <li><a href="/connexion">Connexion</a></li>
                            <?php
                        }
                    ?>
                </ul>
            </nav>
        </div>
        <div class="icon_co">
              <a href="/connexion"><img src="/assets/img/icon.png"></a>
        </div>
    </div>
</header>

<main>
