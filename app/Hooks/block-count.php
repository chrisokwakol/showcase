<?php
// Add ability to count Gutenberg blocks
function count_blocks() {
    $allPosts       = get_posts(array('posts_per_page'=>-1,'post_type'=>'any','fields'=>'ids'));
    $blockCount     = [];
    $totalBlocks    = [];

    foreach($allPosts as $singlePostID) {
        $name       = get_the_title($singlePostID);
        $type       = get_post_type($singlePostID);
        $content    = get_post_field('post_content', $singlePostID);
        $blocks     = has_blocks($content) ? parse_blocks($content) : false;
        $permalink  = get_permalink($singlePostID);

        $postBlocks = [];
        if ($blocks) {
            foreach ($blocks as $block) {
                $blockName = $block['blockName'];
                if(!empty($blockName)) {
                    if (array_key_exists($blockName, $postBlocks)) {
                        $postBlocks[$blockName]++;
                    } else {
                        $postBlocks[$blockName]=1;
                    }
                    if (array_key_exists($blockName, $totalBlocks)) {
                        $totalBlocks[$blockName]++;
                    } else {
                        $totalBlocks[$blockName]=1;
                    }
                }
            }
        }

        $blockCount[] = [
            'name'      => $name,
            'type'      => $type,
            'page'      => $permalink,
            'blocks'    => $postBlocks
        ];
    }

    foreach ($blockCount as $item) {
        $emptyPage = count($item['blocks']) == 0 ? true : false;
        if ($emptyPage) { echo '<span style="opacity:0.5">'; }
            echo '<a href="'.$item['page'].'"><b>'.$item['name'].'</b></a> (<i>'.$item['type'].'</i>) - ';
            if ($emptyPage) {
                echo 'NONE';
            }
        if ($emptyPage) { echo '</span>'; }
        foreach($item['blocks'] as $blockName => $blockCount) {
            echo '[ '.$blockName.' : '.$blockCount.' ] ';
        }
        echo '<br>';
    }

    echo '<h2>Totals</h2>';
    foreach($totalBlocks as $blockName => $blockCount) {
        echo '[ '.$blockName.' : '.$blockCount.' ]<br>';
    }
}

// create admin page to see post count
add_action('admin_menu', 'block_count_add_page');
function block_count_add_page() {
    add_options_page('Gutenberg Block Count', 'Block Count', 'manage_options', 'block_count', 'block_count_page');
}

function block_count_page() {
?>
<div>
    <h2>Gutenberg Block Count</h2>
    <?php count_blocks(); ?>
</div>

<?php
}
