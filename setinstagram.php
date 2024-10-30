<?php

$user_id = bp_loggedin_user_id();

if($_REQUEST['resetconn']==1){ 
    delete_user_meta($user_id, 'user_username');
    delete_user_meta($user_id, 'user_acc_token');
}


global $bp;

$instagram = new Instagram(array(
  'apiKey'      => get_option('user_client_id'),
  'apiSecret'   => get_option('user_client_sc'),
  'apiCallback' => get_option('siteurl')
));


$loginUrl = $instagram->getLoginUrl();


?>


<?php 

$username=get_user_meta($user_id, 'user_username', true);
$accessToken = get_user_meta($user_id, 'user_acc_token', true);

if($username && $accessToken)
{

?>

<a style="text-decoration:none;" href="<?php echo $bp->loggedin_user->domain .BP_SETTINGS_SLUG.'/buddyinstaset/?resetconn=1';?>"><input type="button" name="reset_conn" Value="Reset Connection"></a>



<?php
}
elseif(get_option('user_client_id') && get_option('user_client_sc'))
{
?>

<a href="<?php echo $loginUrl;?>"><input type="button" name="buauth" Value="Sign In with Instagram"></a>



<?php } else { 

?>Plugin not configured yet.<?php
}
?>
