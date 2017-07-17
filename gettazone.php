<?php
/*
Plugin Name: GettaZone - Get the Amazon E-commerce
Plugin URI: http://www.pixelcastle.net
Description: This plugins will retrieve any products from amazon and insert it at the end of your post. 
Version: 1.0
Author: Puguh Wijayanto
Author URI: http://www.pixelcastle.net
License: Free
*/
/*
Copyright 2013  Puguh Wijayanto  (email : info@pixelcastle.net)
*/

if(!class_exists('GettaZone'))
{
	class GettaZone
	{
		public $public_key;
		public $private_key;
		public $associate_tag;
		public function __construct()
		{
			$gettazone_v = "1.0";
						
        	// Initialize Settings
            require_once(sprintf("%s/settings.php", dirname(__FILE__)));
            $getta = new gettazetting();
			
			$public_key = get_option('getta_key');
			$private_key = get_option('getta_secret');
			$associate_tag = get_option('getta_track');
			
			include(sprintf("%s/inc/amazon_api_class.php", dirname(__FILE__)));
			//$azone = new AmazonProductAPI($public_key, $private_key, $associate_tag);
			include(sprintf("%s/function.php", dirname(__FILE__)));
		}
		
		public function activate()
		{
		
		}
		
		public function deactivate()
		{
		
		}
	}
}

if(class_exists('GettaZone'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('GettaZone', 'activate'));
	register_deactivation_hook(__FILE__, array('GettaZone', 'deactivate'));

	// instantiate the plugin class
	$gettazone = new GettaZone();
	
    // Add a link to the settings page onto the plugin page
    if(isset($gettazone))
    {
        // Add the settings link to the plugins page
        function plugin_settings_link($links)
        { 
            $settings_link = '<a href="options-general.php?page=gettazone">Settings</a>'; 
            array_unshift($links, $settings_link); 
            return $links; 
        }

        $plugin = plugin_basename(__FILE__); 
        add_filter("plugin_action_links_$plugin", 'plugin_settings_link');
    }
}



?>