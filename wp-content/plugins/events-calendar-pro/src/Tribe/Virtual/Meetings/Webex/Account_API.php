<?php
/**
 * Manages all the Account Connection to Webex
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 *
 * @package Tribe\Events\Virtual\Meetings\Webex
 */

namespace Tribe\Events\Virtual\Meetings\Webex;

use Tribe\Events\Virtual\Integrations\Abstract_Account_Api;

/**
 * Class Account_API
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 *
 * @package Tribe\Events\Virtual\Meetings\Webex
 */
abstract class Account_API extends Abstract_Account_Api {

	/**
	 * {@inheritDoc}
	 */
	protected $all_account_key = 'tec_webex_accounts';

	/**
	 * {@inheritDoc}
	 */
	protected $single_account_prefix = 'tec_webex_account_';

	/**
	 * The name of the action used to generate the OAuth authentication URL.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 * @deprecated 1.13.0 - Use Actions::$authorize_nonce_action.
	 *
	 * @var string
	 */
	public static $authorize_nonce_action = 'events-virtual-meetings-webex-oauth-authorize';

	/**
	 * {@inheritDoc}
	 */
	protected $account_id_meta_field_name = '_tribe_events_webex_account_id';

	/**
	 * {@inheritDoc}
	 * @deprecated 1.13.0 - Use Actions::$select_action.
	 */
	public static $select_action = 'events-virtual-webex-account-setup';

	/**
	 * {@inheritDoc}
	 * @deprecated 1.13.0 - Use Actions::$status_action.
	 */
	public static $status_action = 'tec-events-virtual-meetings-webex-settings-status';

	/**
	 * {@inheritDoc}
	 * @deprecated 1.13.0 - Use Actions::$delete_action.
	 */
	public static $delete_action = 'tec-events-virtual-meetings-webex-settings-delete';

	/**
	 * {@inheritDoc}
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @var string
	 */
	public $access_token;

	/**
	 * {@inheritDoc}
	 */
	protected function revoke_account_by_id( $account_id ) {
		$revoked = false;

		// Load account and get a valid not expired token as only those can be revoked.
		$account_loaded = $this->load_account_by_id( $account_id );
		if ( empty( $account_loaded ) ) {
			return $revoked;
		}

		$revoke_url = Url::$revoke_url;
		if ( defined( 'TEC_VIRTUAL_EVENTS_WEBEX_API_REVOKE_URL' ) ) {
			$revoke_url = TEC_VIRTUAL_EVENTS_WEBEX_API_REVOKE_URL;
		}

		$this->post(
			$revoke_url,
			[
				'headers' => [
					'Authorization' => $this->get_token_authorization_header(),
				],
				'body'    => [
					'token' => $this->access_token,
				],
			],
			Api::OAUTH_POST_RESPONSE_CODE
		)->then(
			function ( array $response ) use ( &$revoked ) {
				$body     = json_decode( wp_remote_retrieve_body( $response ), true );
				$body_set = $this->has_proper_response_body( $body, [ 'status' ] );
				if (
					! (
						$body_set
						&& 'success' === $body['status']
					)
				) {
					do_action( 'tribe_log', 'error', __CLASS__, [
						'action'   => __METHOD__,
						'message'  => 'Webex Account Revoke Failed.',
						'response' => $body,
					] );

					return $revoked;
				}

				$revoked = true;

				return $revoked;
			}
		);

		return $revoked;
	}

	/**
	 * Handles an OAuth authorization return request.
	 *
	 * The method will `wp_die` if the nonce is not valid.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @param string|null $nonce The nonce string to authorize the authorization request.
	 *
	 * @return bool Whether the authorization request is valid and was handled or not.
	 */
	public function handle_auth_request( $nonce = null ) {
		if ( ! wp_verify_nonce( $nonce, $this->actions::$authorize_nonce_action ) ) {
			wp_die( _x(
					'You are not authorized to do this.',
					'The message shown to a user providing a wrong Webex API OAuth authorization nonce.',
					'tribe-events-calendar-pro'
				)
			);
		}
		$handled = false;

		// This is response from our OAuth proxy service.
		$service_response_body = tribe_get_request_var( 'response_body', false );
		if ( $service_response_body ) {
			$this->save_account( [ 'body' => base64_decode( $service_response_body ) ] );

			$handled = true;
		}

		wp_safe_redirect( Settings::admin_url() );

		return $handled;
	}

	/**
	 * {@inheritDoc}
	 */
	public function save_account( array $response ) {
		if ( ! $this->has_proper_credentials( $response ) ) {
			do_action( 'tribe_log', 'error', __CLASS__, [
				'action'  => __METHOD__,
				'code'    => wp_remote_retrieve_response_code( $response ),
				'message' => 'Response body missing or malformed',
			] );

			return false;
		}

		// Set the access token here as we have to call fetch_user immediately, to get the user information.
		$credentials   = json_decode( wp_remote_retrieve_body( $response ), true );
		$access_token  = $credentials['access_token'];
		$refresh_token = $credentials['refresh_token'];
		$expiration    = $this->get_expiration_time_stamp( $credentials['expires_in'] );

		// Get the user who authorized the account.
		$user_fields = $this->fetch_user( 'me', false, $access_token );
		if ( empty( $user_fields['id'] ) ) {
			return false;
		}

		$user = [
			'id'    => $user_fields['id'],
			'name'  => $user_fields['displayName'],
			'email' => isset( $user_fields['emails'][0] ) ? $user_fields['emails'][0] : '',
		];

		$account_data     = $this->prepare_account_data( $user, $access_token, $refresh_token, $expiration, [], true );
		$existing_account = $this->get_account_by_id( $account_data['id'] );
		$this->set_account_by_id( $account_data );

		$message = $existing_account ?
			sprintf(
				/* Translators: %1$s: the name of the account that has been added or refreshed from Webex . */
				_x(
					'Webex connection refreshed for %1$s',
					'The refresh message for a Webex account.',
					'tribe-events-calendar-pro'
				),
				$account_data['name']
			)
			: sprintf(
					/* Translators: %1$s: the name of the account that has been added or refreshed from Webex . */
					_x(
						'Webex Account added for %1$s',
						'The Webex account added message.',
						'tribe-events-calendar-pro'
					),
					$account_data['name']
			);

		/** @var \Tribe__Cache $cache */
		$cache = tribe( 'cache' );
		$cache->set_transient( Settings::$option_prefix . 'account_message', $message, MINUTE_IN_SECONDS );

		return $access_token;
	}

	/**
	 * {@inheritDoc}
	 */
	public function save_access_and_expiration( $id, array $response ) {
		if ( ! $this->has_proper_credentials( $response ) ) {
			do_action( 'tribe_log', 'error', __CLASS__, [
				'action'  => __METHOD__,
				'code'    => wp_remote_retrieve_response_code( $response ),
				'message' => 'Response body missing or malformed',
			] );

			return false;
		}

		$credentials   = json_decode( wp_remote_retrieve_body( $response ), true );
		$access_token  = $credentials['access_token'];
		$refresh_token = $credentials['refresh_token'];
		$expiration    = $this->get_expiration_time_stamp( $credentials['expires_in'] );

		$this->set_account_access_by_id( $id, $access_token, $refresh_token, $expiration );

		return true;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function prepare_account_data( $user, $access_token, $refresh_token, $expiration, $settings, $status ) {
		return [
			'id'            => $user['id'],
			'name'          => $user['name'],
			'email'         => $user['email'],
			'access_token'  => $access_token,
			'refresh_token' => $refresh_token,
			'expiration'    => $expiration,
			'status'        => $status,
		];
	}
}
