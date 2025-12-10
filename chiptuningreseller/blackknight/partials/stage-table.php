<div class="ctr-mb-4 w-full">
    <?php

    foreach ($stages as $stage) {
        if ($stage['name'] === 'stage_1') {
            $stage_1 = $stage;
        } elseif ($stage['name'] === 'stage_2') {
            $stage_2 = $stage;
        } elseif ($stage['name'] === 'stage_3') {
            $stage_3 = $stage;
        }
    };
    $stage_1_plusKw = round($stage_1['data']['hp_tuning'] * 0.745699872) - round($stage_1['data']['hp_ori'] * 0.745699872);
    $stage_2_plusKw = round($stage_2['data']['hp_tuning'] * 0.745699872) - round($stage_2['data']['hp_ori'] * 0.745699872);
    $stage_3_plusKw = round($stage_3['data']['hp_tuning'] * 0.745699872) - round($stage_3['data']['hp_ori'] * 0.745699872);
    $originalText = 'ORIGINAL';
    $tunedText = 'TUNED';
    ?>
    <!-- TABS START -->
    <!-- TABS buttons -->
    <div class="ctr-flex ctr-gap-4 ctr-ml-2 ctr-z-20">
        <?php if (isset($stage_1['name'])) { ?>
            <span id="firstTab" class="tabButton ctr-border-0 ctr-pt-1 ctr-pb-1 md:pb-2 ctr-px-1 md:px-4 ctr-flex ctr-flex-col ctr-text-center ctr-text-white ctr-rounded-t-lg ctr-cursor-pointer ctr-selected" onclick="openmaintab(event, 'maintab1')">
                <span class="ctr-font-medium ctr-text-lg" id="button_title_txt">Stage 1</span>
                <span id="button_value_txt" class="ctr-text-[#0079d9]" style="font-size: 14px;"> (+ <?php echo $stage_1['data']['hp_tuning'] - $stage_1['data']['hp_ori']; ?> HP)</span>
            </span>
        <?php } ?>
        <?php if (isset($stage_2['name'])) { ?>
            <span class="tabButton ctr-relative ctr-border-0 ctr-pt-1 ctr-pb-1 md:pb-2 ctr-px-1 md:px-4 ctr-flex ctr-flex-col ctr-text-center ctr-text-[#656565] ctr-rounded-t-lg ctr-cursor-pointer ctr-selected" onclick="openmaintab(event, 'maintab2')">
                <span class="ctr-font-medium ctr-text-lg" id="button_title_txt">Stage 2</span>
                <span id="button_value_txt" class="ctr-text-[#0079d9]" style="font-size: 14px;"> (+ <?php echo $stage_2['data']['hp_tuning'] - $stage_2['data']['hp_ori']; ?> HP)</span>
            </span>
        <?php } ?>
        <?php if (isset($stage_3['name'])) { ?>
            <span class="tabButton ctr-border-0 ctr-pt-1 ctr-pb-1 md:pb-2 ctr-px-1 md:px-4 ctr-flex ctr-flex-col ctr-text-center ctr-text-[#656565] ctr-rounded-t-lg ctr-cursor-pointer ctr-selected" onclick="openmaintab(event, 'maintab3')">
                <span class="ctr-font-medium ctr-text-lg" id="button_title_txt">Stage 3</span>
                <span id="button_value_txt" class="ctr-text-[#0079d9]" style="font-size: 14px;"> (+ <?php echo $stage_3['data']['hp_tuning'] - $stage_3['data']['hp_ori']; ?> HP)</span>
            </span>
        <?php } ?>
    </div>

    <div class="tuning_table ctr-relative rubik">
        <div class="table-responsive stageTableBlock ">
            <div id="maintab1" class="maintab-content ctr-rounded-xl ctr-text-center ctr-border-solid ctr-border-r-[10px] ctr-border-[#0079d9]">
                <table>
                    <tbody>
                        <tr class="stageTableRow ctr-text-2xl">
                            <!-- ROW 1 FROM HERE -->
                            <td class="table_big_value ctr-p-1 md:ctr-p-3">
                                <span class="ctr-text-[#0079d9] ctr-font-bold ctr-text-[16px] sm:ctr-text-[18px] md:ctr-text-[20px] lg:ctr-text-[26px]">+
                                    <?php echo $stage_1['data']['hp_tuning'] - $stage_1['data']['hp_ori']; ?> HP
                                </span>
                            </td>
                            <td class="ctr-table_big_value ctr-p-1 md:ctr-p-3">
                                <span class="ctr-text-[#0079d9] ctr-font-bold ctr-text-[16px] sm:ctr-text-[18px] md:ctr-text-[20px] lg:ctr-text-[26px]">+
                                    <?php echo $stage_1['data']['nm_tuning'] - $stage_1['data']['nm_ori']; ?> NM
                                </span>
                            </td>
                            <td class="ctr-table_big_value ctr-p-1 md:ctr-p-3">
                                <span class="ctr-text-[#0079d9] ctr-font-bold ctr-text-[16px] sm:ctr-text-[18px] md:ctr-text-[20px] lg:ctr-text-[26px]">+
                                    <?php echo $stage_1['data']['hp_tuning'] > 0 ? round($stage_1['data']['hp_tuning'] * 0.745699872) - round($stage_1['data']['hp_ori'] * 0.745699872) : '-'; ?> KW
                                </span>
                            </td>
                            <!-- TO HERE -->
                        </tr>
                        <tr class="ctr-stageTableRow">
                            <!-- ROW 2 FROM HERE -->
                            <td>
                                <div class="ctr-flex ctr-justify-center ctr-gap-2.5 ctr-text-lg ctr-text-white">
                                    <span class="ctr-line-through ctr-opacity-50 ctr-text-white">
                                        <?php echo $stage_1['data']['hp_ori']; ?> HP
                                    </span>
                                    <span>
                                        <?php echo $stage_1['data']['hp_tuning']; ?> HP
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="ctr-flex ctr-justify-center ctr-gap-2.5 ctr-text-lg ctr-text-white">
                                    <span class="ctr-line-through ctr-opacity-60">
                                        <?php echo $stage_1['data']['nm_ori']; ?> Nm
                                    </span>
                                    <span>
                                        <?php echo $stage_1['data']['nm_tuning']; ?> Nm
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="ctr-flex ctr-justify-center ctr-gap-2.5 ctr-text-lg ctr-text-white">
                                    <span class="ctr-line-through ctr-opacity-60">
                                        <?php echo round($stage_1['data']['hp_ori'] * 0.745699872); ?> KW
                                    </span>
                                    <span>
                                        <?php echo $stage_1['data']['hp_tuning'] > 0 ? round($stage_1['data']['hp_ori'] * 0.745699872) + $stage_1_plusKw : '-'; ?> KW
                                    </span>
                                </div>
                            </td>
                            <!-- TO HERE -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="maintab2" class="maintab-content ctr-rounded-xl ctr-text-center ctr-border-solid ctr-border-r-[10px] ctr-border-[#0079d9]">
                <table>
                    <tbody>
                        <tr class="stageTableRow ctr-text-2xl">
                            <!-- ROW 1 FROM HERE -->
                            <td class="table_big_value ctr-p-1 md:ctr-p-3">
                                <span class="ctr-text-[#0079d9] ctr-font-bold ctr-text-[16px] sm:ctr-text-[18px] md:ctr-text-[20px] lg:ctr-text-[26px]">+
                                    <?php echo $stage_2['data']['hp_tuning'] - $stage_2['data']['hp_ori']; ?> HP
                                </span>
                            </td>
                            <td class="ctr-table_big_value ctr-p-1 md:ctr-p-3">
                                <span class="ctr-text-[#0079d9] ctr-font-bold ctr-text-[16px] sm:ctr-text-[18px] md:ctr-text-[20px] lg:ctr-text-[26px]">+
                                    <?php echo $stage_2['data']['nm_tuning'] - $stage_2['data']['nm_ori']; ?> NM
                                </span>
                            </td>
                            <td class="ctr-table_big_value ctr-p-1 md:ctr-p-3">
                                <span class="ctr-text-[#0079d9] ctr-font-bold ctr-text-[16px] sm:ctr-text-[18px] md:ctr-text-[20px] lg:ctr-text-[26px]">+
                                    <?php echo $stage_2['data']['hp_tuning'] > 0 ? round($stage_2['data']['hp_tuning'] * 0.745699872) - round($stage_2['data']['hp_ori'] * 0.745699872) : '-'; ?> KW
                                </span>
                            </td>
                            <!-- TO HERE -->
                        </tr>
                        <tr class="ctr-stageTableRow">
                            <!-- ROW 2 FROM HERE -->
                            <td>
                                <div class="ctr-flex ctr-justify-center ctr-gap-2.5 ctr-text-lg ctr-text-white">
                                    <span class="ctr-line-through ctr-opacity-50 ctr-text-white">
                                        <?php echo $stage_2['data']['hp_ori']; ?> HP
                                    </span>
                                    <span>
                                        <?php echo $stage_2['data']['hp_tuning']; ?> HP
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="ctr-flex ctr-justify-center ctr-gap-2.5 ctr-text-lg ctr-text-white">
                                    <span class="ctr-line-through ctr-opacity-60">
                                        <?php echo $stage_2['data']['nm_ori']; ?> Nm
                                    </span>
                                    <span>
                                        <?php echo $stage_2['data']['nm_tuning']; ?> Nm
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="ctr-flex ctr-justify-center ctr-gap-2.5 ctr-text-lg ctr-text-white">
                                    <span class="ctr-line-through ctr-opacity-60">
                                        <?php echo round($stage_2['data']['hp_ori'] * 0.745699872); ?> KW
                                    </span>
                                    <span>
                                        <?php echo $stage_2['data']['hp_tuning'] > 0 ? round($stage_2['data']['hp_ori'] * 0.745699872) + $stage_2_plusKw : '-'; ?> KW
                                    </span>
                                </div>
                            </td>
                            <!-- TO HERE -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="maintab3" class="maintab-content ctr-rounded-xl ctr-text-center ctr-border-solid ctr-border-r-[10px] ctr-border-[#0079d9]">
                <table>
                    <tbody>
                        <tr class="stageTableRow ctr-text-2xl">
                            <!-- ROW 1 FROM HERE -->
                            <td class="table_big_value ctr-p-1 md:ctr-p-3">
                                <span class="ctr-text-[#0079d9] ctr-font-bold ctr-text-[16px] sm:ctr-text-[18px] md:ctr-text-[20px] lg:ctr-text-[26px]">+
                                    <?php echo $stage_3['data']['hp_tuning'] - $stage_3['data']['hp_ori']; ?> HP
                                </span>
                            </td>
                            <td class="ctr-table_big_value ctr-p-1 md:ctr-p-3">
                                <span class="ctr-text-[#0079d9] ctr-font-bold ctr-text-[16px] sm:ctr-text-[18px] md:ctr-text-[20px] lg:ctr-text-[26px]">+
                                    <?php echo $stage_3['data']['nm_tuning'] - $stage_3['data']['nm_ori']; ?> NM
                                </span>
                            </td>
                            <td class="ctr-table_big_value ctr-p-1 md:ctr-p-3">
                                <span class="ctr-text-[#0079d9] ctr-font-bold ctr-text-[16px] sm:ctr-text-[18px] md:ctr-text-[20px] lg:ctr-text-[26px]">+
                                    <?php echo $stage_3['data']['hp_tuning'] > 0 ? round($stage_3['data']['hp_tuning'] * 0.745699872) - round($stage_3['data']['hp_ori'] * 0.745699872) : '-'; ?> KW
                                </span>
                            </td>
                            <!-- TO HERE -->
                        </tr>
                        <tr class="ctr-stageTableRow">
                            <!-- ROW 2 FROM HERE -->
                            <td>
                                <div class="ctr-flex ctr-justify-center ctr-gap-2.5 ctr-text-lg ctr-text-white">
                                    <span class="ctr-line-through ctr-opacity-50 ctr-text-white">
                                        <?php echo $stage_3['data']['hp_ori']; ?> HP
                                    </span>
                                    <span>
                                        <?php echo $stage_3['data']['hp_tuning']; ?> HP
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="ctr-flex ctr-justify-center ctr-gap-2.5 ctr-text-lg ctr-text-white">
                                    <span class="ctr-line-through ctr-opacity-60">
                                        <?php echo $stage_3['data']['nm_ori']; ?> Nm
                                    </span>
                                    <span>
                                        <?php echo $stage_3['data']['nm_tuning']; ?> Nm
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="ctr-flex ctr-justify-center ctr-gap-2.5 ctr-text-lg ctr-text-white">
                                    <span class="ctr-line-through ctr-opacity-60">
                                        <?php echo round($stage_3['data']['hp_ori'] * 0.745699872); ?> KW
                                    </span>
                                    <span>
                                        <?php echo $stage_3['data']['hp_tuning'] > 0 ? round($stage_3['data']['hp_ori'] * 0.745699872) + $stage_3_plusKw : '-'; ?> KW
                                    </span>
                                </div>
                            </td>
                            <!-- TO HERE -->
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- TABS END -->
        </div>
        <span class="tableSeperatorA"></span>
        <span class="tableSeperatorB"></span>
    </div>
