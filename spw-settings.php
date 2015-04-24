<?php
function spw_prx($key) {
	global $settings, $shortname;
	return $settings[$shortname . '_' . $key];
}

$pluginname = "Sup Posts Widget";
$shortname = "SPW";

$spwsettings = array();
$spwoptions = array (
	/** BEGIN General Form Settings **/
	array(
		"name"=>"General Form Settings",
		"id"=>$shortname."_general_settings",
		"type"=>"open",
		),

	array("type"=>"close"),
	/** END General Settings **/

 
);

function spw_admin_menu() {
    global $pluginname, $shortname, $spwoptions;
    if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($spwoptions as $value) if ($value['type']!='header') update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			foreach ($spwoptions as $value) {
			if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
			header("Location: ?page=spw-settings.php&saved=true");
			die;
		} else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($spwoptions as $value) delete_option( $value['id'] );
			header("Location: ?page=spw-settings.php&reset=true");
			die;
		}
    }
	add_options_page($pluginname." Settings", "Sup Posts Widgets", 'edit_plugins', basename(__FILE__), 'spw_admin');
}

function spw_admin() {

    global $pluginname, $shortname, $spwoptions;

    if ($_REQUEST['saved']) echo '<div id="message" class="updated fade"><p><strong>'.$pluginname.' settings saved.</strong></p></div>';
    if ($_REQUEST['reset']) echo '<div id="message" class="updated fade"><p><strong>'.$pluginname.' settings reset.</strong></p></div>';
    ?>
	<?php echo '<link rel="stylesheet" type="text/css" href="'. plugins_url( 'style.css' , __FILE__ ) . '" />'; ?>
	
	<form method="post">
	<!-- BEGIN wrapper -->
	<div id="to_wrapper"> 
	<div class="spw-admin-head">
		<div id="icon-options-general" class="icon32"><br></div>
		<h2><?php echo $pluginname; ?></h2>
	</div>
	<!-- BEGIN content -->
	<div id="spw-content">
	
		<?php foreach ($spwoptions as $value) { 
			if ($value['type']=="open") { 
				$first = true;
				?>
		<div class="postbox">
 		<h3><?php echo $value['name']; ?></h3>
	   	<div class="inside">
 		<strong>This Options will be available in the next versions of this plugin. thanks</stong>
		<div style="clear:both"></div>	
 		</div> <!-- End inside -->
	</div> <!-- End postbox -->				 
			<?php }
		}
		?>
	</div>
	<!-- END content -->
		<!-- Begin Sidebar -->
	<div class="spw-sidebar">

		<div class="spw-widget">
		<h2>How to</h2>
		<p>
			<br/>
		
			<br/>
			<b><a href="http://uspdev.net/projects/sup-post-widget-wordpress-plugin/">Please visit this page for instructions</a></b>
		</p>
		</div>

		<div class="spw-widget">
		<h2>About</h2>
		<p> Is a plugin where you can display the number of popular posts, latest and random post with thumbnail image on your sidebar or page/post. 
			spw: SUP Posts Widgets form created by UspDev / <a href="http://uspdev.net/">Blogging Tips for Blogger</a><br/><br/>
			If you like this plugin and find it useful, help keep this plugin free and actively developed by clicking the donate button or send me a gift from my Amazon wishlist. Also, don't forget to follow me on Twitter.
			<br/><br/>
			<b>Please Donate to help us continue this Plugin.</b><br/><br/>	
			<center>
			<a href="http://uspdev.net/donate-to-uspdev/" target="_blank"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG_global.gif"/></a>
			</center>
			<br/><br/>
		 	<a href="http://uspdev.net/donate-to-uspdev/" target="_blank">Donate Page</a> | 
		 	<a href="http://www.amazon.com/gp/registry/wishlist/16HXF07JWPO9E/ref=cm_wl_rlist_go_o" target="_blank">Send Amazon Gift</a> | 
		 	<a href="http://uspdev.net/projects/sup-post-widget-wordpress-plugin/" target="_blank" title="spw : Sup Posts Widgets Plugin">Support Page</a>
			<br/><br/>
			My other Plugin : <a href="uspdev.net/projects/wpscf-contact-form-wordpress-plugins/" target="_blank">Contact Form with File Attachment</a>
			<br/><br/>	
 
		<br/>
		Sponsored by : <a href="https://iwebpoints.com/" title="Free Web Hosting" target="_blank">Free Web Hosting</a> | <a href="http://indojavatours.com/" target="_blank" title="Bromo Tour">Bromo Tour</a>
		</p>
		</div>
	</div>
	<!-- END Sidebar -->
	<div id="spw-footer" style="clear:both">
		<p>
		<input  class="button-primary" name="save" type="submit" value="Save changes" />    
		<input type="hidden" name="action" value="save" />
		</p>
	</div>
	
	 </div>
	<!-- END wrapper -->
	
	</form>

<?php
}

add_action('admin_menu', 'spw_admin_menu');

foreach ($spwoptions as $value)
	if (get_settings($value['id'])===FALSE)
		$spwsettings[$value['id']]=stripslashes($value['std']); 
	else 
		$spwsettings[$value['id']]=stripslashes(get_settings($value['id']));
	
?>