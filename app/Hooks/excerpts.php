<?php

function excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'excerpt_length', 99 );

function remove_read_more( $more ) {
    return '';
}
add_filter( 'excerpt_more', 'remove_read_more', 99 );