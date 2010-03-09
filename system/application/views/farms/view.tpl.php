<style>
.smallcounter{height:25px;width:100px;padding:2px;color:#60ABD2}
.healthcounter{height:50px;width:200px}

</style>

<script>
    function ajax_request(handler, url, params ,callback) {
        $(handler).loading({
                            pulse: false,
                            text: 'Loading',
                            align: 'center',
                            img: '<?= $base_img ?>ajax-loader.gif' ,
                            delay: '200',
                            max: '1000',
                            mask: true
                            });
        $(handler).load(url, params,callback);
        
    }

    function liftOff() {
        alert($(this).parent().attr('class')+' Expired');
    }

    function moneyCalculate()
    {
       ajax_request('#moneyHolder', '<?= base_url() ?>farms/moneyCalc');
    }

    function addResourceToFarm(farm_id , resource_id){
	var params = {};
     	params['farm_id'] = farm_id;
	params['resource_id'] = resource_id;

        ajax_request('#farmResourceHolder', '/farms/addResourceToFarm', params ,moneyCalculate)
    }
    
    function addAccessoryToFarm(farm_id , accessory_id){
	var params = {};
     	params['farm_id'] = farm_id;
	params['accessory_id'] = accessory_id;

        ajax_request('#farmAccessoryHolder', '/farms/addAccessoryToFarm', params)
    }

    function addPlantToFarm(farm_id , type_id){
	var params = {};
     	params['farm_id'] = farm_id;
	params['type_id'] = type_id;

        ajax_request('#plantHolder', '/farms/addPlantToFarm', params)
    }
    function addResourceToPlant(resource_id , plant_id){
	var params = {};
     	params['plant_id'] = plant_id;
	params['resource_id'] = resource_id;

        ajax_request('#plantHolder', '/farms/addResourceToPlant', params)
    }
    function reap(plant_id)
    {
        var params = {};
        params['plant_id'] = plant_id;

        ajax_request('#plantHolder', '/farms/reap', params)
    }

    function addtransaction(goal_farm,off_farm,acc_id,type)
    {
	var params = {};
	params['goal_farm'] = goal_farm;
	params['off_farm'] = off_farm;
	params['acc_id'] = acc_id;
	params['type'] = type;
	ajax_request('#viewerAccessoryHolder','<?= base_url() ?>farmtransactions/add',params)
    }

    
</script>
<div id="farmWrapper">

    <div id="farmAccessories">
        <h4>Viewer Accessories</h4>
        <span id="viewerAccessoryHolder"></span>
        <?php
        foreach ($viewerAccessories AS $fAcc)
		echo anchor("farmtransactions/add/",
                            "$fAcc->name : $fAcc->count ",
                             array('onclick'=>"addtransaction($farm->id,$fAcc->farm_id,$fAcc->accessory_id,$fAcc->type);return false;"))."<br/>";
        ?>
    </div>


    <div id="farm">
        <h4>Farm Plants</h4>
        PlantType:<?= $plant->typeName ?><br/>
        FarmSection:<?= $farm->section ?>
        
        <div id="plantHolder"></div>
        
        
    </div>

    <div id="farmOwner">
        <h4>Farm Owner</h4>
        FarmName:<?= anchor("profile/user/$farm->user_id", $farm->name) ?><br/>
        FarmLevel:<?= $farm->level ?><br/>
            FarmMoney:<span id="moneyHolder"><?= $farm->money ?></span>$
    </div>


    <div id="health">
        <h4>Plant Health</h4>
        PlantHealth:<?= $plant->health ?>

        <?php if($plant->growth > 0): ?>
                PlantGrowth:
        <div id="plantGrowthHolder" class="healthcounter"></div>
        <script>
            $(function () {
                var growthTime = <?= $plant->growth; ?>;
                $('#plantGrowthHolder').countdown({until: growthTime,
                                                   onExpiry: liftOff
                                                 });
            });
        </script>

        <?php elseif($plant->id):
                echo anchor("farms/reap/$plant->id",
                            "REAP",
                             array('onclick'=>"reap(".$plant->id.");return false;"))."<br/>";
              endif;
        ?>
    </div>
    
    <div id="farmResource">
        <h4>Farm Resources</h4>
        <span id="farmResourceHolder">
            <?= $farmResources ?>
        </span>
    </div>

    <div id="plantResource">
        <h4>Plant Resources</h4>
        <span id="plantResourceHolder">
        <?php
        if(isset($plant->plantresources))
        foreach($plant->plantresources AS $pltSrc)
        {
                ?>
                <div class="bubbleInfo">
                <?php
                foreach($pltSrc->typeresource AS $typSrc)
                        foreach($typSrc->resource AS $src)
                                echo "<img class=\"trigger\" id=\"download\" src=\"".$base_img."farm/resource/".strtolower($src->name).".png\" height=\"48px\" weidth=\"48px\" /> ";
                ?>

                <table id="dpop" class="popup">
                        <tbody>
                            <tr>
                                    <td id="topleft" class="corner"></td>
                                    <td class="top"></td>
                                    <td id="topright" class="corner"></td>
                            </tr>
                            <tr>
                                    <td class="left"></td>
                                    <td>
                                        <table class="popup-contents">
                                            <tbody>
                                                <tr>
                                                    <th>Time:</th>
                                                    <td class="<?= $src->name ?>">
                                                        <div id="srcRemainTimeHolder<?= $pltSrc->id ?>" class="smallcounter"></div>
                                                        <script>
                                                            $(function () {
                                                                var remainTime = <?= $pltSrc->usedTime; ?>;
                                                                $('#srcRemainTimeHolder<?= $pltSrc->id ?>').countdown({until: remainTime,
                                                                                                                       onExpiry: liftOff ,
                                                                                                                       expiryText: '<div class="over"><?= $src->name ?> Expired</div>'
                                                                                                                       });
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="right"></td>
                            </tr>
                            <tr>
                                    <td class="corner" id="bottomleft"></td>
                                    <td class="bottom"><img width="30" height="29" alt="popup tail" src="<?= $base_img ?>popup/bubble-tail2.png"/></td>
                                    <td id="bottomright" class="corner"></td>
                            </tr>
                        </tbody>
                </table>
            </div>
        <?php
        }
        ?>
        </span>
    </div>

    <div id="farmAccessories">
        <h4>Farm Accessories</h4>
        <span id="farmAccessoryHolder">
        <?php
        foreach ($farmAcc AS $fAcc)
        {
                echo "Name: ".$fAcc->name." Type:".$fAcc->type."<br/>";
        }
        ?>
        </span>
    </div>
    
    
</div>
