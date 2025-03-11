<?php

add_filter( 'relevanssi_comparison_order', function( $order ) {
    $order = array(
        'workshop' => 0,
        'resource' => 1,
        'page' => 2,
        'post' => 3,
    );
    return $order;
} );
