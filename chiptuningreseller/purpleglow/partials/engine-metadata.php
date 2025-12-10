<?php $meta_data = ctr_process_engine_metadata($metadata); ?>
<?php if(count($meta_data) > 1) { ?>

<div class="flex flex-wrap flex-col md:flex-row p-2 gap-[2%]">
    <div class="flex flex-col w-full md:w-[69%]">
    <h3 class="rubik font-normal text-ctr-blue mt-8 mb-4 ml-4">Engine details</h3>
    <div class="flex flex-wrap md:flex-nowrap flex-col md:flex-row mb-6 justify-around bg-white rounded-xl boxBackLight">
    <?php if(isset($meta_data['cylinder_content'])) { ?>
        <div class="flex flex-col ctr-text-center items-center p-4">
        <span class="font-bold mb-2">Cylinder Pressure</span>
            <span><?php echo $meta_data['cylinder_content']; ?></span>
        </div>
    <?php } ?>
    <?php if(isset($meta_data['bore_x_stroke'])) { ?>
        <div class="w-[0px] md:w-[1px] bg-[#e0e0e0] h-auto"></div>
        <div class="flex flex-col ctr-text-center p-4">
        <span class="font-bold mb-2">Stroke Ratio</span>
            <span><?php echo $meta_data['bore_x_stroke']; ?></span>
        </div>
    <?php } ?>
    <?php if(isset($meta_data['ecu_type'])) { ?>
        <div class="w-[0px] md:w-[1px] bg-[#e0e0e0] h-auto"></div>
        <div class="flex flex-col ctr-text-center p-4">
        <span class="font-bold mb-2">ECU type</span>
            <span><?php echo $meta_data['ecu_type']; ?></span>
        </div>
    <?php } ?>
    <?php if(isset($meta_data['code'])) { ?>
        <div class="w-[0px] md:w-[1px] bg-[#e0e0e0] h-auto"></div>
        <div class="flex flex-col ctr-text-center p-4">
        <span class="font-bold mb-2">Engine Code</span>
            <span><?php echo $meta_data['code']; ?></span>
        </div>
    <?php } ?>
    <?php if(isset($meta_data['compression_ratio'])) { ?>
        <div class="w-[0px] md:w-[1px] bg-[#e0e0e0] h-auto"></div>
        <div class="flex flex-col ctr-text-center p-4">
            <span class="font-bold mb-2">Compression Ratio</span>
            <span><?php echo $meta_data['compression_ratio']; ?></span>
        </div>
    <?php } ?>
    </div>
    </div>
    <div class="flex flex-col w-full md:w-[29%]">
    <h3 class="rubik font-normal text-ctr-blue mt-8 mb-4 ml-4">Read methods</h3>
    <?php if(isset($meta_data['read_methods']) && count($meta_data['read_methods'])) { ?>
    <div class="flex mb-6 min-h-[88px] justify-around bg-white rounded-xl boxBackLight content-center">
        <?php foreach($meta_data['read_methods'] as $read_method) { ?>
            <div class="ctr-text-center">
                    <img src="<?php echo ctr_get_assets_url() . 'readmethod_' . $read_method ?>.png" class="ctr-mx-auto ctr-w-75 ctr-h-75">
                    </div>
        <?php } ?>
        </div>
    <?php } ?>
    </div>
</div>
<?php } ?>