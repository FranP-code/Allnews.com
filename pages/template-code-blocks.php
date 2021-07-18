<?php
function card_code_block1($id, $icon, $title, $frist_p, $source) {
    return "<a href='../news.php?id=$id' class='card-link'>
                <div class='card'>
                    <img src=$icon>
                        <div class='text'>
                            <h2>$title</h2>
                            <h3>$frist_p</h3>
                            <div class='source'>
                            $source
                            </div>
                    </div>
            </div>
        </a>";
}

function code_block2($c) {
    return "
        <a class='page-disabled'>
            <div class='page'>
                $c
            </div>
        </a>
    ";
}

function code_block3($page, $c) {
    return "
        <a href='$page'>
            <div class='page'>
                $c
            </div>
        </a>
    ";
}
?>