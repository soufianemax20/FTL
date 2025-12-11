<script src="https://cdn.tailwindcss.com"></script>
<div class="ctr-main-header relative bg-[url('https://chiptuningreseller.com/wp-content/uploads/2024/01/ChipTuning-Reseller-Page-Header-Purple-Glow.jpg')] bg-cover px-4 pb-8 bg-no-repeat bg-top bg-fixed">
    <div>
    <?php if(!isset($engine)) { ?>
        <div>
            <h1 id="ctr-page-title" class="text-white text-center text-[40px] pt-40 pb-24"></h1>
        </div>
    <?php } if(isset($engine)) { ?>
        <div>
            <h1 id="ctr-stage-title" class="text-white text-center pt-28 pb-6"></h1>
        </div>
        <?php } ?>
        <div>
        <nav class="relative z-20">
  <ol class="ctr-list-reset ctr-list-none ctr-pb-4 ctr-rounded ctr-border-solid ctr-border-gray-500 ctr-flex ctr-text-white flex-wrap justify-center items-center">
    <li class="ctr-px-2 ctr-min-h-16 "><a href="/chip-tuning/" class="ctr-no-underline ctr-text-white hover:text-[#ff6e34]">Vehicle Type</a></li>
    <?php if(isset($vehicle_type)) { ?>
        <li class="ctr-pt-2"><svg xmlns="http://www.w3.org/2000/svg" class="ctr-h-5 ctr-w-5" viewBox="0 0 384 512" style="fill: #ff6e34;"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></li>
    <li class="ctr-px-2 ctr-min-h-16 "><a href="<?php ctr_print_full_start_url(); ?><?php echo Ctr_Translator::translate_vehicle_type($vehicle_type) . ctr_get_trailing_slash(); ?>" class="ctr-no-underline ctr-text-white hover:text-[#ff6e34]"><?php echo ucfirst(Ctr_Translator::translate_vehicle_type($vehicle_type)); ?></a></li>
    <?php } if(isset($brand)) { ?>
    <li class="ctr-pt-2"><svg xmlns="http://www.w3.org/2000/svg" class="ctr-h-5 ctr-w-5" viewBox="0 0 384 512" style="fill: #ff6e34;"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></li>
    <li class="ctr-px-2 ctr-min-h-16 "><a href="<?php ctr_print_full_start_url(); ?><?php echo Ctr_Translator::translate_vehicle_type($vehicle_type) ; ?>/<?php echo $brand['slug'] . ctr_get_trailing_slash(); ?>" class="ctr-no-underline ctr-text-white hover:text-[#ff6e34]"><?php echo $brand['name']; ?></a></li>
    <?php } if(isset($serie)) { ?>
    <li class="ctr-pt-2"><svg xmlns="http://www.w3.org/2000/svg" class="ctr-h-5 ctr-w-5" viewBox="0 0 384 512" style="fill: #ff6e34;"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></li>
    <li class="ctr-px-2 ctrmin--h-16 "><a href="<?php ctr_print_full_start_url(); ?><?php echo Ctr_Translator::translate_vehicle_type($vehicle_type) ; ?>/<?php echo $brand['slug'] ?>/<?php echo $serie['slug'] . ctr_get_trailing_slash(); ?>" class="ctr-no-underline ctr-text-white hover:text-[#ff6e34]"><?php echo $serie['name']; ?></a></li>
    <?php } if(isset($model)) { ?>
    <li class="ctr-pt-2"><svg xmlns="http://www.w3.org/2000/svg" class="ctr-h-5 ctr-w-5" viewBox="0 0 384 512" style="fill: #ff6e34;"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></li>
    <li class="ctr-px-2 ctr-min-h-16 "><a href="<?php ctr_print_full_start_url(); ?><?php echo Ctr_Translator::translate_vehicle_type($vehicle_type) ; ?>/<?php echo $brand['slug'] ?>/<?php echo $serie['slug']; ?>/<?php echo $model['slug'] . ctr_get_trailing_slash(); ?>" class="ctr-no-underline ctr-text-white hover:text-[#ff6e34]"><?php echo $model['name']; ?></a></li>
    <?php } if(isset($engine)) { ?>
    <li class="ctr-pt-2"><svg xmlns="http://www.w3.org/2000/svg" class="ctr-h-5 ctr-w-5" viewBox="0 0 384 512" style="fill: #ff6e34;"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></li>
    <li class="ctr-px-2 ctr-min-h-16 "><a href="#" class="ctr-no-underline ctr-text-white hover:text-[#ff6e34]"><?php echo $engine['name']; ?> <span class="ctr-hidden lg:ctr-block ctr-float-right ctr-pl-5"> ( <?php echo $engine['hp']; ?> <?php _e('HP', 'ctr'); ?> / <?php echo $engine['nm']; ?> <?php _e('Nm', 'ctr'); ?>)</span></a></li>
    <?php } ?>
  </ol>
</nav>
        </div>

    </div>
    <!-- SVG Curved Shape -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 50" class="absolute bottom-0 mb-[-2px] left-0 w-full h-auto z-10">
        <path fill="#fff" d="M0,10 C500,62 1420,62 1920,10 L1920,50 L0,50 Z"></path>
    </svg>
</div>

<script>
    document.getElementById("ctr-page-title").innerText = document.title;
</script>