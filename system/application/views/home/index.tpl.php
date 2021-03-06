<style>
    #content{background: #536229;}
    .boxy-inner {height: 80px!important;overflow:auto;}
    .main-content{height:80px!important;}
    .boxy-content{padding:0px 20px!important}
    .boxy-wrapper .question {min-height: 35px!important;}
</style>
<div id="homeWrapper">
    <div id="rightBox">
        <div id="welcome">
            <div class="title"></div>
            <div class="description"><?= $lang['welcome'] ?></div>
        </div>
        
        <div id="loginFormHolder">
            <?php if(!$user->id): ?>
            <div class="register">
                <?= anchor('registration/index',$this->lang->language['registeration'],array('class'=>'whiteBoldLink')) ?>
            </div>
            <div class="title"></div>
            <?php else: ?>
            <div class="titleLogged"></div>
            <?php endif; ?>
            <div class="form">
                <?php
                                $this->load->module('login');
                                $this->login->method(array("user" => $user, "lang" => $lang));
                ?>
            </div>
        </div>
        <div id="productAmount">
            <div class="counter">
                <?php 
                $number = $allExistsFarm;
                $number = (string) $number;
                $number = preg_split('//', $number, -1);
                $number = array_reverse($number);
                foreach($number AS $k=>$i)
                    if($k != 0 && $k != count($number)-1)
                    echo "<span class=\"numbers\" style=\"background-position:-".($i*30)."px 0\"></span>";
                ?>
            </div>
            <div class="discription">
                <?= $lang['allFarmExists'] ?>
            </div>
        </div>
        <div id="bestFarmers">
            <div class="title"></div>
            <div class="userList">
                <ul>
                <?php if(is_array($bestUsers)): ?>
                    <?php foreach($bestUsers AS $bUser): ?>
                        <li>
                            <?php if($bUser->photo != ""): ?>
                                <a href="<?= base_url() ?>profile/user/<?= $bUser->id ?>">
                                    <img src="<?= css_url() ?>system/application/helpers/fa_image_helper.php?nw=57&nh=57&source=<?= $avatar_img."avatars/".$bUser->photo.".png" ?>&stype=png&dest=x&type=little" border="0" />
                                    <span><?= $bUser->first_name." ".$bUser->last_name ?></span>
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url() ?>profile/user/<?= $bUser->id ?>">
                                    <?php if($bUser->sex == 0): ?>
                                        <img src="<?= css_url() ?>system/application/helpers/fa_image_helper.php?nw=57&nh=57&source=<?= $avatar_img."avatars/default-m.png" ?>&stype=png&dest=x&type=little" border="0" />
                                    <?php else: ?>
                                        <img src="<?= css_url() ?>system/application/helpers/fa_image_helper.php?nw=57&nh=57&source=<?= $avatar_img."avatars/default-f.png" ?>&stype=png&dest=x&type=little" border="0" />
                                    <?php endif; ?>
                                    <span><?= $bUser->first_name." ".$bUser->last_name ?></span>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div id="leftBox">
        <div id="registrationHotspot">
            <?= anchor(base_url()."registration", " ") ?>
        </div>
    </div>
</div>

<script>
<?php
if($reason != "") {
?>
    var reason = "<?= $reason ?>";
        if(reason != "") {
                        Boxy.alert("<?= $lang['loginError'] ?>", null, {title:"<?= $lang['filling_error'] ?>"});
            }
<?php
}
?>
</script>