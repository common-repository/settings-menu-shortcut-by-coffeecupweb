<?php
/*
Plugin Name: Settings Menu Shortcut
Plugin URI:  http://coffeecupweb.com/
Description: A handy WordPress plugin which adds a Settings Menu shortcut to the toolbar,  allowing you to access the settings menu from admin bar instead of navigating all the way to Dashboard.
Version:     1.0.0
Author:      Harshal Limaye
Author URI: http://coffeecupweb.com/
License:     GPLv2 or later
*/


/*
Copyright (c) 2014, Harshal Limaye.

This program is free software; you can redistribute it and/or 
modify it under the terms of the GNU General Public License 
as published by the Free Software Foundation; either version 2 
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
GNU General Public License for more details.

You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


/* ============================================================================================================================================= */

class CCWSettingsLink{
	private static $instance;
	
	private function __construct(){
		add_action( 'admin_bar_menu',array($this,'admin_bar_settings_link'),999 );
	}
	
	public static function getInstance(){
		if(null == self::$instance){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function admin_bar_settings_link() {
			global $wp_admin_bar;
			if ( !is_super_admin() || !is_admin_bar_showing() )
				return;
			
			if(!current_user_can('manage_options'))
				return;
				
			if(is_admin())
				return;
			
			$wp_admin_bar->add_menu(array( 
				'id' => 'settings',
				'title' => __('Settings'),
				'href' => admin_url( 'options-general.php')
			));
			$wp_admin_bar->add_menu(array( 
				'id' => 'options-general',
				'parent'=>'settings',
				'title' => __('General'),
				'href' => admin_url( 'options-general.php')
			));
			$wp_admin_bar->add_menu(array( 
				'id' => 'options-writing',
				'parent'=>'settings',
				'title' => __('Writing'),
				'href' => admin_url( 'options-writing.php')
			));
			$wp_admin_bar->add_menu(array( 
				'id' => 'options-reading',
				'parent'=>'settings',
				'title' => __('Reading'),
				'href' => admin_url( 'options-reading.php')
			));
			$wp_admin_bar->add_menu(array( 
				'id' => 'options-discussion',
				'parent'=>'settings',
				'title' => __('Discussion'),
				'href' => admin_url( 'options-discussion.php')
			));
			$wp_admin_bar->add_menu(array( 
				'id' => 'options-media',
				'parent'=>'settings',
				'title' => __('Media'),
				'href' => admin_url( 'options-media.php')
			));
			$wp_admin_bar->add_menu(array( 
				'id' => 'options-permalink',
				'parent'=>'settings',
				'title' => __('Permalink'),
				'href' => admin_url( 'options-permalink.php')
			));
	}

}
add_action('plugins_loaded',array('CCWSettingsLink','getInstance'))
?>