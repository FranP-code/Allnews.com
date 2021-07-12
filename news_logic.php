<?php

function check_news() {
    $news = glob('./news/*');

    print_r($news);
    echo '<br>';

    foreach ($news as $new) {
        if ($new !== './news/00_news_done.txt'){

            echo '<br>';

            echo 'NEW: ' . $new;

            echo '<br>';
    
            $news_done = file_get_contents('./news/00_news_done.txt');

            echo $news_done;
            echo '<br>';
    
            if (!strstr($news_done, $new)) {
                $author = know_autor($new); //! HACER FUNCION
                $create_entry($new, $author); //! HACER FUNCION
                file_put_contents($news_done, $new . '/n', FILE_APPEND);
            }

            /*if ($new is in $done) {
    
            }*/
        }
    }
}

?>