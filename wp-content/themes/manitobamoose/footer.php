<?php
/**
 * Fallback footer template
 *
 * This file ensures compatibility with WooCommerce and any plugins
 * that require a default footer.php file.
 *
 * It loads modular parts using the BsWp utility.
 * See /external/bootstrap-utilities.php for details on BsWp::get_template_parts().
 *
 * @package     WordPress
 * @subpackage  Bootstrap 5.3.2
 */

$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>