<?php if ($config['site']['widget_PremiumBox']) { ?>
<!-- Premium theme box -->
<style>
    .ribbon-double {
        background: url(<?php echo $layout_name; ?>/images/shop/ribbon-double.png) no-repeat;
        width: 80px;
        height: 80px;
        position: absolute;
        right: 0;
        top: -1px;
    }
</style>
<div id="PremiumBox2" class="Themebox2" style="background-image:url(<?php echo $layout_name; ?>/images/global/themeboxes/premium/themebox.png);">
<div id="doublePointsSelector"><?php $doubleStatus = $SQL->query("SELECT `value` FROM `server_config` WHERE `config` = 'double'")->fetch();
if ($doubleStatus['value'] == "active") echo '<div class="ribbon-double"></div>'; ?></div>
<div id="PremiumBoxDecor2" style="background-image:url(<?php echo $layout_name; ?>/images/global/themeboxes/premium/coin_animation.gif);"></div>
<div id="PremiumBoxBg2" style="background-image:url(<?php echo $layout_name; ?>/images/global/themeboxes/premium/coins_consumables.png);"></div>
<div id="PremiumBoxOverlay2" style="background-image:url(<?php echo $layout_name; ?>/images/global/themeboxes/premium/type_overlay.png);"><p id="PremiumBoxOverlayText2">Get Supplies Anywhere!</p></div>
<div id="PremiumBoxButton2"><form action="?subtopic=accountmanagement&action=donate" method="post" style="padding:0px;margin:0px;"><div class="WebshopButton" style="background-image:url(<?php echo $layout_name; ?>/images/global/buttons/button.png)"><div onmouseover="MouseOverWebshopButton(this);" onmouseout="MouseOutWebshopButton(this);"><div class="WebshopButtonOver" style="background-image:url(<?php echo $layout_name; ?>/images/global/buttons/button_hover.png); visibility: hidden;"></div><input class="WebshopButtonText" type="image" name="Get Coins" alt="Get Coins" src="<?php echo $layout_name; ?>/images/global/buttons/get_tibia_coins.png"></div></div></form></div>
<div id="PremiumBoxButtonDecor2" style="background-image:url(<?php echo $layout_name; ?>/images/global/themeboxes/premium/button_tibia_coins.png);">
</div>
</div>
<!-- END Premium theme box -->
<?php }?>