</div>

<style>
    .maintab-content {
        display: none;
        z-index: 20;
        position: relative;
        background: #262626;
        margin-top: -2px;
    }

    .maintab-content h2 {
        margin-top: 0;
    }


    .tabButton {
        background-color: white;
        outline: none;
        color: #262626
    }

    .tabButton:hover {
        background-color: #bababa;
        outline: none;
        color: #ffffff;
    }

    .tabButton:focus,
    .tabButton:active {
        background-color: #262626;
        outline: none;
        color: #ffffff;
    }

    .lightOn {
        background: #262626;
        color: #ffffff;
    }

    table td,
    table th {
        border: 1px solid hsl(0deg 0% 50.2% / 0%);
    }

    button:focus,
    button:hover {
        color: #5046e4;
    }

    .tableSeperatorA {
        background: #e0e0e0;
        width: 2px;
        height: 100%;
        position: absolute;
        top: 0px;
        left: 33%;
        z-index: 20;
    }

    .tableSeperatorB {
        background: #e0e0e0;
        width: 2px;
        height: 100%;
        position: absolute;
        top: 0px;
        left: 66%;
        z-index: 20;
    }
</style>

<script>
    function openmaintab(evt, maintabName) {
        var i, maintabContent, maintabBtn;

        // Hide all maintab content
        maintabContent = document.getElementsByClassName('maintab-content');
        for (i = 0; i < maintabContent.length; i++) {
            maintabContent[i].style.display = 'none';
        }

        // Remove 'active' class from all maintab buttons
        maintabBtn = document.getElementsByClassName('tabButton');
        for (i = 0; i < maintabBtn.length; i++) {
            maintabBtn[i].className = maintabBtn[i].className.replace(' lightOn', '');
        }

        // Show the selected maintab content and set the button as active
        document.getElementById(maintabName).style.display = 'block';
        evt.currentTarget.className += ' lightOn';
    }

    // Open the first maintab by default
    function initializePage() {
        document.getElementById('maintab1').style.display = 'block';
        document.getElementById('firstTab').className += ' lightOn';
    }

    // Call the initializePage function when the page loads
    window.onload = initializePage;
</script>