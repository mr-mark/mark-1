<style>
    .boxy-inner{height:400px!important}
    .main-content{height:400px!important}
    #ajaxAlertBox
    {
        background: url(<?= $base_img ?>attention.png) top right no-repeat;
        padding-right: 40px;
        float: right;
        margin:8px 12px 0 0;
        width:150px;
        height: 30px;
        display:block;
        display: none;
    }
</style>
<script>
    $('#ajaxAlertBox').html('<?php echo str_replace(array('__RESOURCE__','__FARMRESOURCE__','__NEED__'),
                                       array($lang[strtolower($params['resource'])],$params['farm_resource'],$params['need']),
                                       $lang['resource']['body'])  ?>').fadeIn('slow');
</script>

