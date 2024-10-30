<?php   
        /* 
        Plugin Name: BuddyInsta
        Plugin URI: https://phpwords.wordpress.com/
        Description: Plugin for displaying Instagram Photos in your buddypress profile.
        Author: Yatendra 
        Version: 1.2
        Author URI: https://phpwords.wordpress.com/
        */  
?>
<?
require_once 'instagram.class.php';
add_action('init','savedata');
function savedata()
{
	

   $user_id = get_current_user_id();

$instagram = new Instagram(array(
  'apiKey'      => get_option('user_client_id'),
  'apiSecret'   => get_option('user_client_sc'),
  'apiCallback' => get_option('siteurl') // must point to success.php
));



// receive OAuth code parameter
 $code = $_GET['code'];

// check whether the user has granted access
if (isset($code) && $user_id>0) {


  // receive OAuth token object
  $data = $instagram->getOAuthToken($code);
	$data->access_token;
	$username = $username = $data->user->username;
  	update_user_meta($user_id, 'user_username', $username);
	update_user_meta($user_id, 'user_acc_token', $data->access_token);

  // store user access token
  $instagram->setAccessToken($data);





  // now you have access to all authenticated user methods
  //$result = $instagram->getUserMedia();

} else {

  // check whether an error occurred
  if (isset($_GET['error'])) {
    echo 'An error occurred: ' . $_GET['error_description'];
  }

}



		



}


function bi_insta_setup_nav() {
global $bp;


$profile_link = $bp->displayed_user->domain. $bp->profile->slug.'/';



bp_core_new_subnav_item( array( 'name' => __( 'Instagram Photos', 'buddypress' ), 'slug' => 'instagram-photos', 'parent_url' => $profile_link, 'parent_slug' => $bp->profile->slug, 'screen_function' => 'bi_instgram_feed_fun', 'position' => 1100, 'item_css_id' => 'friends-my-friends' ) );

 bp_core_new_subnav_item(
            array(
                'name' => __('Instagram', 'buddypress'),
                'slug' => 'buddyinstaset',
                'parent_url' => $bp->loggedin_user->domain . BP_SETTINGS_SLUG.'/',
                'parent_slug' => BP_SETTINGS_SLUG,
                'screen_function' => 'bi_default_user_settings',
                'position' => 10,
                'user_has_access' => bp_is_my_profile ()
                )
        );

}


add_action( 'bp_setup_nav', 'bi_insta_setup_nav', 11 );

	function bi_default_user_settings()
	{

		global $bp;

		add_action( 'bp_template_content', 'bp_setting_insta_screen_content' );

		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
	}

	function bi_instgram_feed_fun()
	{

		global $bp;

		add_action( 'bp_template_content', 'bp_page_screen_content' );

		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
	}
	function bp_setting_insta_screen_content()
	{
		global $bp;
		include('setinstagram.php');
	}
	function bp_page_screen_content(){
		global $bp;


		include('fetch.php');
	}



		function fetchData($url){
		     $ch = curl_init();
		     curl_setopt($ch, CURLOPT_URL, $url);
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		     $result = curl_exec($ch);
		     curl_close($ch); 
		     return $result;
		}

 

  function GetUserID($username, $access_token) {

    $urlnew = "https://api.instagram.com/v1/users/search?q=" . $username . "&access_token=" . $access_token;

    if($resultnew = json_decode(fetchData($urlnew), true)) {

        return $resultnew['data'][0]['id'];

    }

}


add_action('admin_menu', 'buddyinsta_admin_set');

function buddyinsta_admin_set() {
	add_options_page('BuddyInsta', 'BuddyInsta', 'manage_options', 'set_admin_settings.php', 'bi_admin_set_page');
	
}
function bi_admin_set_page()
{
		include 'set_admin_settings.php';
}
?>
