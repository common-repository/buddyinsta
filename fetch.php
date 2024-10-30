<?php 
				
$user_id = bp_displayed_user_id();

$username=get_user_meta($user_id, 'user_username', true);

		
$accessToken = get_user_meta($user_id, 'user_acc_token', true);
if($username && $accessToken)
{
                  
 

		

		 $userid = GetUserID($username, $accessToken);

		

		
		$result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
		$result = json_decode($result); 
	

	?>

<div class="instagram-panel">
<?php
	if(count($result->data)=="0")
	{
	?><div id="message" class="info"><p>Sorry, you have not photos.</p></div><?

	}
	else
	{


	    foreach ($result->data as $post): ?>
			<!-- Renders images. @Options (thumbnail,low_resoulution, high_resolution) -->
			<a class="group" rel="group1" href="<?= $post->images->standard_resolution->url ?>"><img src="<?= $post->images->thumbnail->url ?>"></a>
		<?php endforeach ?>
	    </div>

	<?
	}
}
else
{
?><div id="message" class="info"><p>Sorry,You have not authenticate yet.Please authenticate with instagram.</p></div><?
}?>
