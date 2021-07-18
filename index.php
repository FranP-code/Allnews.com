<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All news</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="./img/logo.svg">
</head>
<body>

<header>
    <a href="index.php" class="name">
        <img class="logo" src="./img/logo.svg">
        <h1>AllNews.com</h1>
    </a>
</header>

<noscript>
    <div class="noscript">
        Please, activate JavaScript for the correct functionality of the webpage.
    </div>
</noscript>


<div class="card-container">
    <?php

    require 'news_logic.php';

    $actual_page = 1;
    
    $news_per_page = 10;

    check_news($news_per_page, 'mySQLconnect.php');

    $result = bring_the_news_back_home($actual_page, $news_per_page, 'mySQLconnect.php');

    foreach ($result as $news ) {
        $id = $news[0];
        $title = $news[1];
        $frist_p = $news[2];
        $icon = $news[3];
        $source = $news[4];

        echo
            "<a href='news.php?id=$id' class='card-link'>
                <div class='card'>
                    <img src=$icon>
                        <div class='text'>
                            <h2>$title</h2>
                            <h3>$frist_p</h3>
                            <div class='source'>$source</div>
                        </div>
                </div>
            </a>";
    
        }

    ?>

<footer class="pagination">
    <?php

    $pages = glob('./pages/pages-*.php');
    $c = 0;

    foreach($pages as $page) {
        $c++;

        if ($c === $actual_page) {
            echo "
                <a class='page-disabled'>
                    <div class='page'>
                        $c
                    </div>
                </a>
            ";
        } else {
            echo "
                <a href='$page'>
                    <div class='page'>
                        $c
                    </div>
                </a>
            ";
        }
    }

    ?>
</footer>

</body>
</html>