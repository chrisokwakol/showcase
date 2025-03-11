<?php

// namespace App;

// use WP_REST_Request;
// use WP_Error;
// use App\Providers\ListingServiceProvider;
// use App\Providers\AutocompleteServiceProvider;
// use App\Providers\ResourceStringProvider;

/**
 * Initialize REST API Routes
 *
 * @uses register_rest_route
 * @link https://developer.wordpress.org/reference/functions/register_rest_route/
 */
// add_action('rest_api_init', function () {

//     /**
//      * Howdy Route for saying hello!
//      */
//     register_rest_route('emerson/v1', '/listing', [
//         'methods' => 'POST',
//         'callback' => function (WP_REST_Request $request) {

//             $type = $request->get_param('type');
//             $json = $request->get_json_params();

//             $query = ListingServiceProvider::parseQueryBasedOnJSON($type, $json);

//             return ListingServiceProvider::getResults($query, $type);
//         },
//         'permission_callback' => function () {
//             return true;
//         },
//     ]);


//     register_rest_route('emerson/v1', '/autocomplete', [
//         'methods' => 'POST',
//         'callback' => function (WP_REST_Request $request) {

//             $jsonRequest = $request->get_json_params();

//             if(empty($jsonRequest['keyword'])) {
//                 return new WP_Error( 'no_keyword', 'No search keyword provided', array( 'status' => 400 ) );
//             }

//             return AutocompleteServiceProvider::getResults($jsonRequest);

//         },
//         'permission_callback' => function () {
//             return true;
//         },
//     ]);
// });
