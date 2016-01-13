<?php
function callAPI($link) {
	$ch = curl_init($link);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$v = curl_exec($ch);
	curl_close($ch);
	return $v;
}
Route::get('/fb', function () {
	// $token = callAPI('https://graph.facebook.com/oauth/access_token?client_id=972492646144125&client_secret=7d2f6140e9766d924c1721c7ac1be01f&grant_type=client_credentials');
	$pages = array('ncell', 'memeNEPALofficial', 'TrollCric8');
	$token = '972492646144125|-Sp32_5WglLEiG-Ha4eZTmB3kvg'; substr(strchr($token, "="), 1);
	$allposts = [];
	$onlyposts = [];
	foreach ($pages as $key => $pageName) {
		$tmp = callAPI('https://graph.facebook.com/v2.5/' . $pageName . '/posts?limit=5&fields=picture%2Cchild_attachments%2Ccaption%2Ccreated_time%2Cdescription%2Cmessage&access_token=' . $token);
		$tmp = json_decode($tmp, true);
		array_push($allposts, $tmp);
		foreach ($tmp as $key => $value) {
			foreach ($value as $key => $value) {
				if (is_array($value)) {
					$value['pagename'] = $pageName;
					array_push($onlyposts, $value);
				}
			}
		}
	}
	shuffle($onlyposts);
	foreach ($onlyposts as $key => $value) {
		echo 'Page Name: ' . $value['pagename'] . '<br/>';
		echo 'Title: ' . $value['message'] . '<br/>';
		if (array_key_exists('picture', $value)) {
			echo 'Attachment: <img src="' . $value['picture'] . '" width="200px" height="200px"/><br/>';
		}
		echo '<hr/>';
		// echo 'created_at' . $value['created_at'];
	}
	return '';
});