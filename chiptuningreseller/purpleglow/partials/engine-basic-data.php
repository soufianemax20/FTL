<div class="flex flex-wrap grow justify-between mb-6 p-4 rounded-xl boxBackLight">
    <div class="flex">
        <img class="mr-2 opacity-60" src="https://chiptuningreseller.com/wp-content/uploads/2023/09/fuel.png" width="30px" height="30px">
        <p class="text-lg leading-8 mb-0"><span class="opacity-60">Fuel Type: </span><span class="font-bold text-[#5046e4]"><?php _e($engine['fuel_type'], 'ctr'); ?></span></p>
    </div>
    <div class="relative w-[32px]"><span class="flex absolute right-[-8px] bottom-[50%] rotate-[90deg] h-[2px] w-[50px] bg-[#e0e0e0]"></span></div>
    <div class="flex">
        <img class="mr-2 opacity-60" src="https://chiptuningreseller.com/wp-content/uploads/2023/09/speedometerctr.png" width="30px" height="30px">
        <p class="text-lg leading-8 mb-0"><span class="opacity-60">Standard HP: </span><span class="font-bold text-[#5046e4]"><?php echo $engine['hp']; ?></span></p>
    </div>
    <div class="relative w-[32px]"><span class="flex absolute right-[-8px] bottom-[50%] rotate-[90deg] h-[2px] w-[50px] bg-[#e0e0e0]"></span></div>
    <div class="flex">
        <img class="mr-2 opacity-60" src="https://chiptuningreseller.com/wp-content/uploads/2023/09/wireless-charging.png" width="30px" height="30px">
        <p class="text-lg leading-8 mb-0"><span class="opacity-60">Standard Nm: </span><span class="font-bold text-[#5046e4]"><?php echo $engine['nm']; ?></span></p>
    </div>
</div>