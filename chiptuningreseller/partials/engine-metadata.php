<?php
// Safety check: ensure $metadata exists
if (!isset($metadata) || empty($metadata)) {
    return; // Exit early if no metadata provided
}
$meta_data = ctr_process_engine_metadata($metadata);

// Safety check: ensure we have processed data
if (empty($meta_data) || !is_array($meta_data)) {
    return;
}
?>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <?php if(isset($meta_data['cylinder_content'])) { ?>
    <div class="bg-white/5 border border-white/10 rounded-lg p-3 text-center transition-all hover:bg-white/10 group">
        <div class="h-12 flex items-center justify-center mb-2">
            <img src="<?php echo ctr_get_assets_url(); ?>cylinder-content-icon.png" class="h-10 w-auto filter invert opacity-70 group-hover:opacity-100 group-hover:drop-shadow-[0_0_5px_#ccff00] transition-all">
        </div>
        <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Cylinders</div>
        <div class="text-white font-mono"><?php echo esc_html($meta_data['cylinder_content']); ?></div>
    </div>
    <?php } ?>

    <?php if(isset($meta_data['bore_x_stroke'])) { ?>
    <div class="bg-white/5 border border-white/10 rounded-lg p-3 text-center transition-all hover:bg-white/10 group">
        <div class="h-12 flex items-center justify-center mb-2">
            <img src="<?php echo ctr_get_assets_url(); ?>bore-x-stroke-icon.svg" class="h-10 w-auto filter invert opacity-70 group-hover:opacity-100 group-hover:drop-shadow-[0_0_5px_#ccff00] transition-all">
        </div>
        <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Bore x Stroke</div>
        <div class="text-white font-mono"><?php echo esc_html($meta_data['bore_x_stroke']); ?></div>
    </div>
    <?php } ?>

    <?php if(isset($meta_data['ecu_type'])) { ?>
    <div class="bg-white/5 border border-white/10 rounded-lg p-3 text-center transition-all hover:bg-white/10 group">
        <div class="h-12 flex items-center justify-center mb-2">
            <img src="<?php echo ctr_get_assets_url(); ?>ecu-icon.png" class="h-10 w-auto filter invert opacity-70 group-hover:opacity-100 group-hover:drop-shadow-[0_0_5px_#ccff00] transition-all">
        </div>
        <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">ECU Type</div>
        <div class="text-[#ccff00] font-mono font-bold"><?php echo esc_html($meta_data['ecu_type']); ?></div>
    </div>
    <?php } ?>

    <?php if(isset($meta_data['code'])) { ?>
    <div class="bg-white/5 border border-white/10 rounded-lg p-3 text-center transition-all hover:bg-white/10 group">
        <div class="h-12 flex items-center justify-center mb-2">
            <img src="<?php echo ctr_get_assets_url(); ?>engine-code-icon.svg" class="h-10 w-auto filter invert opacity-70 group-hover:opacity-100 group-hover:drop-shadow-[0_0_5px_#ccff00] transition-all">
        </div>
        <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Engine Code</div>
        <div class="text-white font-mono"><?php echo esc_html($meta_data['code']); ?></div>
    </div>
    <?php } ?>

    <?php if(isset($meta_data['compression_ratio'])) { ?>
    <div class="bg-white/5 border border-white/10 rounded-lg p-3 text-center transition-all hover:bg-white/10 group">
        <div class="h-12 flex items-center justify-center mb-2">
            <img src="<?php echo ctr_get_assets_url(); ?>compression-icon.png" class="h-10 w-auto filter invert opacity-70 group-hover:opacity-100 group-hover:drop-shadow-[0_0_5px_#ccff00] transition-all">
        </div>
        <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Compression</div>
        <div class="text-white font-mono"><?php echo esc_html($meta_data['compression_ratio']); ?></div>
    </div>
    <?php } ?>
</div>

<!-- Read Methods -->
<?php if(isset($meta_data['read_methods']) && count($meta_data['read_methods'])) { ?>
<div class="mt-8 pt-8 border-t border-white/10">
    <h3 class="text-white font-bold mb-6 text-center uppercase tracking-widest text-sm"><?php _e('Connection Methods', 'ctr'); ?></h3>
    <div class="flex flex-wrap justify-center gap-6">
    <?php foreach($meta_data['read_methods'] as $read_method) { ?>
        <div class="group flex flex-col items-center">
             <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center border border-white/10 group-hover:border-[#00f3ff] transition-colors mb-2">
                <img src="<?php echo ctr_get_assets_url() . 'readmethod_' . $read_method ?>.png"
                     class="w-10 h-10 object-contain filter invert opacity-80 group-hover:opacity-100 group-hover:drop-shadow-[0_0_5px_#00f3ff] transition-all">
             </div>
             <span class="text-xs text-gray-400 font-mono uppercase group-hover:text-[#00f3ff]"><?php echo esc_html(str_replace('_', ' ', $read_method)); ?></span>
        </div>
    <?php } ?>
    </div>
</div>
<?php } ?>
