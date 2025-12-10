<?php $meta_data = ctr_process_engine_metadata($metadata); ?>
<?php if(count($meta_data) > 1) { ?>

    <div class="ctr-flex ctr-flex-wrap ctr-flex-col ctr-p-2 ctr-gap-[2%]">
    <div class="ctr-flex ctr-flex-col ctr-w-full">
    <p class="rubik ctr-text-[#262626] ctr-text-[28px] ctr-font-semibold ctr-mb-4 ctr-mt-5">Engine details</p>
        <div class="ctr-flex ctr-flex-wrap mobile:ctr-flex-col tv:ctr-flex-row ctr-gap-1 ctr-justify-between ctr-text-white">
            <?php if(isset($meta_data['cylinder_content'])) { ?>
                <div class="ctr-flex ctr-flex-col ctr-text-center ctr-bg-[#262626] tv:ctr-w-[128px] ctr-py-2 ctr-px-1 ctr-rounded-lg ctr-border-solid ctr-border-r-[8px] ctr-border-[#0079d9]">
                    <span class="ctr-text-[14px] ctr-pb-2 ctr-border-solid ctr-border-b-[1px] ctr-border-[#7d7d7d]">Cylinder Pressure</span>
                    <span class="ctr-font-bold ctr-pt-2"><?php echo $meta_data['cylinder_content']; ?></span>
                </div>
            <?php } ?>
            <?php if(isset($meta_data['bore_x_stroke'])) { ?>
                <div class="ctr-flex ctr-flex-col ctr-text-center ctr-bg-[#262626] tv:ctr-w-[128px] ctr-py-2 ctr-px-1 ctr-rounded-lg ctr-border-solid ctr-border-r-[8px] ctr-border-[#0079d9]">
                    <span class="ctr-text-[14px] ctr-pb-2 ctr-border-solid ctr-border-b-[1px] ctr-border-[#7d7d7d]">Stroke Ratio</span>
                    <span class="ctr-font-bold ctr-pt-2"><?php echo $meta_data['bore_x_stroke']; ?></span>
                </div>
            <?php } ?>
            <?php if(isset($meta_data['ecu_type'])) { ?>
                <div class="ctr-flex ctr-flex-col ctr-text-center ctr-bg-[#262626] tv:ctr-w-[128px] ctr-py-2 ctr-px-1 ctr-rounded-lg ctr-border-solid ctr-border-r-[8px] ctr-border-[#0079d9]">
                    <span class="ctr-text-[14px] ctr-pb-2 ctr-border-solid ctr-border-b-[1px] ctr-border-[#7d7d7d]">ECU type</span>
                    <span class="ctr-font-bold ctr-pt-2"><?php echo $meta_data['ecu_type']; ?></span>
                </div>
            <?php } ?>
            <?php if(isset($meta_data['code'])) { ?>
                <div class="ctr-flex ctr-flex-col ctr-text-center ctr-bg-[#262626] tv:ctr-w-[128px] ctr-py-2 ctr-px-1 ctr-rounded-lg ctr-border-solid ctr-border-r-[8px] ctr-border-[#0079d9]">
                    <span class="ctr-text-[14px] ctr-pb-2 ctr-border-solid ctr-border-b-[1px] ctr-border-[#7d7d7d]">Engine Code</span>
                    <span class="ctr-font-bold ctr-pt-2"><?php echo $meta_data['code']; ?></span>
                </div>
            <?php } ?>
            <?php if(isset($meta_data['compression_ratio'])) { ?>
                <div class="ctr-flex ctr-flex-col ctr-text-center ctr-bg-[#262626] tv:ctr-w-[128px] ctr-py-2 ctr-px-1 ctr-rounded-lg ctr-border-solid ctr-border-r-[8px] ctr-border-[#0079d9]">
                    <span class="ctr-text-[14px] ctr-pb-2 ctr-border-solid ctr-border-b-[1px] ctr-border-[#7d7d7d]">Compression</span>
                    <span class="ctr-font-bold ctr-pt-2"><?php echo $meta_data['compression_ratio']; ?></span>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="ctr-flex ctr-flex-col ctr-w-full">
        <p class="rubik ctr-text-[#262626] ctr-text-[28px] ctr-font-semibold ctr-mb-4 ctr-mt-5">Read methods</p>
        <?php if(isset($meta_data['read_methods']) && count($meta_data['read_methods'])) { ?>
            <div class="ctr-flex ctr-flex-row ctr-mb-6 ctr-p-2 ctr-min-h-[60px] ctr-justify-around ctr-bg-[#262626] ctr-rounded-lg ctr-content-center ctr-rounded-lg ctr-border-solid ctr-border-r-[10px] ctr-border-[#0079d9]">
                <?php foreach($meta_data['read_methods'] as $read_method) { ?>
                    <div class="ctr-text-center ctr-bg-white ctr-rounded-lg">
                        <img src="<?php echo ctr_get_assets_url() . 'readmethod_' . $read_method ?>.png" class="ctr-mx-auto ctr-w-75 ctr-h-75">
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>

<?php } ?>