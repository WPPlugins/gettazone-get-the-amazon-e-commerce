<div class="wrap">
    <h2>GettaZone <?php echo $gettazone_v;?> Settings</h2>
	<div style="width: 70%; float: left">
    <form method="post" action="options.php"> 
        <?php @settings_fields('gettazetting-group'); ?>
        <?php @do_settings_fields('gettazetting-group'); ?>

        <?php do_settings_sections('gettazetting'); ?>

        <?php @submit_button(); ?>
    </form>
	</div>
	<div  style="width: 30%; float: left"><h2>donate me !!</h2>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_donations">
		<input type="hidden" name="business" value="paypal@belipulsaonline.com">
		<input type="hidden" name="lc" value="US">
		<input type="hidden" name="item_name" value="GettaZone Plugins">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="currency_code" value="USD">
		<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
		donate me if you think this plugin is useful.
	</div>
</div>