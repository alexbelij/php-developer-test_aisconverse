<?php
/*
Plugin Name: PHP Version Check
Plugin URI: http://delab.by
Description: Проверяет версию php на сервере.
Version: 0.1
Author: Aliaksandr Khrol
Author URI: http://delab.by
*/
/*  Copyright 2015  Aliaksandr Khrol  (email: info@delab.by)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define( 'PLUGIN_VERSION', '1.0' );
define( 'PLUGIN__MINIMUM_PHP_VERSION', '5.3' );
define( 'PLUGIN__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
register_activation_hook( __FILE__, array( 'phpVCfunc', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'phpVCfunc', 'plugin_deactivation' ) );
require_once( PLUGIN__PLUGIN_DIR . 'class.phpvcfunc.php' );
?>