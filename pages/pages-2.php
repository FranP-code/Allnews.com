<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All news</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="../img/logo.svg">
</head>
<body>

<header>
    <a href="../index.php" class="name">
        <img class="logo" src="../img/logo.svg">
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
        
        $actual_page = 2;
        require "../news_logic.php";
    
        $news_per_page = 10;
        $result = bring_the_news_back_home($actual_page, $news_per_page, "../mySQLconnect.php");
            
        
        
        require "template-code-blocks.php";
        
        foreach ($result as $news ) {
            $id = $news[0];
            $title = $news[1];
            $frist_p = $news[2];
            $icon = $news[3];
            $source = $news[4];

            echo card_code_block1($id, $icon, $title, $frist_p, $source);

        }

        ?>
        <footer class="pagination">
        <?php

        $pages = glob("./pages-*.php");
        $c = 0;
        
        foreach($pages as $page) {
            $c++;
    
            if ($c === $actual_page) {
                echo code_block2($c);
            } else {
                echo code_block3($page, $c);

            }
        }
            ?>
        </footer>

        </body>
        </html>
        