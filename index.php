<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All news</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="name">
        <img class="logo" src="./img/logo.svg">
        <h1>AllNews.com</h1>
    </div>
</header>

<div class="card-container">
    <?php

    require 'mySQLconnect.php';
    require 'news_logic.php';

    check_news();

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

