<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class ErrorPage extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        '404',
    ];

    /**
     * Return the properties to the blade template.
     *
     * @return array
     */
    public function with(): array
    {
        $args = ['page_id' => get_field('page_settings__error_page', 'option')];

        $errorPage = new WP_Query($args);

        return ['errorPage' => $errorPage];
    }
}
