<?php
/**
 * Provides methods to route requests using nonce-based routes to identify the kind of request.
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 *
 * @package Tribe\Events\Virtual\Traits
 */

namespace Tribe\Events\Virtual\Traits;

use Tribe\Events\Virtual\Plugin;

/**
 * Trait With_Nonce_Routes
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 *
 * @package Tribe\Events\Virtual\Traits
 */
trait With_Nonce_Routes {

	/**
	 * Routes a request to the admin area only if the user can manage the site options.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @param array<string,callable>    $routes A map of the routes to handle, from nonce actions to the callables
	 *                                              that should handle each.
	 * @param string                    ...$caps One or more capabilities the current user should possess to proceed
	 *                                              with the routing.
	 *
	 * @return false|callable The callback that will be used to handle the route, or `false` to indicate a no match.
	 */
	public function route_admin_by_nonce( array $routes, ...$caps ) {
		$routes = array_filter( $routes, 'is_callable' );

		if ( empty( $routes ) ) {
			// Let's not even start dealing with it if no route handler is callable.
			return false;
		}

		if ( ! current_user_can( ...$caps ) ) {
			return false;
		}

		$nonce = tribe_context()->get( 'events_virtual_request' );

		if ( ! is_string( $nonce ) || empty( $nonce ) || ! is_admin() || ! current_user_can( ...$caps ) ) {
			return false;
		}


		return $this->route_by_nonce( $routes, $nonce );

	}

	/**
	 * Routes a request to the admin area ignoring capabilities.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @param array<string,callable> $routes A map of the routes to handle, from nonce actions to the callables
	 *                                              that should handle each.
	 *
	 * @return false|callable The callback that will be used to handle the route, or `false` to indicate a no match.
	 */
	public function public_route_by_nonce( array $routes ) {
		$routes = array_filter( $routes, 'is_callable' );

		if ( empty( $routes ) ) {
			// Let's not even start dealing with it if no route handler is callable.
			return false;
		}

		$nonce = tribe_context()->get( 'events_virtual_request' );

		if ( empty( $nonce ) || ! is_string( $nonce ) ) {
			return false;
		}

		return $this->route_by_nonce( $routes, $nonce );
	}

	/**
	 * Routes a request to the admin area ignoring capabilities.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @param string                    $nonce Nonce to be validated.
	 *
	 * @param array<string,callable>    $routes A map of the routes to handle, from nonce actions to the callables
	 *                                              that should handle each.
	 *
	 * @return false|callable The callback that will be used to handle the route, or `false` to indicate a no match.
	 */
	private function route_by_nonce( array $routes, string $nonce ) {

		// Remove the query arguments from the `$_SERVER['REQUEST_URI']` to avoid issues.
		if ( isset( $_SERVER[ 'REQUEST_URI' ] ) ) {
			$_SERVER[ 'REQUEST_URI' ] = remove_query_arg( [
				Plugin::$request_slug,
			], $_SERVER[ 'REQUEST_URI' ] );
		}

		$callback = false;
		$handler  = false;
		foreach ( $routes as $nonce_action => $callback ) {
			if ( ! is_callable( $callback ) ) {
				// There are legitimate reasons why this might not be a valid callback, just move on.
				continue;
			}

			if ( wp_verify_nonce( $nonce, $nonce_action ) ) {
				$handler = static function () use ( $callback, $nonce ) {
					return $callback( $nonce );
				};
				break;
			}
		}

		if ( false === $handler ) {
			return false;
		}

		add_action( 'admin_init', $handler );

		return $callback;
	}
}
