<?php
/*
Plugin Name: WP-Obfuscator
Plugin Title: WP-Obfuscator
Plugin URI: http://seraum.com
Description: This extension obfuscate your wp-config.php file to make it unreadable by a hacker. Please, save your wp-config.php file before to obfuscate it. Launch obfuscation when your site is ready to production.
Author: Adrien Thierry
Version: 0.6
Author URI: http://seraum.com/
Text Domain: wpobfuscator
*/
class wpobfuscator
{
	function __construct()
	{
		if(is_admin())
		{
			add_action('init', array($this, 'wpo_lang_init'));
			add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this, 'wpo_action_links' ));
			register_activation_hook( __FILE__, array($this, 'wpo_activate' ));
			register_deactivation_hook( __FILE__, array($this, 'wpo_deactivate' ));
			add_action( 'admin_init', array($this, 'wpo_register' ));
			add_action('admin_menu', array($this, 'wpo_add_admin_menu'));
			$state = get_option('wpo_state');
			if ((!isset($state) || $state == "0"))
			{
				if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] != 'WP-Obfuscator'))
				{
					add_action('admin_notices', array($this, 'wpo_admin_notice'));
				}
			}
		}
	}
	
	function wpo_lang_init()
	{
		load_plugin_textdomain( 'wpobfuscator', false, dirname( plugin_basename( __FILE__ ) ) . "/languages" );
	}

	function wpo_activate()
	{
		add_option("wpo_state", "0");
		add_option("wpo_depth", "1");
		$c = base64_encode($this->wpo_get_config());
		add_option("wpo_config", $c);
	}
	function wpo_deactivate()
	{
		$this->wpo_deobfusc();
	}
	function wpo_obfusc()
	{
		require_once(dirname(__FILE__) . '/' . 'files' . '/' . 'class' . '/' . 'seraum_obf.php');
		ob_start();
		$p = ABSPATH . 'wp-config.php';
		$c = $this->wpo_get_config();
		$it = get_option('wpo_depth');
		$sobf = new Free_Obfusc();
		$o =  $sobf->doIt($c, $it);	
		file_put_contents($p, $o);
		ob_clean();
	}
	function wpo_deobfusc($d = true)
	{
		$state = get_option('wpo_state');
		if($state)
		{
			ob_start();
			$p = ABSPATH . 'wp-config.php';
			$c = $this->wpo_backup_config();	
			file_put_contents($p, $c);
			if($d) 
			{
				delete_option('wpo_state');
				delete_option("wpo_config");
				delete_option("wpo_depth");
			}
			ob_clean();
		}
	}

	function wpo_update_config()
	{
		$p = ABSPATH . 'wp-config.php';
		$c = base64_encode(file_get_contents($p));
		update_config("wpo_config", $c);
	}

	function wpo_get_config()
	{
		$p = ABSPATH . 'wp-config.php';
		$c = file_get_contents($p);
		return $c;
	}

	function wpo_backup_config()
	{
		$c = base64_decode(get_option("wpo_config"));
		return $c;
	}
	function wpo_add_admin_menu()
	{
		add_menu_page('WP-Obfuscator', 'WP-Obfuscator', 'manage_options', 'WP-Obfuscator', array($this, 'wpo_menu_html'));
	}
	function wpo_menu_html()
	{
		echo '<h1>WP-Obfuscator</h1>';
		echo '<br />';
		?>
		<div class="wrap">
		 
				
				<?php $state = get_option('wpo_state'); ?>
				<?php $wpo_depth = get_option('wpo_depth'); ?>
				<?php
					$code = file_get_contents(ABSPATH . 'wp-config.php');
					if(!isset($state)) $state = '1';
					else if($state == '1') $state = '0';
					else $state = '1';

					$action = __('Obfuscate', 'wpobfuscator');
					$msg = __('Warning : your wp-config.php file is in clear text, a hacker can easily read it ! Please, save your wp-config.php file before to obfuscate it !', 'wpobfuscator');
					$demo = __('That\'s your current clear text wp-config.php file :', 'wpobfuscator');
					$color = 'red';
					if($state == '0')
					{
						$action = __('Deobfuscate', 'wpobfuscator');
						$msg = __('Congrats ! Your wp-config.php file is obfuscated !', 'wpobfuscator');
						$color = 'blue';
						$demo = __('That\'s your new obfuscated wp-config.php file :', 'wpobfuscator');
					}
				?>
				<p><b style="color:<?php echo $color; ?>;"><?php echo $msg; ?></b></p>
				<div style="display:inline-block"><?php _e('Obfuscation depth :', 'wpobfuscator'); ?></div>
				<form style="display:inline-block" method="post" action="options.php">
				<?php settings_fields('wpo_settings'); ?>
				<input type="hidden" name="wpo_state" value="<?php if($state) echo 0; else echo 1; ?>">
				<select style="display:inline-block" name="wpo_depth">
					<option value="1" <?php if ( $wpo_depth == 1 ) echo 'selected="selected"'; ?>>1</option>
					<option value="2" <?php if ( $wpo_depth == 2 ) echo 'selected="selected"'; ?>>2</option>
					<option value="3" <?php if ( $wpo_depth == 3 ) echo 'selected="selected"'; ?>>3</option>
					<option value="4" <?php if ( $wpo_depth == 4 ) echo 'selected="selected"'; ?>>4</option>
					<option value="5" <?php if ( $wpo_depth == 5 ) echo 'selected="selected"'; ?>>5</option>
				</select>
				 <p style="display:inline-block" class="submit">
					<input style="display:inline-block" type="submit" class="button-primary" value="<?php _e('Save', 'wpobfuscator') ?>" />
				</p>
				</form>
				
				<form method="post" action="options.php">
				<?php settings_fields('wpo_settings'); ?>
				<input type="hidden" name="wpo_state" value="<?php echo $state; ?>">
				<input type="hidden" name="wpo_depth" value="<?php echo $wpo_depth; ?>">
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php echo $action; ?>" />
				</p>
			</form></div>
			<div>
			<p><b><?php echo $demo; ?></b></p>
			<?php wp_editor( $code, 'wpo_demo', array( 'wpautop' => false, 'media_buttons' => false, 'textarea_row' => 3 )); ?>
			</div>
		<?php
	}

	function wpo_register() 
	{
		register_setting( 'wpo_settings', 'wpo_depth',  array($this, 'wpo_cleandepth'));
		register_setting( 'wpo_settings', 'wpo_state',  array($this, 'wpo_clean'));
	  
	}
	function wpo_clean( $input ) 
	{
		if(!isset($_GET['deactivate']))
		{
			if( $input != "0" && $input != "1") $input = "0";
			$state = get_option('wpo_state');
			if($input != $state)
			{
				switch($input)
				{
					case "1": $this->wpo_obfusc();
					case "0": $this->wpo_deobfusc(false);
				}
			}
		}
		return $input;
	}
	function wpo_cleandepth( $input ) 
	{
		if(!is_numeric($input)) $input = 1;
		else if($input < 0 || $input > 5) $input = 1;
		return $input;
	}
	function wpo_admin_notice()
	{
			$msg = __('Warning : your wp-config.php file is in clear text, a hacker can easily read it !', 'wpobfuscator');
			echo '<div class="error"><p>' . $msg . '</p>';
			echo '<a class="button-primary" href="'. get_admin_url(null, 'admin.php?page=WP-Obfuscator') .'">' . __('Obfuscate your wp-config.php file now !', 'wpobfuscator') . '</a>';
			echo '</div>';
	}


	function wpo_action_links( $links ) 
	{
	   $links[] = '<a href="'. get_admin_url(null, 'admin.php?page=WP-Obfuscator') .'">' . __('Settings') . '</a>';
	   $links[] = '<a href="http://seraum.com" target="_blank">Seraum</a>';
	   $links[] = '<a href="http://hackmyfortress.com" target="_blank">Hackmyfortress</a>';
	   $links[] = '<a href="http://asylum.seraum.com" target="_blank">Asylum</a>';
	   return $links;
	}
}
$wpo3 = new wpobfuscator();
?>