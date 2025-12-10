<?php
/**
 * The main displaying template
 *
 * This template can be overridden by copying it to yourtheme/chiptuningreseller/vehicle_types.php.
 *
 * @package     ChiptuningReseller\Templates
 * @version     6.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if(isset($vehicle_types)) {
    $page_title = "lulu"; // Get the current page title
?>


<!-- START TEMPLATE -->
<div class="ctr-container ctr-mx-auto">
<?php ctr_get_template('partials/breadcrumbs.php', []); ?>
    <div class="my-20">
        <?php echo do_shortcode("[ctr_show_selector]"); ?>
    </div>
</div>
<!-- END TEMPLATE -->
<?php
}
?>