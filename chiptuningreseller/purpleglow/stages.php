<?php

/**
 * Stages template
 *
 * This template can be overridden by copying it to yourtheme/chiptuningreseller/stages.php.
 *
 * @package     ChiptuningReseller\Templates
 * @version     6.0.0
 *
 * AVAILABLE VARS:
 * $serie       Serie object
 *      $serie['image']         The image for the current serie
 *      $serie['name']          The name of the current serie
 *      $serie['slug']          The slug of the current serie
 * $brand       Brand object
 *      $brand['image']         The image for the current brand
 *      $brand['name']          The name of the current brand
 *      $brand['slug']          The slug of the current brand
 *
 * $model      Model object
 *      $model['image']         The image for the current model
 *      $model['name']          The name of the current model
 *      $model['slug']          The slug of the current model
 *
 * $engine     Engines object
 *      $engine['name']          The name of the current engine
 *      $engine['slug']          The slug of the current engine
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<script>
        var brandThumbnail = "<?php echo addslashes(ctr_get_image_by_url($brand['thumbnail'], 'thumb')); ?>";
        var chiptuningText = "<?php echo addslashes(__('Chiptuning for', 'ctr') . ' ' . $brand['name'] . ' ' . $serie['name']); ?>";
        var modelEngineText = "<?php echo addslashes($model['name'] . ' ' . $engine['name']); ?>";
        var stagesTitle = `<div><img class="w-28 h-28 ctr-rounded-full p-2 ctr-mx-auto mb-2 bg-white logoBackLight" src="${brandThumbnail}"></div><p class="text-[40px]">${chiptuningText}</p><p class="text-[30px]">${modelEngineText}</p>`;
        document.getElementById("ctr-stage-title").innerHTML = stagesTitle;
</script>
<!-- START NEW TEMPLATE -->
<div class="max-w-[1440px] py-1 ctr-mx-auto">
    <div class="flex flex-wrap p-2 gap-[2%]">
        <div class="w-full xl:w-[49%]">
            <div class="flex flex-col flex-wrap justify-center">
                <h3 class="rubik font-normal text-ctr-blue mt-8 mb-4 ml-2">Tuning Performance</h3>
                <div><?php ctr_get_template('partials/stage-table.php', ['stages' => $stages, 'show_price' => $show_price, 'currency' => $currency]); ?></div>
                <h3 class="rubik font-normal text-ctr-blue mt-8 mb-4 ml-2">Manufacturing Defaults</h3>
                <div><?php ctr_get_template('partials/engine-basic-data.php', ['engine' => $engine]); ?></div>
            </div>
        </div>
        <div class="flex flex-col w-full xl:w-[49%]">
        <img src="<?php if(isset($serie['media'])) { echo ctr_get_image_by_id($serie['media'][0]['id'], 'medium'); } ?>" class="ctr-pb-4" style="display: block; width: 100%; height: auto; margin: 0 auto; margin-top: -88px; padding: 34px;">
        </div>
    </div>
    <h3 class="rubik font-normal text-ctr-blue mt-8 mb-4 ml-4">Dyno Graphs</h3>
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="">
            <?php if(get_option(CTR_OPT_PREFIX . 'show_dyno', false) == 'yes') { ctr_get_template('partials/linechartHp.php', ['stages' => $stages]); } ?>

        </div>
        <div class="">
            <?php if(get_option(CTR_OPT_PREFIX . 'show_dyno', false) == 'yes') { ctr_get_template('partials/linechartNm.php', ['stages' => $stages]); } ?>
        </div>
    </div>
    <div>
    <?php if($show_ecu_info) { ctr_get_template('partials/engine-metadata.php', ['metadata' => $engine['metadata']]); } ?>
    </div>
</div>
<!-- END NEW TEMPLATE -->
<style>
    .logoBackLight {box-shadow: 0px 0px 17px 6px rgba(80, 70, 228, 0.7);}
    .boxBackLight {box-shadow: 0px 4px 13px -6px rgba(80.00000000000036, 70.00000000000001, 228, 0.71);}
</style>
<!-- START TEMPLATE -->

<!-- END TEMPLATE -->