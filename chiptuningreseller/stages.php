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
<!-- START TEMPLATE: Stages Cyberpunk Dashboard -->
<!-- Schema: Product/Service Context -->
<div class="ctr-container ctr-mx-auto px-4 py-8" itemscope itemtype="https://schema.org/Product">

    <?php ctr_get_template('partials/breadcrumbs.php', ['vehicle_type' => $vehicle_type, 'brand' => $brand, 'serie' => $serie, 'model' => $model, 'engine' => $engine, 'stages' => $stages]); ?>

    <!-- Header -->
    <header class="text-center mb-12 relative">
        <h1 class="text-2xl md:text-4xl font-black italic uppercase text-white mb-2" style="font-family: 'Orbitron', sans-serif;" itemprop="name">
            <span class="text-gray-500 text-lg md:text-xl block mb-2 font-bold not-italic tracking-widest uppercase">
                <span itemprop="brand"><?php echo esc_html($brand['name']); ?></span> <span itemprop="model"><?php echo esc_html($model['name']); ?></span>
            </span>
            <span class="text-[#ccff00] drop-shadow-[0_0_10px_rgba(204,255,0,0.5)]">System Upgrade</span> Available
        </h1>
        <div class="h-1 w-32 bg-gradient-to-r from-transparent via-[#ccff00] to-transparent mx-auto opacity-80"></div>
    </header>

    <div class="grid lg:grid-cols-3 gap-8">

        <!-- col-1: Vehicle Identity Card -->
        <div class="lg:col-span-1">
            <div class="bg-[#0b0f19] border border-white/10 rounded-xl p-6 relative overflow-hidden sticky top-8">
                <!-- Decorative elements removed -->

                <div class="relative z-10 text-center">
                    <div class="inline-block p-4 rounded-full bg-white/5 border border-white/10 mb-6 relative group">
                        <div class="absolute inset-0 rounded-full bg-[#ccff00]/20 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <img class="w-32 h-32 object-contain filter drop-shadow-[0_0_15px_rgba(0,0,0,0.5)]"
                             src="<?php ctr_get_image_by_url($brand['thumbnail'], 'thumb'); ?>"
                             alt="<?php echo esc_attr($brand['name']); ?> Logo"
                             width="128" height="128" itemprop="image">
                    </div>

                    <div class="text-2xl font-bold text-white mb-1 font-orbitron">
                        <?php echo esc_html($brand['name']); ?> <?php echo esc_html($model['name']); ?>
                    </div>
                    <div class="text-[#ccff00] font-mono text-sm tracking-widest uppercase mb-6 border-b border-white/10 pb-4">
                        <?php echo esc_html($serie['name']); ?>
                    </div>

                    <div class="text-left space-y-3 font-mono text-sm text-gray-400">
                        <div class="flex justify-between items-center border-b border-white/5 pb-2">
                            <span>Engine</span>
                            <span class="text-white font-bold text-right"><?php echo esc_html($engine['name']); ?></span>
                        </div>
                    <?php
                    // Safe check for Engine Code
                    $engine_code = '';
                    if (is_object($engine) && isset($engine->code)) {
                        $engine_code = $engine->code;
                    } elseif (is_array($engine) && isset($engine['code'])) {
                        $engine_code = $engine['code'];
                    }

                    if (!empty($engine_code)) : ?>
                        <div class="flex justify-between items-center border-b border-white/5 pb-2">
                            <span>Engine Code</span>
                            <span class="text-white font-bold text-right"><?php echo esc_html($engine_code); ?></span>
                        </div>
                    <?php endif; ?>
                        <div class="flex justify-between items-center border-b border-white/5 pb-2">
                            <span>Fuel</span>
                            <span class="text-[#ccff00]"><?php _e($engine['fuel_type'], 'ctr'); ?></span>
                        </div>

                        <!-- Standard Engine Data -->
                         <div class="pt-4">
                            <?php ctr_get_template('partials/engine-basic-data.php', ['engine' => $engine, 'serie' => $serie, 'model' => $model]); ?>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Image if available -->
                <?php
                    // Init
                    $vehicle_img_src = '';
                    $real_car_found = false;

                    // Helper to safely get image without echo
                    function safe_ctr_get_image($id, $size) {
                        ob_start();
                        $res = ctr_get_image_by_id($id, $size);
                        $out = ob_get_clean();
                        return !empty($res) ? $res : $out;
                    }

                    // 1. Serie Media (ID or URL)
                    if (!empty($serie['media']) && isset($serie['media'][0])) {
                         // Check ID first
                         if (!empty($serie['media'][0]['id'])) {
                            ob_start();
                            $api_thumb = ctr_get_image_by_id($serie['media'][0]['id'], 'medium');
                            $potential_echo = ob_get_clean();

                            if (!empty($api_thumb)) {
                                $vehicle_img_src = $api_thumb;
                                $real_car_found = true;
                            } elseif (!empty($potential_echo) && strpos($potential_echo, 'http') !== false) {
                                $vehicle_img_src = strip_tags($potential_echo);
                                $real_car_found = true;
                            }
                         }
                         // Check URL if ID failed
                         if (!$real_car_found && !empty($serie['media'][0]['url'])) {
                             $vehicle_img_src = $serie['media'][0]['url'];
                             $real_car_found = true;
                         }
                    }


                    // 2. Serie Image string
                    if (!$real_car_found && !empty($serie['image'])) {
                         ob_start();
                         ctr_get_image_by_url($serie['image'], 'large');
                         $resolved_url = ob_get_clean();

                         if (!empty($resolved_url)) {
                             $vehicle_img_src = $resolved_url;
                             $real_car_found = true;
                         } elseif (strpos($serie['image'], 'http') !== false) {
                              $vehicle_img_src = $serie['image'];
                              $real_car_found = true;
                         }
                    }

                    // 2b. Serie Thumbnail / Image URL (New Checks)
                    if (!$real_car_found) {
                        $keys_to_check = ['thumbnail', 'image_url', 'img_url'];
                        foreach ($keys_to_check as $key) {
                            if (!empty($serie[$key])) {
                                ob_start();
                                ctr_get_image_by_url($serie[$key], 'large');
                                $res_url = ob_get_clean();
                                if (!empty($res_url)) {
                                    $vehicle_img_src = $res_url;
                                    $real_car_found = true;
                                    break;
                                } elseif (strpos($serie[$key], 'http') !== false) {
                                    $vehicle_img_src = $serie[$key];
                                    $real_car_found = true;
                                    break;
                                }
                            }
                        }
                    }

                    // 3. Model Media (ID or URL)
                    if (!$real_car_found && !empty($model['media']) && isset($model['media'][0])) {
                        if (!empty($model['media'][0]['id'])) {
                            ob_start();
                            $api_model = ctr_get_image_by_id($model['media'][0]['id'], 'medium');
                            $echo_model = ob_get_clean();
                            if (!empty($api_model)) {
                                $vehicle_img_src = $api_model;
                                $real_car_found = true;
                            } elseif (!empty($echo_model) && strpos($echo_model, 'http') !== false) {
                                $vehicle_img_src = strip_tags($echo_model);
                                $real_car_found = true;
                            }
                        }
                        if (!$real_car_found && !empty($model['media'][0]['url'])) {
                             $vehicle_img_src = $model['media'][0]['url'];
                             $real_car_found = true;
                         }
                    }

                     // 4. Model Image string
                    if (!$real_car_found && !empty($model['image'])) {
                         ob_start();
                         ctr_get_image_by_url($model['image'], 'large');
                         $resolved_url = ob_get_clean();

                         if (!empty($resolved_url)) {
                             $vehicle_img_src = $resolved_url;
                             $real_car_found = true;
                         } elseif (strpos($model['image'], 'http') !== false) {
                              $vehicle_img_src = $model['image'];
                              $real_car_found = true;
                         }
                    }

                    // 4b. Model Thumbnail / Image URL (New Checks)
                    if (!$real_car_found) {
                        $keys_to_check = ['thumbnail', 'image_url', 'img_url'];
                        foreach ($keys_to_check as $key) {
                            if (!empty($model[$key])) {
                                ob_start();
                                ctr_get_image_by_url($model[$key], 'large');
                                $res_url = ob_get_clean();
                                if (!empty($res_url)) {
                                    $vehicle_img_src = $res_url;
                                    $real_car_found = true;
                                    break;
                                } elseif (strpos($model[$key], 'http') !== false) {
                                    $vehicle_img_src = $model[$key];
                                    $real_car_found = true;
                                    break;
                                }
                            }
                        }
                    }

                    // RENDER ONLY IF FOUND
                    // Final Poison Check: Ensure the found image is not the hated placeholder
                    if ($real_car_found && !empty($vehicle_img_src)) {
                        if (strpos($vehicle_img_src, 'placeholder') !== false || strpos($vehicle_img_src, 'default') !== false) {
                            $real_car_found = false; // It's a trap!
                            $vehicle_img_src = '';
                        }
                    }

                    if ($real_car_found && !empty($vehicle_img_src)) :
                    ?>
                    <div class="mt-8 relative h-48 w-full rounded-lg overflow-hidden bg-white/5 flex items-center justify-center">
                        <img src="<?php echo esc_url($vehicle_img_src); ?>"
                             class="object-contain max-h-full max-w-full mix-blend-lighten filter contrast-125 block mx-auto"
                             style="border: none; outline: none;"
                             alt="<?php echo esc_attr($brand['name'] . ' ' . $model['name']); ?>">
                    </div>
                    <?php endif; ?>
            </div>
        </div>

        <!-- col-2: Performance Data & Stages -->
        <div class="lg:col-span-2 space-y-8">

            <!-- STAGE TABLE (The Pricing/Gain Grid) -->
            <div class="bg-[#0b0f19] border border-white/10 rounded-xl overflow-hidden shadow-2xl relative">
                <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-[#ccff00] to-transparent opacity-50"></div>

                <div class="p-6 md:p-8">
                     <?php ctr_get_template('partials/stage-table.php', ['stages' => $stages, 'show_price' => $show_price, 'currency' => $currency]); ?>
                </div>
            </div>

            <!-- Dyno Chart Section (Forced Enabled) -->
            <section class="mt-8" aria-label="Performance Analysis">
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-px bg-white/10 flex-grow"></div>
                    <h3 class="text-lg font-black italic uppercase text-white tracking-widest"><span class="text-lime-400">Performance</span> Analysis</h3>
                    <div class="h-px bg-white/10 flex-grow"></div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Bar Chart -->
                    <div class="bg-[#0b0f19]/80 border border-white/5 rounded-xl p-4 transition-all hover:border-lime-400/20">
                        <h3 class="text-[#ccff00] font-mono text-xs uppercase mb-4 tracking-wider flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-[#ccff00] rounded-full shadow-[0_0_5px_#ccff00]"></span> Performance Gains
                        </h3>
                         <?php ctr_get_template('partials/barchart.php', ['stages' => $stages, 'engine' => $engine]); ?>
                    </div>

                    <!-- Dyno Chart -->
                    <div class="bg-[#0b0f19]/80 border border-white/5 rounded-xl p-4 transition-all hover:border-lime-400/20">
                        <h3 class="text-[#ccff00] font-mono text-xs uppercase mb-4 tracking-wider flex items-center gap-2">
                             <span class="w-1.5 h-1.5 bg-[#ccff00] rounded-full shadow-[0_0_5px_#ccff00]"></span> Power Verification
                        </h3>
                        <?php ctr_get_template('partials/linechart.php', ['stages' => $stages, 'engine' => $engine]); ?>
                    </div>
                    </div>
            </section>
            </div>

             <!-- Metadata / ECU Info -->
             <?php
             $has_metadata = isset($engine['metadata']) && !empty($engine['metadata']);
             if($show_ecu_info && $has_metadata): ?>
             <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                <h3 class="text-white font-bold font-orbitron mb-4">ECU Specification</h3>
                <?php ctr_get_template('partials/engine-metadata.php', ['metadata' => $engine['metadata']]); ?>
             </div>
             <?php endif; ?>

            <!-- Navigation -->
            <div class="text-center mt-12 mb-8">
                <a href="<?php ctr_print_full_start_url(); ?><?php echo $vehicle_type; ?>/<?php echo $brand['slug'] ?>/<?php echo $serie['slug']; ?>/<?php echo $model['slug'] . ctr_get_trailing_slash(); ?>"
                   class="inline-flex items-center gap-3 px-6 py-3 bg-neutral-900 border border-white/20 rounded hover:border-[#ccff00] text-gray-300 hover:text-[#ccff00] transition-all duration-300 uppercase text-sm tracking-wider font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 448 512">
                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg>
                    <span>Back to Engine Selection</span>
                </a>
            </div>

        </div><!-- END lg:col-span-2 -->

    </div><!-- END grid lg:grid-cols-3 -->
</div>
<!-- END TEMPLATE -->