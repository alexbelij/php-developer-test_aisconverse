<?php
class phpVCfunc {
	/**
	 * Activation
	 * @static
	 */
	public static function plugin_activation() {
		$cur_vers = phpversion();
		if ( $cur_vers < PLUGIN__MINIMUM_PHP_VERSION ) {
			phpVCfunc::fail_on_checked($cur_vers);
		}
	}
	/**
	 * Removes all options
	 * @static
	 */
	public static function plugin_deactivation( ) {
	}
	private static function fail_on_checked($cur_vers) {
	?>
		<!doctype html>
		<html>
		<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<style>
		* {
			text-align: center;
			margin: 0;
			padding: 0;
			font-family: Arial,sans-serif;
		}
		p {
			margin-top: 1em;
			font-size: 14px;
		}
		</style>
		<body>
		<p>Your version of PHP <?php echo $cur_vers; ?>. Plugin requires PHP <?php echo PLUGIN__MINIMUM_PHP_VERSION; ?> or heigher.</p>
		</body>
		</html>
	<?php
		$plugins = get_option( 'active_plugins' );
		$akismet = plugin_basename( PLUGIN__PLUGIN_DIR . 'phpvcfunc.php' );
		foreach ( $plugins as $i => $plugin ) {
			if ( $plugin === $akismet ) {
				$plugins[$i] = false;
				$update = true;
			}
		}
		if ( $update ) {
			update_option( 'active_plugins', array_filter( $plugins ) );
		}
		exit;
	}
}
?>