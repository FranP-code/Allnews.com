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

    check_news();
    
    $news_per_page = 10;

    $result = bring_the_news_back_home(1, $news_per_page);

    foreach ($result as $news ) {
        $id = $news[0];
        $title = $news[1];
        $frist_p = $news[2];
        $icon = $news[3];

        echo
            "<a href='news.php?id=$id' class='card-link'>
                <div class='card'>
                    <img src=$icon>
                        <div class='text'>
                            <h2>$title</h2>
                            <h3>$frist_p</h3>
                        </div>
                </div>
            </a>";
    }

    ?>

    <div class="card">
        <img src="./img/test.jpg">
        <div class="text">
            <h2>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis expedita repellendus sunt modi sint earum atque nihil porro neque, excepturi doloremque deserunt nesciunt nemo dolores, veniam error possimus non. Facere.</h2>
            <h3>Content... Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut numquam accusamus, voluptas vel et corrupti, dolore maxime ipsum veritatis quae obcaecati magni provident iure possimus praesentium animi debitis, quos consequuntur. Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, reprehenderit. Voluptatem inventore est necessitatibus blanditiis? Voluptatem pariatur fuga officiis minus, excepturi laudantium assumenda enim, rem officia quis obcaecati facilis consequuntur? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur facilis odio blanditiis perspiciatis quaerat quos magni dolor praesentium repellat officia fugit eum natus, impedit quis, quo optio? Similique, temporibus delectus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque dicta quia minima! Harum, alias maxime, architecto debitis distinctio amet assumenda, fugiat iure quis nesciunt ut laboriosam rem voluptatibus aspernatur nobis!</h3>
        </div>
    </div>
</div>

</body>
</html>

