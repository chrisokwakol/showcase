<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Log1x\Navi\Facades\Navi;

class Navigation extends Composer
{

	/**
	 * List of the ids for the navigations
	 *
	 * @var string
	 */
	public string $primary_id = 'primary_navigation';
	public string $utility_id = 'utility_navigation';
	public string $footer_main_id = 'footer_main_navigation';
	public string $footer_utility_id = 'footer_utility_navigation';
	public string $footer_bottom_id = 'footer_bottom_navigation';


	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.navigation.*',
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with()
	{
		return [
			'primary' => $this->getNavigation($this->primary_id),
			'utility' => $this->getNavigation($this->utility_id),
			'footer_main' => $this->getNavigation($this->footer_main_id),
			'footer_utility' => $this->getNavigation($this->footer_utility_id),
			'footer_bottom' => $this->getNavigation($this->footer_bottom_id),
		];
	}

	/**
	 * Get the navigation for a requested 
	 *
	 * @param string $nav_id
	 * @return void
	 */
	public function getNavigation(string $nav_id)
	{
		if (!$nav_id) return;

		$navigation = Navi::build($nav_id);

		if ($navigation->isEmpty()) {
			return;
		}

		return $navigation->toArray();
	}
}