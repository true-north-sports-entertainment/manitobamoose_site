<?php
/**
 * Class Tribe__Events__Filterbar__Plugin_Register
 */
class Tribe__Events__Filterbar__Plugin_Register extends Tribe__Abstract_Plugin_Register {

	protected $main_class   = 'Tribe__Events__Filterbar__View';
	protected $dependencies = [
		'parent-dependencies' => [
			'Tribe__Events__Main' => '6.7.0-dev',
		],
	];

	public function __construct() {
		$this->base_dir = TRIBE_EVENTS_FILTERBAR_FILE;
		$this->version  = Tribe__Events__Filterbar__View::VERSION;

		$this->register_plugin();
	}
}
