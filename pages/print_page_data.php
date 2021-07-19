<?php

function php_code($num_page, $news_per_page){

    error_reporting(null);
    return array(
        '
        <?php
        
        $actual_page = ', "$num_page;
        ",
    
        'require "../news_logic.php";
    
        $news_per_page = ', "$news_per_page;",

        '
        $result = bring_the_news_back_home($actual_page, $news_per_page, "../mySQLconnect.php");

        if (count($result) <= 3) {
            echo "<style>html {
                background: rgb(157,211,255);
            }</style>";
        }
            
        ',

        '
        
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
        <footer class="pagination">',

        '
        <?php

        $pages = glob("./pages-*.php");
        $c = 0;
        ',

        '
        foreach($pages as $page) {
            $c++;
    
            if ($c === $actual_page) {
                echo code_block2($c);
            } else {
                echo code_block3($page, $c);

            }
        }
            ?>
        ',

        '</footer>

        </body>
        </html>
        '
            
    );
}

?>