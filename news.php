<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="news.css">
    <title>
        <?php
            require 'news_logic.php';

            $requestFromDB = bring_the_choosen_one($_GET['id'], './mySQLconnect.php')[0];

            $title = $requestFromDB['title'];
            $content = $requestFromDB['content'];
            $author = $requestFromDB['author'];
            $page_source = $requestFromDB['page_source'];
            $icon_route = $requestFromDB['icon_route'];

            echo $title;
        ?>

    </title>
</head>
<body>
<header>
    <a href="index.php" class="name">
        <img class="logo" src="./img/logo.svg">
        <h1>AllNews.com</h1>
    </a>
</header>

    <div class="all">
        <h1><?php echo $title;?></h1>

        <article>
            <img src=<?php  echo $icon_route?>>
            <?php echo $content;?>
        </article>

    </div>

    <div class="source">
        <?php
            if ($author) {
                echo "Autor: <b>$author</b> | ";
            }

            echo "Pagina fuente: <b>$page_source</b>";

        ?>

        <!-- Autor: <b><?php echo $author;?></b> | Pagina fuente: <b><?php echo $page_source;?></b> -->
    </div>
</body>
</html>
