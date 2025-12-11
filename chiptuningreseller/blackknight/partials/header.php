<div class="main-header ctr-relative ctr-pt-24 ctr-px-4 ctr-pb-8">
        <?php if (!isset($engine)) { ?>
            <div>
                <h1 id="ctr-page-title" class="ctr-text-white ctr-text-center ctr-text-[40px] ctr-pt-10 ctr-pb-10"></h1>
            </div>
        <?php }
        if (isset($engine)) { ?>
            <div>
                <h1 id="ctr-stage-title" class="ctr-text-white ctr-text-center ctr-pt-10 ctr-pb-6"></h1>
            </div>
        <?php } ?>
        <div>
            <nav class="ctr-relative ctr-z-20">
                <ol class="ctr-list-reset ctr-list-none ctr-pb-4 ctr-rounded ctr-border-solid ctr-border-gray-500 ctr-flex ctr-text-white ctr-flex-wrap ctr-justify-center ctr-items-center">
                    <li class="ctr-px-2 ctr-min-h-16"><a href="/chip-tuning/" class="ctr-no-underline ctr-text-white hover:ctr-text-[#008eff]">Vehicle Type</a></li>
                    <?php if (isset($vehicle_type)) { ?>
                        <li><svg xmlns="http://www.w3.org/2000/svg" class="ctr-h-5 ctr-w-5" viewBox="0 0 384 512" style="fill: #008eff;"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                            </svg></li>
                        <li class="ctr-px-2 ctr-min-h-16"><a href="<?php ctr_print_full_start_url(); ?><?php echo Ctr_Translator::translate_vehicle_type($vehicle_type) . ctr_get_trailing_slash(); ?>" class="ctr-no-underline ctr-text-white hover:ctr-text-[#008eff]"><?php echo ucfirst(Ctr_Translator::translate_vehicle_type($vehicle_type)); ?></a></li>
                    <?php }
                    if (isset($brand)) { ?>
                        <li><svg xmlns="http://www.w3.org/2000/svg" class="ctr-h-5 ctr-w-5" viewBox="0 0 384 512" style="fill: #008eff;"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                            </svg></li>
                        <li class="ctr-px-2 ctr-min-h-16"><a href="<?php ctr_print_full_start_url(); ?><?php echo Ctr_Translator::translate_vehicle_type($vehicle_type); ?>/<?php echo $brand['slug'] . ctr_get_trailing_slash(); ?>" class="ctr-no-underline ctr-text-white hover:ctr-text-[#008eff]"><?php echo $brand['name']; ?></a></li>
                    <?php }
                    if (isset($serie)) { ?>
                        <li><svg xmlns="http://www.w3.org/2000/svg" class="ctr-h-5 ctr-w-5" viewBox="0 0 384 512" style="fill: #008eff;"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                            </svg></li>
                        <li class="ctr-px-2 ctrmin--h-16"><a href="<?php ctr_print_full_start_url(); ?><?php echo Ctr_Translator::translate_vehicle_type($vehicle_type); ?>/<?php echo $brand['slug'] ?>/<?php echo $serie['slug'] . ctr_get_trailing_slash(); ?>" class="ctr-no-underline ctr-text-white hover:ctr-text-[#008eff]"><?php echo $serie['name']; ?></a></li>
                    <?php }
                    if (isset($model)) { ?>
                        <li><svg xmlns="http://www.w3.org/2000/svg" class="ctr-h-5 ctr-w-5" viewBox="0 0 384 512" style="fill: #008eff;"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                            </svg></li>
                        <li class="ctr-px-2 ctr-min-h-16"><a href="<?php ctr_print_full_start_url(); ?><?php echo Ctr_Translator::translate_vehicle_type($vehicle_type); ?>/<?php echo $brand['slug'] ?>/<?php echo $serie['slug']; ?>/<?php echo $model['slug'] . ctr_get_trailing_slash(); ?>" class="ctr-no-underline ctr-text-white hover:ctr-text-[#008eff]"><?php echo $model['name']; ?></a></li>
                    <?php }
                    if (isset($engine)) { ?>
                        <li><svg xmlns="http://www.w3.org/2000/svg" class="ctr-h-5 ctr-w-5" viewBox="0 0 384 512" style="fill: #008eff;"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                            </svg></li>
                        <li class="ctr-px-2 ctr-min-h-16"><a href="#" class="ctr-no-underline ctr-text-white hover:ctr-text-[#008eff]"><?php echo $engine['name']; ?> <span class="ctr-hidden lg:ctr-block ctr-float-right ctr-pl-5"> ( <?php echo $engine['hp']; ?> <?php _e('HP', 'ctr'); ?> / <?php echo $engine['nm']; ?> <?php _e('Nm', 'ctr'); ?>)</span></a></li>
                    <?php } ?>
                </ol>
            </nav>
        </div>
    <!-- SVG Curved Shape -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 50" class="ctr-absolute ctr-bottom-0 ctr-mb-[-2px] ctr-left-0 ctr-w-full ctr-h-auto ctr-z-10">
        <path fill="#fff" d="M0,10 C500,62 1420,62 1920,10 L1920,50 L0,50 Z"></path>
    </svg>
</div>


<script>
    document.getElementById("ctr-page-title").innerText = document.title;
</script>