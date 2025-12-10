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
    <div class="flex gap-4 ml-4 z-20">
        <?php if (isset($stage_1['name'])) { ?>
            <button id="firstTab" class="tabButton border-0 pt-1 pb-1 md:pb-2 px-1 md:px-4 flex flex-col text-center text-[#656565] rounded-t-lg md:rounded-t-2xl cursor-pointer selected" onclick="openmaintab(event, 'maintab1')"><span class="font-medium text-lg" id="button_title_txt">Stage 1</span>
            <span id="button_value_txt" class="text-ctr-orange" style="font-size: 14px;"> (+ <?php echo $stage_1['data']['hp_tuning'] - $stage_1['data']['hp_ori']; ?> HP)</span></button>
        <?php } ?>
        <?php if (isset($stage_2['name'])) { ?>
            <button class="tabButton relative border-0 pt-1 pb-1 md:pb-2 px-1 md:px-4 flex flex-col text-center text-[#656565] rounded-t-lg md:rounded-t-2xl cursor-pointer selected" onclick="openmaintab(event, 'maintab2')"><span class="font-medium text-lg" id="button_title_txt">Stage 2</span>
            <span id="button_value_txt" class="text-ctr-orange" style="font-size: 14px;"> (+ <?php echo $stage_2['data']['hp_tuning'] - $stage_2['data']['hp_ori']; ?> HP)</span>
        </button>
        <?php } ?>
        <?php if (isset($stage_3['name'])) { ?>
            <button class="tabButton border-0 pt-1 pb-1 md:pb-2 px-1 md:px-4 flex flex-col text-center text-[#656565] rounded-t-lg md:rounded-t-2xl cursor-pointer selected" onclick="openmaintab(event, 'maintab3')"><span class="font-medium text-lg" id="button_title_txt">Stage 3</span>
            <span id="button_value_txt" class="text-ctr-orange" style="font-size: 14px;"> (+ <?php echo $stage_3['data']['hp_tuning'] - $stage_3['data']['hp_ori']; ?> HP)</span>
        </button>
        <?php } ?>
    </div>
    <div class="tuning_table relative rubik">
        <div class="table-responsive stageTableBlock ">
            <div id="maintab1" class="maintab-content rounded-lg md:rounded-2xl text-center">
                <table>
                    <tbody>
                        <tr class="stageTableRow text-2xl">
                            <!-- ROW 1 FROM HERE -->
                            <td class="table_big_value">
                                <span class="text-ctr-orange font-bold">+
                                    <?php echo $stage_1['data']['hp_tuning'] - $stage_1['data']['hp_ori']; ?> HP
                                </span>
                            </td>
                            <td class="table_big_value">
                                <span class="text-ctr-orange font-bold">+
                                    <?php echo $stage_1['data']['nm_tuning'] - $stage_1['data']['nm_ori']; ?> NM
                                </span>
                            </td>
                            <td class="table_big_value">
                                <span class="text-ctr-orange font-bold">+
                                    <?php echo $stage_1['data']['hp_tuning'] > 0 ? round($stage_1['data']['hp_tuning'] * 0.745699872) - round($stage_1['data']['hp_ori'] * 0.745699872) : '-'; ?> KW
                                </span>
                            </td>
                            <!-- TO HERE -->
                        </tr>
                        <tr class="stageTableRow">
                            <!-- ROW 2 FROM HERE -->
                            <td>
                                <div class="flex justify-center gap-2.5 text-xl">
                                    <span class="line-through opacity-60">
                                        <?php echo $stage_1['data']['hp_ori']; ?> HP
                                    </span>
                                    <span>
                                        <?php echo $stage_1['data']['hp_tuning']; ?> HP
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center gap-2.5 text-xl">
                                    <span class="line-through opacity-60">
                                        <?php echo $stage_1['data']['nm_ori']; ?> Nm
                                    </span>
                                    <span>
                                        <?php echo $stage_1['data']['nm_tuning']; ?> Nm
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center gap-2.5 text-xl">
                                    <span class="line-through opacity-60">
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
            <div id="maintab2" class="maintab-content rounded-lg md:rounded-2xl text-center">
            <table>
                    <tbody>
                        <tr class="stageTableRow text-2xl">
                            <!-- ROW 1 FROM HERE -->
                            <td class="table_big_value">
                                <span class="text-ctr-blue font-bold">+
                                    <?php echo $stage_2['data']['hp_tuning'] - $stage_2['data']['hp_ori']; ?> HP
                                </span>
                            </td>
                            <td class="table_big_value">
                                <span class="text-ctr-blue font-bold">+
                                    <?php echo $stage_2['data']['nm_tuning'] - $stage_2['data']['nm_ori']; ?> NM
                                </span>
                            </td>
                            <td class="table_big_value">
                                <span class="text-ctr-blue font-bold">+
                                    <?php echo $stage_2['data']['hp_tuning'] > 0 ? round($stage_2['data']['hp_tuning'] * 0.745699872) - round($stage_2['data']['hp_ori'] * 0.745699872) : '-'; ?> KW
                                </span>
                            </td>
                            <!-- TO HERE -->
                        </tr>
                        <tr class="stageTableRow">
                            <!-- ROW 2 FROM HERE -->
                            <td>
                                <div class="flex justify-center gap-2.5 text-xl">
                                    <span class="line-through opacity-60">
                                        <?php echo $stage_2['data']['hp_ori']; ?> HP
                                    </span>
                                    <span>
                                        <?php echo $stage_2['data']['hp_tuning']; ?> HP
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center gap-2.5 text-xl">
                                    <span class="line-through opacity-60">
                                        <?php echo $stage_2['data']['nm_ori']; ?> Nm
                                    </span>
                                    <span>
                                        <?php echo $stage_2['data']['nm_tuning']; ?> Nm
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center gap-2.5 text-xl">
                                    <span class="line-through opacity-60">
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
            <div id="maintab3" class="maintab-content rounded-lg md:rounded-2xl text-center">
            <table>
                    <tbody>
                        <tr class="stageTableRow text-2xl">
                            <!-- ROW 1 FROM HERE -->
                            <td class="table_big_value">
                                <span class="text-ctr-blue font-bold">+
                                    <?php echo $stage_3['data']['hp_tuning'] - $stage_3['data']['hp_ori']; ?> HP
                                </span>
                            </td>
                            <td class="table_big_value">
                                <span class="text-ctr-blue font-bold">+
                                    <?php echo $stage_3['data']['nm_tuning'] - $stage_3['data']['nm_ori']; ?> NM
                                </span>
                            </td>
                            <td class="table_big_value">
                                <span class="text-ctr-blue font-bold">+
                                    <?php echo $stage_3['data']['hp_tuning'] > 0 ? round($stage_3['data']['hp_tuning'] * 0.745699872) - round($stage_3['data']['hp_ori'] * 0.745699872) : '-'; ?> KW
                                </span>
                            </td>
                            <!-- TO HERE -->
                        </tr>
                        <tr class="stageTableRow">
                            <!-- ROW 2 FROM HERE -->
                            <td>
                                <div class="flex justify-center gap-2.5 text-xl">
                                    <span class="line-through opacity-60">
                                        <?php echo $stage_3['data']['hp_ori']; ?> HP
                                    </span>
                                    <span>
                                        <?php echo $stage_3['data']['hp_tuning']; ?> HP
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center gap-2.5 text-xl">
                                    <span class="line-through opacity-60">
                                        <?php echo $stage_3['data']['nm_ori']; ?> Nm
                                    </span>
                                    <span>
                                        <?php echo $stage_3['data']['nm_tuning']; ?> Nm
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center gap-2.5 text-xl">
                                    <span class="line-through opacity-60">
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
    background: rgb(255, 255, 255);
    margin-top: -2px;
    box-shadow: 0px 0px 19px -6px rgba(80.00000000000036, 70.00000000000001, 228, 0.71);
    }

    .maintab-content h2 {
        margin-top: 0;
    }
    .tabButton {background-color: white;outline: none;}
    .tabButton:hover, .tabButton:focus, .tabButton:active {background-color: white;outline: none;}
    .lightOn {
            box-shadow: 0px 4px 20px -5px rgba(80, 70, 228, 0.71);
        }
        table td, table th {
    border: 1px solid hsl(0deg 0% 50.2% / 0%);
}
button:focus, button:hover {
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