<?php
	if (!isset($json_data)) {
		return '[CTR_SELECTOR: No data found, please flush the cache and try again]';
	}

	$barBackgroundColor = get_option(CTR_OPT_PREFIX . 'graph_colors', '#000000')['original_hp'];
	$jsonDataPath = CTR_JSON_FILE;
	?>
	<script>
		var onlyShowType = '<?php echo isset($only_show_vehicle_type) ? $only_show_vehicle_type : ""; ?>';
		var vData = <?php echo $json_data; ?>;
		var vTypes = <?php echo $vehicle_types; ?>;
		var homeUrl = '<?php echo get_home_url(); ?>';
		var ctrStartUrl = '<?php ctr_print_full_start_url(); ?>';

        document.addEventListener("DOMContentLoaded", function(event) {
            setTimeout(function() {
                var app = document.getElementById('selectorApp');
                if (app && app.__vue__) {
                    // DEBUG: Log available keys to fix mismatch
                    console.log('CTR AVAILABLE KEYS:', Object.keys(vData));

                    if (onlyShowType && app.__vue__.selectedType !== onlyShowType) {
                        app.__vue__.selectedType = onlyShowType;
                    }
                    if (app.__vue__.selectedBrands.length === 0 && app.__vue__.selectedType) {
                         if (vData[app.__vue__.selectedType]) {
                             app.__vue__.typeSelected();
                         }
                    }
                }
            }, 1000);
        });
    </script>

	<?php
	// Check if a custom template exists in the theme folder, if not, load the plugin template file
	?>
    <!-- DEBUG: only_show_vehicle_type = "<?php echo isset($only_show_vehicle_type) ? $only_show_vehicle_type : 'NOT SET'; ?>" -->
	<?php
	// Check if a custom template exists in the theme folder, if not, load the plugin template file
	?>
	<div id="selectorApp" class="bg-[#0b0f19] p-6 lg:p-8 rounded-xl border border-white/10 shadow-[0_0_50px_rgba(0,0,0,0.8)] relative group" v-cloak>

        <!-- Pulse Glow Backgrounds -->
        <div class="absolute -top-32 -right-32 w-64 h-64 bg-[#ccff00]/5 rounded-full blur-[80px] pointer-events-none animate-pulse"></div>
        <div class="absolute -bottom-32 -left-32 w-64 h-64 bg-[#00f3ff]/5 rounded-full blur-[80px] pointer-events-none animate-pulse"></div>

        <!-- Layout Grid (Dual Classes for Compatibility) -->
		<div class="selectorSpace grid grid-cols-1 ctr-grid ctr-grid-cols-1 gap-6 relative z-10" :class="[onlyShowType ? 'md:grid-cols-4 md:ctr-grid-cols-4' : 'md:grid-cols-5 md:ctr-grid-cols-5']" >

            <!-- Type Selection -->
            <div class="selectorControl selectTypeControl" v-show="!onlyShowType">
				<label for="selectType" class="block mb-2 text-xs font-bold font-orbitron text-[#ccff00] uppercase tracking-widest drop-shadow-[0_0_5px_rgba(204,255,0,0.5)]">
                    <?php _e('Vehicle Type', 'tuning-mania'); ?>
                </label>
				<select v-model="selectedType" class="form-control bg-[#151922] border border-white/10 text-white text-sm rounded-lg focus:ring-[#ccff00] focus:border-[#ccff00] block w-full p-3 transition-colors uppercase disabled:opacity-50 disabled:cursor-not-allowed" name="type" id="selectType" v-model="selectedType" @change="typeSelected">
					<option value="0" :selected="true">-- <?php _e('SELECT TYPE', 'tuning-mania'); ?> --</option>
					<option v-for="type in typeData" :value="type.slug" :key="type.slug" :data_slug="type.slug" class="bg-[#151922] text-white">{{ type.name }}</option>
				</select>
			</div>

            <!-- Brand Selection -->
			<div class="selectorControl selectBrandControl">
				<label for="selectBrand" class="block mb-2 text-xs font-bold font-orbitron text-[#ccff00] uppercase tracking-widest drop-shadow-[0_0_5px_rgba(204,255,0,0.5)]">
                    <?php _e('Select Brand', 'tuning-mania'); ?>
                </label>
				<select v-model="selectedBrand" :disabled="selectedBrands.length == 0" class="form-control bg-[#151922] border border-white/10 text-white text-sm rounded-lg focus:ring-[#ccff00] focus:border-[#ccff00] block w-full p-3 transition-colors uppercase disabled:opacity-50 disabled:cursor-not-allowed" :class="{'refreshed': brandsLoaded}" name="brand" id="selectBrand" @change="brandSelected">
					<option value="0" selected v-if="selectedBrands.length == 0">-- <?php _e('SELECT TYPE FIRST', 'tuning-mania'); ?> --</option>
					<option value="0" selected v-else>-- <?php _e('SELECT BRAND', 'tuning-mania'); ?> --</option>
					<option v-for="brand in selectedBrands" :value="{id: brand.id, slug: brand.slug}" :key="brand.id" class="bg-[#151922] text-white">{{ brand.name }}</option>
				</select>
			</div>

            <!-- Series Selection -->
			<div class="selectorControl selectSerieControl">
			    <label for="selectSerie" class="block mb-2 text-xs font-bold font-orbitron text-[#ccff00] uppercase tracking-widest drop-shadow-[0_0_5px_rgba(204,255,0,0.5)]">
                    <?php _e('Select Series', 'tuning-mania'); ?>
                </label>
				<select v-model="selectedSerie" :disabled="selectedSeries.length == 0" class="form-control bg-[#151922] border border-white/10 text-white text-sm rounded-lg focus:ring-[#ccff00] focus:border-[#ccff00] block w-full p-3 transition-colors uppercase disabled:opacity-50 disabled:cursor-not-allowed" :class="{'refreshed': seriesLoaded}" name="serie" id="selectSerie" @change="serieSelected">
					<option value="0" selected v-if="selectedSeries.length == 0">-- <?php _e('SELECT BRAND FIRST', 'tuning-mania'); ?> --</option>
					<option value="0" selected v-else>-- <?php _e('SELECT SERIES', 'tuning-mania'); ?> --</option>
					<option v-for="serie in selectedSeries" :value="{id: serie.id, slug: serie.slug}" :key="serie.id" :data_slug="serie.slug" class="bg-[#151922] text-white">{{ serie.name }}</option>
				</select>
			</div>

            <!-- Model Selection -->
			<div class="selectorControl selectModelControl">
				<label for="selectModel" class="block mb-2 text-xs font-bold font-orbitron text-[#ccff00] uppercase tracking-widest drop-shadow-[0_0_5px_rgba(204,255,0,0.5)]">
                    <?php _e('Select Model', 'tuning-mania'); ?>
                </label>
				<select v-model="selectedModel" :disabled="selectedModels.length == 0" class="form-control bg-[#151922] border border-white/10 text-white text-sm rounded-lg focus:ring-[#ccff00] focus:border-[#ccff00] block w-full p-3 transition-colors uppercase disabled:opacity-50 disabled:cursor-not-allowed" :class="{'refreshed': modelsLoaded}" name="models" id="selectModel" @change="modelSelected">
					<option value="0" selected v-if="selectedModels.length == 0">-- <?php _e('SELECT SERIES FIRST', 'tuning-mania'); ?> --</option>
					<option value="0" selected v-else>-- <?php _e('SELECT MODEL', 'tuning-mania'); ?> --</option>
					<option v-for="model in selectedModels" :value="{id: model.id, slug: model.slug}" :key="model.id" :data_slug="model.slug" class="bg-[#151922] text-white">{{ model.name }}</option>
				</select>
			</div>

            <!-- Engine Selection -->
			<div class="selectorControl selectEngineControl" v-show="!redirecting">
				<label for="selectEngine" class="block mb-2 text-xs font-bold font-orbitron text-[#ccff00] uppercase tracking-widest drop-shadow-[0_0_5px_rgba(204,255,0,0.5)]">
                    <?php _e('Select Engine', 'tuning-mania'); ?>
                </label>
				<select v-model="selectedEngine" :disabled="selectedEngines.length == 0" class="form-control bg-[#151922] border border-white/10 text-white text-sm rounded-lg focus:ring-[#ccff00] focus:border-[#ccff00] block w-full p-3 transition-colors uppercase disabled:opacity-50 disabled:cursor-not-allowed" :class="{'refreshed': enginesLoaded}" name="engines" id="selectEngine" <?php if($autoredirect !== false) { ?>@change="engineSelected"<?php } ?>>
					<option value="0" selected v-if="selectedEngines.length == 0">-- <?php _e('SELECT MODEL FIRST', 'tuning-mania'); ?> --</option>
					<option value="0" selected v-else>-- <?php _e('SELECT ENGINE', 'tuning-mania'); ?> --</option>
					<option v-for="engine in selectedEngines" :value="{id: engine.id, slug: engine.slug}" :key="engine.id" :data_slug="engine.slug" class="bg-[#151922] text-white">{{ engine.name }} {{ engine.hp }} <?php _e('HP', 'ctr'); ?></option>
				</select>
			</div>

            <!-- Action Button / Spinner -->
            <div class="flex items-end h-full py-0.5">
			<?php if(!$autoredirect) { ?>
				<button @click="engineSelected()" class="w-full bg-[#ccff00] hover:bg-[#b3e600] text-black font-bold font-orbitron uppercase rounded-lg px-6 py-3 transition-all duration-300 hover:shadow-[0_0_15px_rgba(204,255,0,0.6)] border border-transparent hover:border-white">
					<?php _e('View Options', 'tuning-mania'); ?>
				</button>
			<?php } ?>

            <div class="w-full h-[50px] flex items-center justify-center transition-all bg-[#151922] rounded-lg border border-white/10" v-show="redirecting">
				<svg class="animate-spin h-6 w-6 text-[#ccff00]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
			</div>
            </div>

		</div>
	</div>
	<div style="clear:both;"></div>
	<style>
        [v-cloak] { display: none !important; }

		/* Custom Loader Logic (Preserved but styled neon) */
		#loadingDiv {
            position: absolute;
            display: block;
            width: 100%;
            text-align: center;
            left: 0px;
            height: 6%;
            padding-top: 10px;
            background-color: rgba(11, 15, 25, 0.95); /* Dark */
            border-bottom: 2px solid #ccff00;
        }
		#loadingDiv img {animation: rotation 1s infinite linear;}
		.fadeInLoader { animation: fadeIn 0.3s linear; }
		.loader {
            width:100%;
            display:block;
            position:absolute;
            height: 3px;
            bottom:0;
            left: 0;
            background-color: #ccff00; /* Neon Lime */
            box-shadow: 0 0 10px #ccff00;
        }
		.loaderLoading {animation: loader 4s linear; }
		@keyframes fadeIn {0% { opacity:0; }100% { opacity:1; }}
		@keyframes rotation {from {transform: rotate(0deg);}to {transform: rotate(359deg);}}
		@keyframes loader {0% {width: 100%;}100% {width: 0%;}}

        /* FIX: Force Select2 Output Styling within this specific widget */
        #selectorApp .select2-container--default .select2-selection--single {
            background-color: #151922 !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            border-radius: 0.5rem !important;
            height: 48px !important;
            outline: none !important;
        }
        #selectorApp .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #ffffff !important;
            line-height: 48px !important;
            padding-left: 1rem !important;
            text-transform: uppercase !important;
            font-size: 0.875rem !important;
            font-weight: 700 !important;
        }
        #selectorApp .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px !important;
            top: 1px !important;
            right: 1px !important;
        }
        #selectorApp .select2-dropdown {
            background-color: #151922 !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            color: #fff !important;
        }
        #selectorApp .select2-search__field {
            background-color: #0b0f19 !important;
            color: #fff !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
        }
        #selectorApp .select2-results__option--highlighted[aria-selected] {
            background-color: #ccff00 !important;
            color: #000 !important;
        }
	</style>