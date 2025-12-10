<?php
/**
 * Brands template
 *
 * This template can be overridden by copying it to yourtheme/chiptuningreseller/brands.php.
 *
 * @package     ChiptuningReseller\Templates
 * @version     6.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<!-- START TEMPLATE -->
<div class="ctr-container ctr-mx-auto">
    <p class="ctr-text-lg ctr-text-center"><?php _e('Select a brand', 'ctr'); ?></p>
    <div class="flex justify-around">
    <?php foreach($brands as $brand) { ?>
        <div class="p-4 m-4 text-center">
            <a href="<?php echo $brand['url']; ?>" class="ctr-basis-1/8 ctr-md:ctr-basis-1/4 ctr-text-gray-600 ctr-text-center">
            <img class="ctr-h-24 ctr-w-24 ctr-mx-auto ctr-mb-2" loading="lazy" data-src="<?php echo $brand['image_url']; ?>"  src="<?php echo $brand['image_url']; ?>" alt="<?php echo $brand['name']; ?>" title="<?php echo $brand['name']; ?>">
                <div><?php echo $brand['name']; ?></div>
            </a>
        </div>
    <?php } ?>
</div>
<div class="ctr-text-center ctr-mt-10">
    <a class="bg-white px-2 py-3 rounded-lg !no-underline text-[#f9876d] font-medium" href="<?php ctr_print_full_start_url(); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" style="width:16px; height:16px;display:inline-block" class="ctr--mt-1 ctr-mr-2 hover:fill-black fill-[#f9876d]" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
        <?php _e('Back to vehicle type selection', 'ctr'); ?>
    </a>
</div>
</div>
<!-- END TEMPLATE -->