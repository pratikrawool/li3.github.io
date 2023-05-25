<?php


$apiKey       = 'YOUR_MAILCHIMP_API_HERE';
$listId       = 'LIST_ID_HERE';
$double_optin = true;
$send_welcome = true;
$email        = $_POST['email'];
$fname        = ''; 
$lname        = ''; 
$datacenter	  = explode( '-', $apiKey );
$post_url     = 'https://' . $datacenter[1] . '.api.mailchimp.com/2.0/lists/subscribe.json?';


$post_query_array = array(
    "apikey" => $apiKey,
    "id" => $listId,
    "email" => array(
        "email" => $email,
        "euid" => "",
        "leid" => ""
    ),
    "double_optin" => $double_optin,
    "send_welcome" => $send_welcome,
    "merge_vars" => array( 
        'FNAME' => $fname,
        'LNAME' => $lname
    )
);

$post_query_string = http_build_query($post_query_array);

if (!empty($email)) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $post_url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_query_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $curl_out = curl_exec($ch);
	$data = json_decode($curl_out);
	if ($data->error){
		echo $data->error;
	} else {
		echo 'success';
	}

} 
?>