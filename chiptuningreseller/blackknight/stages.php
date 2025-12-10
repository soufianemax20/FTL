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
    var stagesTitle = `<p class="ctr-text-[40px] ctr-bg-[#0079d9] ctr-max-w-fit ctr-mx-auto ctr-rounded-lg ctr-p-2 ctr-mb-2">${chiptuningText}</p><p class="ctr-text-[30px] ctr-mb-8">${modelEngineText}</p>`;
    document.getElementById("ctr-stage-title").innerHTML = stagesTitle;
</script>

<!-- START NEW TEMPLATE -->
<div class="ctr-bg-white ctr-pt-9">
    <div class="ctr-max-w-[1440px] ctr-p-2 ctr-mx-auto ctr-bg-white">
        <div class="ctr-flex mobile:ctr-flex-col desktop:ctr-flex-row ctr-gap-4">
            <div class="ctr-w-full desktop:ctr-w-1/2 ctr-p-2 ctr-border ctr-rounded-lg">
                <div class="ctr-flex flex-col relative w-full overflow-hidden imgSectionHeight mb-8">
                    <img src="<?php if (isset($serie['media'])) {
                                    echo ctr_get_image_by_id($serie['media'][0]['id'], 'medium');
                                } ?>" class="ctr-pb-4 carImagePosition ctr-mx-auto">
                    <span class="ctr-absolute top-0 enginePhotoName opacity-30"><?php echo addslashes($engine['name']); ?></span>
                </div>
                <p class="rubik ctr-text-[#262626] ctr-text-[28px] ctr-font-semibold ctr-mb-4 ctr-mt-5">Manufacturing Defaults</p>
                <div><?php ctr_get_template('partials/engine-basic-data.php', ['engine' => $engine]); ?></div>
                <p class="rubik ctr-text-[#262626] ctr-text-[28px] ctr-font-semibold ctr-mb-4 ctr-mt-5">Tuning Performance</p>
                <div><?php ctr_get_template('partials/stage-table.php', ['stages' => $stages, 'show_price' => $show_price, 'currency' => $currency]); ?></div>
                <div>
                    <?php if ($show_ecu_info) {
                        ctr_get_template('partials/engine-metadata.php', ['metadata' => $engine['metadata']]);
                    } ?>
                </div>
            </div>
            <div class="ctr-w-full desktop:ctr-w-1/2 ctr-p-2 ctr-border ctr-rounded-lg">
                <div class="ctr-mb-10">
                    <?php if (get_option(CTR_OPT_PREFIX . 'show_dyno', false) == 'yes') {
                        ctr_get_template('partials/linechartHp.php', ['stages' => $stages]);
                    } ?>
                </div>
                <div class="">
                    <?php if (get_option(CTR_OPT_PREFIX . 'show_dyno', false) == 'yes') {
                        ctr_get_template('partials/linechartNm.php', ['stages' => $stages]);
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END NEW TEMPLATE -->
<style>
    .logoBackLight {
        box-shadow: 0px 0px 17px 6px rgba(80, 70, 228, 0.7);
    }

    .boxBackLight {
        box-shadow: 0px 4px 13px -6px rgba(80.00000000000036, 70.00000000000001, 228, 0.71);
    }

    .carImagePosition {
        margin-top: -100px;
    }

    .enginePhotoName {
        font-size: 20px;
    }

    .imgSectionHeight {
        height: 138px;
    }

    @media(min-width:481px) {
        .enginePhotoName {
            font-size: 34px;
        }

        .imgSectionHeight {
            height: 230px;
        }
    }

    @media(min-width:769px) {
        .carImagePosition {
            margin-top: -238px;
        }

        .imgSectionHeight {
            height: 310px;
        }
    }

    @media(min-width:976px) {
        .carImagePosition {
            margin-top: -380px;
        }

        .enginePhotoName {
            font-size: 40px;
        }
    }

    @media(min-width:1025px) {
        .carImagePosition {
            margin-top: -50px;
        }

        .imgSectionHeight {
            height: 330px;
        }
    }

    @media(min-width:1201px) {
        .carImagePosition {
            margin-top: -115px;
        }
    }
</style>
<!-- START TEMPLATE -->

<!-- END TEMPLATE -->