<?php
if(!class_exists('gettazetting'))
{
	class gettazetting
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} // END public function __construct
		
        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
        	// register your plugin's settings
        	register_setting('gettazetting-group', 'getta_key');
        	register_setting('gettazetting-group', 'getta_secret');
        	register_setting('gettazetting-group', 'getta_track');
			register_setting('gettazetting-group', 'getta_num');
			register_setting('gettazetting-group', 'getta_css');

        	// add your settings section
        	add_settings_section(
        	    'gettazetting-section', 
        	    'GettaZone Adminstrator', 
        	    array(&$this, 'settings_section_gettazetting'), 
        	    'gettazetting'
        	);
        	
        	// add your setting's fields
            add_settings_field(
                'gettazetting-getta_key', 
                'Amazon Access Key', 
                array(&$this, 'settings_field_input_text'), 
                'gettazetting', 
                'gettazetting-section',
                array(
                    'field' => 'getta_key'
                )
            );
            add_settings_field(
                'gettazetting-getta_secret', 
                'Amazon Secret Key', 
                array(&$this, 'settings_field_input_text'), 
                'gettazetting', 
                'gettazetting-section',
                array(
                    'field' => 'getta_secret'
                )
            );
			add_settings_field(
                'gettazetting-getta_track', 
                'Amazon Tracking ID', 
                array(&$this, 'settings_field_input_text'), 
                'gettazetting', 
                'gettazetting-section',
                array(
                    'field' => 'getta_track'
                )
            );
			add_settings_field(
                'gettazetting-getta_num', 
                'Number of Product to Show. Max: 10', 
                array(&$this, 'settings_field_input_text'), 
                'gettazetting', 
                'gettazetting-section',
                array(
                    'field' => 'getta_num'
                )
            );
			add_settings_field(
                'gettazetting-getta_css', 
                'CSS Box', 
                array(&$this, 'settings_field_textarea'), 
                'gettazetting', 
                'gettazetting-section',
                array(
                    'field' => 'getta_css'
                )
            );
            // Possibly do additional admin_init tasks
        } // END public static function activate
        
        public function settings_section_gettazetting()
        {
            // Think of this as help text for the section.
            echo 'Insert your credentials Key from Amazon Affiliate website.';
        }
        
        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" size="70" />', $field, $field, $value);
        } // END public function settings_field_input_text($args)
		
		public function settings_field_textarea($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
			$value = get_option($field);
			
            // echo a proper input type="text"
            echo sprintf('<textarea type="text" name="%s" id="%s" rows="15" cols="90" />%s</textarea>', $field, $field, $value);
        } // END public function settings_field_textarea($args)
        
        /**
         * add a menu
         */		
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
        	add_options_page(
        	    'GettaZone Settings', 
        	    'GettaZone', 
        	    'manage_options', 
        	    'gettazetting', 
        	    array(&$this, 'gettazetting_page')
        	);
        } // END public function add_menu()
    
        /**
         * Menu Callback
         */		
        public function gettazetting_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/layout/settings.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
    } // END class WP_Plugin_Template_Settings
} // END if(!class_exists('WP_Plugin_Template_Settings'))
