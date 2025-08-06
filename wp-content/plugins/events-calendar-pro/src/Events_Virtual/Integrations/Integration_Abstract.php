<?php

namespace TEC\Events_Virtual\Integrations;

use TEC\Common\Integrations\Integration_Abstract as Common_Integration_Abstract;

/**
 * Class Integration_Abstract
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 *
 * @link  https://docs.theeventscalendar.com/apis/integrations/including-new-integrations/
 *
 * @package TEC\Events\Integrations
 */
abstract class Integration_Abstract extends Common_Integration_Abstract {
	/**
	 * @inheritDoc
	 */
	public static function get_parent(): string {
		return 'events-virtual';
	}
}
