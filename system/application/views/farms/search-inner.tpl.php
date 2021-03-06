<div id="searchItems">
<?php
    if(is_array($items))
            foreach($items as $x => $k):
?>
            <div class="item">
                <span class="searchAvatar">
                    <a href="<?= base_url() ?>profile/user/<?= $k->user_id ?>">
                                <img src="<?= $base_img ?>farm_default.gif" border="0" width="53px" height="62px"/>
                    </a>
                </span>
                <span class="searchField">
                    <a href="<?= base_url() ?>profile/user/<?= $k->user_id ?>">
                        <?= $k->name ?>
                    </a>
                </span>

                <span class="searchField">
                    <span><?= $lang['level_label'] ?>:</span>
                    <B>
                        <?php
                        if($k->level == 11)
                            echo $lang['endGame'];
                        else
                            echo convert_number($k->level . "")
                        ?>
                    </B>
                </span>

                <span class="searchField">
                    <span><?= $lang['farmMoney'] ?>:</span>
                    <B><?= $k->money ?></B> <?= $lang['yummyMoneyUnit'] ?>
                </span>
            </div>
            <?php endforeach; ?>
</div>
<div id="searchPager">
        <span class="pagerItem">
            <?= anchor("",
                       $lang['last'],
                       array('onclick'=>"searchPager(".ceil($cnt / 8).",$cnt);return false;"));
            ?>
        </span>
        <span class="pagerItem">
            <?php $nextPage = $page+1; ?>
            <?= anchor("",
                       $lang['next'],
                       array('onclick'=>"searchPager($nextPage,$cnt);return false;"));
            ?>
        </span>
        <span class="pagerItem">
            <form id="searchPagerForm" onsubmit="searchPager(0,<?= $cnt ?>);return false;">
                <input type="text"  name="page" id="page" value="<?= $page ?>" style="width:30px; text-align:center;" maxlength="4" />
            </form>
        </span>
        <span class="pagerItem">
            <?php $previuosPage = $page-1; ?>
            <?= anchor("",
                       $lang['previuos'],
                       array('onclick'=>"searchPager(". $previuosPage .",$cnt);return false;"));
            ?>
        </span>
        <span class="pagerItem">
            <?= anchor("",
                       $lang['first'],
                       array('onclick'=>"searchPager(1,$cnt);return false;"));
            ?>
        </span>
</div>