<?php

error_reporting(~0);
ini_set('display_errors', 1);

function check_news() {
    $news = glob('./news/*');

    foreach ($news as $news_unique) {
        $news_done = file_get_contents('./control-files/00_news_done.txt');
    
        if (!strstr($news_done, $news_unique)) {
            $page = know_page($news_unique);
            $author = know_author($page, $news_unique);
            create_entry_in_DB($news_unique, $page, $author);
        }
    }
}

function know_page($news_unique) {
    switch ($news_unique) {
        case './news/xataka.html'|| './news/Xataka.html':
            return 'Xataka';
            break;

        default:
            return 0;
            break;
    }
}

function know_author($page, $news_unique) {
    $content = file_get_contents($news_unique);

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

function create_entry_in_DB($news_unique, $page, $author) {
    require 'mySQLconnect.php';
    $content = file_get_contents($news_unique);

    switch ($page) {
        case 'Xataka':
            $pre_title = get_string_between($content, '<h1>', '</h1>');
            $title = get_string_between($pre_title, '<span>', '</span>');
            $pre_icon = get_string_between($content, '<img alt=', '>');
            $icon = get_string_between($pre_icon, 'src=', ' ');
            $inner_HTML = get_string_between($content, '<div class="article-content">', '<div class="article-content-outer">') . '<script id="script-estructurator" src="3lqzK81oyJW4C+q8OXEsRs7xuJco4Gz9ewZc993eBZwfxOqs3ToZOJ9KYmX5v0IEG83ds9TcRSvHyhztvNs9KyucmzRo7IxfonPGF+PFg99QZn3EOfTul3GeCApquf6/5WS70jg66hp3mYWfcpK5B5kbJWIF/NhXHUusw2jtsrw7MsZ0J3TzL0s/g9UZhj30/LtiHKDBL2nWtFVCo/MiOZcfRmMyFSi6QhJnoi7Ri5GcVHym6tCAUGXiPaAWEmikxfosgrUDyjUp4hCdos9jFEQO+G7DE50h3dKWIEKlrVPaDbygJA9d47TEvcSq7FTD1f3PnTeibUV+VBIi4ZgRpHrlk45FBUKvdxeGquoAvApW3734L0.js"></script>';
            $frist_p = strip_tags(get_string_between($inner_HTML, '<p>', '</p>'));
            break;
        
        default:
            echo 0;
            return 0;
            break;
    }

    $insert_news = $mySQLconnect -> prepare('insert into noticias (title, content, icon_route, page_source, author, frist_paragraph) values (?, ?, ?, ?, ?, ?)');

    $insert_news -> bindParam(1, $title, PDO::PARAM_STR);
    $insert_news -> bindParam(2, $inner_HTML, PDO::PARAM_STR);
    $insert_news -> bindParam(3, $icon, PDO::PARAM_STR);
    $insert_news -> bindParam(4, $page, PDO::PARAM_STR);
    $insert_news -> bindParam(5, $author, PDO::PARAM_STR);
    $insert_news -> bindParam(6, $frist_p, PDO::PARAM_STR);
    
    $insert_news -> execute();

    $ids_done = file_get_contents('./control-files/00_ids_done.txt');
    $num = $ids_done + 1;
    file_put_contents('./control-files/00_ids_done.txt', $num);
    rename($news_unique,"./news/$num.html");
    file_put_contents('./control-files/00_news_done.txt', " ./news/$num.html", FILE_APPEND);

}

function bring_the_news_back_home($actual_page, $news_per_page) {
    require './mySQLconnect.php';

    $frist_calc = $actual_page * $news_per_page;
    $second_calc = ($actual_page * $news_per_page) - $news_per_page;

    $prepared_query = $mySQLconnect -> prepare("select title, frist_paragraph, icon_route from noticias where id < ? and id > ?");
    $prepared_query -> bindParam(1, $frist_calc, PDO::PARAM_INT);
    $prepared_query -> bindParam(2, $second_calc, PDO::PARAM_INT);
    //$prepared_query -> execute(array($actual_page * 10, $actual_page * 10 - 10));

    $prepared_query -> execute();

    $return = $prepared_query -> fetchAll(); 
    
    return $return;
}

?>