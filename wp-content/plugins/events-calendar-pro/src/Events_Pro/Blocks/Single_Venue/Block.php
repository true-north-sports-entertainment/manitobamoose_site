<?php
/**
 * Block: Single Venue
 */

namespace TEC\Events_Pro\Blocks\Single_Venue;

/**
 * Class Block
 *
 * @since 6.3.2
 *
 * @package TEC\Events_Pro\Blocks\Single_Venue
 */
class Block extends \Tribe__Editor__Blocks__Abstract {
	/**
	 * @since 6.3.2
	 *
	 * @var string The namespace of this template.
	 */
	protected $namespace = 'tec';

	/**
	 * Returns the name/slug of this block.
	 *
	 * @since 6.3.2
	 *
	 * @return string The name/slug of this block.
	 */
	public function slug(): string {
		return 'single-venue';
	}

	/**
	 * Set the default attributes of this block.
	 *
	 * @since 6.3.2
	 *
	 * @return array<string,mixed> The array of default attributes.
	 */
	public function default_attributes(): array {
		return [ 'className' => '' ];
	}

	/**
	 * Since we are dealing with a Dynamic type of Block we need a PHP method to render it.
	 *
	 * @since 6.3.2
	 *
	 * @param array $attributes The block attributes.
	 *
	 * @return string The block HTML.
	 */
	public function render( $attributes = [] ): string {
		$args['attributes'] = $this->attributes( $attributes );

		// Add the rendering attributes into global context.
		tribe( 'events.editor.template' )->add_template_globals( $args );

		return tribe( 'events.editor.template' )->template( [ 'blocks', $this->slug() ], $args, false );
	}
}
