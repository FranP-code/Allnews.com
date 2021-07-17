<link rel="stylesheet" href="news.css">

<body>

<header>
    <a href="index.php" class="name">
        <img class="logo" src="./img/logo.svg">
        <h1>AllNews.com</h1>
    </a>
</header>

<div class="all">
    <article>
            
            <?php

        require 'news_logic.php';

        check_news();

        ?>

    </article>
</div>

<div class="source">
    Autor: <b><?php echo $author;?></b> | Pagina fuente: <b><?php echo $page_source;?></b>
</div>


</body>