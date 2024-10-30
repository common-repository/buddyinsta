<div class="wrap">
<h2>BuddyInsta Settings</h2>

<?php

if(isset($_REQUEST['insta_admin_submit']))
{
	$incl_id=$_REQUEST['insta_client_id'];
	$incl_sc=$_REQUEST['insta_client_sc'];

	update_option('user_client_id', $incl_id);
	update_option('user_client_sc', $incl_sc);

		echo '<div id="setting-error-settings_updated" class="updated settings-error"> 
<p><strong>Settings saved.</strong></p></div>';
}
?>



<div></div>

<form name="fins" id="fins" action="" method="POST">
<table border="0">
	<thead>
		<tr>
		  <th><h3>Instagram Settings</h3></th>
		  <th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>

		<tr>
		   <td>Client ID:</td>
		   <td><input type="text" name="insta_client_id" id="insta_client_id" value="<?php echo get_option('user_client_id');?>"></td>
		</tr>
		<tr>
		  <td>Client Secret:</td>
		  <td><input type="text" name="insta_client_sc" id="insta_client_sc" value="<?php echo get_option('user_client_sc');?>"></td>
		</tr>
		<tr><td></td><td><input type="submit" name="insta_admin_submit" Value="Submit" class="button button-primary"></td></tr>





	</tbody>
</table>
</form>



<div style="padding-top:50px;"><table border="0">
	<thead>
		<tr><td>&nbsp;</td>
		  <td><strong>How to get instagram client id and client secret:</strong></td>
		  
		</tr>
	</thead>
	<tbody>

		<tr><td>1.</td>
		   <td>Go at http://instagram.com/developer/ or <a href="http://instagram.com/developer/" target="_blank">click here</a></td>
		</tr>
		<tr><td>2.</td>
		   <td>click on "Register Your Application" button and follow step by step process.</td>
		</tr>

	</tbody>
</table>

</div>
