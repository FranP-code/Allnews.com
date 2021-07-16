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
        case $news_unique === './news/xataka.html'|| $news_unique === './news/Xataka.html':
            return 'Xataka';
            break;
        
        case $news_unique === './news/genbeta.html' || $news_unique === './news/Genbeta.html':
            return 'Genbeta';
            break;
            
        default:
            return 0;
            break;
    }
}

function know_author($page, $news_unique) {
    $content = file_get_contents($news_unique);

    switch ($page) {
        case $page === 'Xataka':
            $frist_cut = get_string_between($content, '<a class="article-author-link" ', '</a>');
            $second_cut = strrchr($frist_cut, '>');
            return str_replace('>', '', $second_cut);
            break;
        
        case $page === 'Genbeta':
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
    //! CREDITS: https://stackoverflow.com/a/9826656
}

function create_entry_in_DB($news_unique, $page, $author) {
    require 'mySQLconnect.php';
    $content = file_get_contents($news_unique);

    switch ($page) {
        case $page === 'Xataka':
            $pre_title = get_string_between($content, '<h1>', '</h1>');
            $title = get_string_between($pre_title, '<span>', '</span>');
            $pre_icon = get_string_between($content, '<img alt=', '>');
            $icon = get_string_between($pre_icon, 'src=', ' ');
            $inner_HTML = get_string_between($content, '<div class="article-content">', '<div class="article-content-outer">') . '<script id="script-estructurator" src="./scripts/xataka.js"></script>';
            $frist_p = strip_tags(get_string_between($inner_HTML, '<p>', '</p>'));
            break;
        
        case $page === 'Genbeta':
            $pre_title = get_string_between($content, '<h1>', '</h1>');
            $title = get_string_between($pre_title, '<span>', '</span>');
            $pre_icon = get_string_between($content, '<img alt=', '>');
            $icon = get_string_between($pre_icon, 'src=', ' ');
            $inner_HTML = get_string_between($content, '<div class="article-content">', '<div class="article-content-outer">') . '<script id="script-estructurator" src="./scripts/genbeta.js"></script>';
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

    $prepared_query = $mySQLconnect -> prepare("select id, title, frist_paragraph, icon_route from noticias where id < ? and id > ?");
    $prepared_query -> bindParam(1, $frist_calc, PDO::PARAM_INT);
    $prepared_query -> bindParam(2, $second_calc, PDO::PARAM_INT);
    //$prepared_query -> execute(array($actual_page * 10, $actual_page * 10 - 10));

    $prepared_query -> execute();

    $return = $prepared_query -> fetchAll(); 
    
    return $return;
}

function bring_the_choosen_one($id) {
    require './mySQLconnect.php';

    $prepared_query = $mySQLconnect -> prepare('select * from noticias where id = ?');
    $prepared_query -> bindParam(1, $id, PDO::PARAM_INT);

    $prepared_query -> execute();

    $return = $prepared_query -> fetchAll();

    return $return;
}

?>