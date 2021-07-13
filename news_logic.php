<?php

error_reporting(~0);
ini_set('display_errors', 1);

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
                $page = know_page($new); //! HACER FUNCION
                echo $page;
                $author = know_author($page, $new);
                echo $author;
                //$create_entry_in_DB($new, $author); //! HACER FUNCION
                //file_put_contents($news_done, $new . '/n', FILE_APPEND);
            }

            /*if ($new is in $done) {
    
            }*/
        }
    }
}

function know_page($new) {
    switch ($new) {
        case './news/xataka.html'|| './news/Xataka.html':
            return 'Xataka';
            break;

        default:
            return 0;
            break;
    }
}

function know_author($page, $new) {
    $content = file_get_contents($new);

    switch ($page) {
        case 'Xataka':
            $frist_cut = get_string_between($content, '<a class="article-author-link" ', '</a>');
            $second_cut = strrchr($frist_cut, '>');
            return str_replace('>', '', $second_cut);
            break;
        
        default:
            return 0;
            break;
    }
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
    //! CREDITS: https://stackoverflow.com/questions/5696412/how-to-get-a-substring-between-two-strings-in-phphttps://stackoverflow.com/questions/5696412/how-to-get-a-substring-between-two-strings-in-php
}

/* 
switch ($variable) {
    case 'value':
        # code...
        break;
    
    default:
        # code...
        break;
}
*/

?>