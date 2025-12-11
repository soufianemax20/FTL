<!-- Engine Basic Data - Unified Spec Sheet -->
<div class="bg-[#0b0f19] border border-white/10 rounded-xl overflow-hidden relative group">
    <!-- Ambient Glow -->
    <div class="absolute inset-0 bg-lime-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

    <!-- Performance Row (Priority) -->
    <div class="grid grid-cols-2 divide-x divide-white/5 border-b border-white/5 bg-[#0b0f19]">
        <!-- HP -->
        <div class="p-3 flex flex-col justify-center items-center text-center hover:bg-white/5 transition-colors">
            <div class="w-8 h-8 rounded-full bg-lime-400/10 flex items-center justify-center mb-1">
                <svg class="w-4 h-4 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <div class="text-[9px] text-gray-500 uppercase tracking-wider font-bold"><?php _e('Power', 'ctr'); ?></div>
            <div class="text-lg font-black text-white italic tracking-tighter"><?php echo !empty($engine['hp']) ? $engine['hp'] . ' <span class="text-xs font-normal text-lime-400">HP</span>' : 'N/A'; ?></div>
        </div>

        <!-- Torque -->
        <div class="p-3 flex flex-col justify-center items-center text-center hover:bg-white/5 transition-colors">
            <div class="w-8 h-8 rounded-full bg-lime-400/10 flex items-center justify-center mb-1">
                <svg class="w-4 h-4 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <div class="text-[9px] text-gray-500 uppercase tracking-wider font-bold"><?php _e('Torque', 'ctr'); ?></div>
            <div class="text-lg font-black text-white italic tracking-tighter"><?php echo !empty($engine['nm']) ? $engine['nm'] . ' <span class="text-xs font-normal text-lime-400">Nm</span>' : 'N/A'; ?></div>
        </div>
    </div>

    <!-- Secondary Row: Fuel & Displacement -->
    <div class="grid grid-cols-2 divide-x divide-white/5 bg-[#111]">

        <!-- Fuel Type (Full Width if Capacity missing) -->
        <div class="p-3 flex flex-col justify-center items-center text-center hover:bg-white/5 transition-colors <?php echo empty($engine['capacity']) ? 'col-span-2' : ''; ?>">
            <div class="w-8 h-8 rounded-full bg-lime-400/10 flex items-center justify-center mb-1">
                <svg class="w-4 h-4 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            <div class="text-[9px] text-gray-500 uppercase tracking-wider font-bold"><?php _e('Fuel', 'ctr'); ?></div>
            <div class="text-sm font-bold text-white uppercase italic"><?php _e($engine['fuel_type'], 'ctr'); ?></div>
        </div>

        <!-- Displacement -->
        <?php if (!empty($engine['capacity'])): ?>
        <div class="p-3 flex flex-col justify-center items-center text-center hover:bg-white/5 transition-colors">
            <div class="w-8 h-8 rounded-full bg-lime-400/10 flex items-center justify-center mb-1">
                <svg class="w-4 h-4 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            <div class="text-[9px] text-gray-500 uppercase tracking-wider font-bold"><?php _e('Displacement', 'ctr'); ?></div>
            <div class="text-sm font-bold text-white uppercase italic"><?php echo esc_html($engine['capacity']); ?> cc</div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Footer: Years -->
    <?php if (!empty($serie['year_start'])): ?>
    <div class="border-t border-white/5 bg-[#0b0f19] p-2 text-center">
        <div class="text-[10px] font-mono text-gray-500">
             Production: <span class="text-lime-400"><?php echo esc_html($serie['year_start']); ?><?php echo !empty($serie['year_end']) ? ' - ' . esc_html($serie['year_end']) : ' - ...'; ?></span>
        </div>
    </div>
    <?php endif; ?>

</div>
