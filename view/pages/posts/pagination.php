<div class="pagination">
    <div class="pages_number">
        <?php 
        $limit = empty($_GET["limit"]) || !is_numeric($_GET["limit"]) ? 20 : intval($_GET["limit"]);
        $offset = empty($_GET["offset"]) || !is_numeric($_GET["offset"]) ? 0 : intval($_GET["offset"]);
        $posts_length = $Post->length();
        $number_of_pages = intdiv($posts_length, $limit) + 1;
        $current_page = intdiv($offset, $limit) + 1;
        $prev_page_offset = (intdiv($offset, $limit) - 1)*$limit;
        $next_page_offset = (intdiv($offset, $limit) + 1)*$limit;
        $begin_page = $current_page - 5 < 1 ? 1 : $current_page - 5;
        $end_page = $current_page + 5 > $number_of_pages ? $number_of_pages : $current_page + 5;
        $prev_prev_page_offset = ($begin_page-1) * $limit;
        $next_next_page_offset = ($end_page-1)* $limit;
        if ($prev_page_offset >= 0) {
            echo "<a href='" . ROOT_PATH . '/posts.php?limit=' . $limit . '&offset=' . $prev_prev_page_offset ."' 
            class='page_number'>
                <span class='material-symbols-outlined'>skip_previous</span>
            </a>";
            echo "<a href='" . ROOT_PATH . '/posts.php?limit=' . $limit . '&offset=' . $prev_page_offset ."' 
            class='page_number'>
                <span class='material-symbols-outlined' style='transform:rotate(180deg)'>navigate_next</span>
            </a>";
        }

        ?>
        <?php for ($i=$begin_page; $i <= $end_page; $i++) { 
            $page_offset = ($i - 1) * $limit;
        ?>    
            <a 
            href="<?= ROOT_PATH . '/posts.php?limit=' . $limit . '&offset=' . $page_offset ?>" 
            class="page_number <?= $current_page==$i?'current_page':'' ?>">
                <?= $i ?>
            </a>
    
        <?php } ?>
        <?php
        if ($next_page_offset < $posts_length) {
                echo "<a href='" . ROOT_PATH . '/posts.php?limit=' . $limit . '&offset=' . $next_page_offset ."' 
                class='page_number'>
                    <span class='material-symbols-outlined'>navigate_next</span>
                </a>";
                echo "<a href='" . ROOT_PATH . '/posts.php?limit=' . $limit . '&offset=' . $next_next_page_offset ."' 
                class='page_number'>
                    <span class='material-symbols-outlined'>skip_next</span>
                </a>";
            }
        ?>
    </div>
</div>