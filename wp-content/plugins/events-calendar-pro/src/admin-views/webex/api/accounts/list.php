<?php
/**
 * View: Virtual Events Metabox Webex API account list.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/admin-views/webex/api/authorize-fields/add-link
 *
 * See more documentation about our views templating system.
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 *
 * @version 1.9.0
 *
 * @link    http://evnt.is/1aiy
 *
 * @var Api                 $api  An instance of the Webex API handler.
 * @var Url                 $url  An instance of the URL handler.
 * @var array<string|mixed> $list An array of the Webex accounts authorized for the site.
 */

if ( empty( $accounts ) ) {
	return;
}
?>
<ul>
	<?php foreach ( $accounts as $account_id => $account ) : ?>
		<li class="tec-settings-api-account-details tec-settings-webex-account-details tribe-common"
			data-account-id="<?php echo esc_attr( $account_id ); ?>"
		>
			<div class="tec-settings-api-account-details__account-name tec-settings-webex-account-details__account-name">
				<?php echo esc_html( $account['name'] ); ?>
			</div>
			<div class="tec-settings-api-account-details__refresh-account tec-settings-webex-account-details__refresh-account">
				<button
					class="tec-settings-api-account-details__account-refresh tec-settings-webex-account-details__account-refresh"
					type="button"
					data-api-refresh="<?php echo $url->to_authorize(); ?>"
					data-confirmation="<?php echo $api->get_confirmation_to_refresh_account(); ?>"
					<?php echo tribe_is_truthy( $account['status'] ) ? '' : 'disabled'; ?>
				>
					<?php $this->template( 'components/icons/refresh', [ 'classes' => [ 'tribe-events-virtual-virtual-event__icon-svg' ] ] ); ?>
					<span class="screen-reader-text">
						<?php echo esc_html_x( 'Refresh Webex Account', 'Refreshes a Webex account from the website.', 'tribe-events-calendar-pro' ); ?>
					</span>
				</button>
			</div>
			<div class="tec-settings-api-account-details__account-status tec-settings-webex-account-details__account-status">
				<?php
				$this->template( 'components/switch', [
					'id'            => 'account-status-' . $account_id,
					'label'         => _x( 'Toggle to Change Account Status', 'Disables the Webex Account for the Website.', 'tribe-events-calendar-pro' ),
					'classes_wrap'  => [ 'tec-events-virtual-meetings-api-control', 'tec-events-virtual-meetings-webex-control', 'tec-events-virtual-meetings-api-control--switch', 'tec-events-virtual-meetings-webex-control--switch' ],
					'classes_input' => [ 'account-status', 'tec-events-virtual-meetings-api-settings-switch__input', 'tec-events-virtual-meetings-webex-settings-switch__input' ],
					'classes_label' => [ 'tec-events-virtual-meetings-api-settings-switch__label', 'tec-events-virtual-meetings-webex-settings-switch__label' ],
					'name'          => 'account-status',
					'value'         => 1,
					'checked'       => $account['status'],
					'attrs'         => [
						'data-ajax-status-url' => $url->to_change_account_status_link( $account_id ),
					],
				] );
				?>
			</div>
			<div class="tec-settings-api-account-details__account-delete tec-settings-webex-account-details__account-delete">
				<button
					class="dashicons dashicons-trash tec-settings-api-account-details__delete-account tec-settings-webex-account-details__delete-account"
					type="button"
					data-ajax-delete-url="<?php echo $url->to_delete_account_link( $account_id ); ?>"
					data-confirmation="<?php echo $api->get_confirmation_to_delete_account(); ?>"
					<?php echo tribe_is_truthy( $account['status'] ) ? '' : 'disabled'; ?>
				>
					<span class="screen-reader-text">
						<?php echo esc_html_x( 'Remove Webex Account', 'Removes a Webex account from the website.', 'tribe-events-calendar-pro' ); ?>
					</span>
				</button>
			</div>
		</li>
	<?php endforeach; ?>
</ul>
