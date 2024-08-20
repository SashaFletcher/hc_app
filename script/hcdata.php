<?php 
$headers = apache_request_headers();

require $_SERVER['DOCUMENT_ROOT'] . '/core/config.php';

 /*if(!isset($headers['Csrftoken'])) {

   
        Throw a 401 Unauthorised error if the CSRF Tokens do not match
    
    header("HTTP/1.1 401 Unauthorized");
    exit;

}*/

 /*if($headers['Csrftoken'] != $_SESSION['csrf_token']) {

   
        Throw a 401 Unauthorised error if the CSRF Tokens do not match
   
    header("HTTP/1.1 401 Unauthorized");
    exit;

} */
        
$str = 'ad_messages' . $_SESSION['csrf_token'] . "gHjHGhJhGyJnMjYHU";
$sha512 = hash("sha512", $str);

use \hcdata\hcdata;
$hcdata = new hcdata;

$response = array();
$i = 1;

foreach($hcdata->list() as $hcdata) {
    $response[$i]['id'] = $hcdata->id;
    $response[$i]['first_name'] = $hcdata->first_name;
    $response[$i]['last_name'] = $hcdata->last_name;
    $response[$i]['email'] = $hcdata->email;
    $response[$i]['phone_number'] = $hcdata->phone_number;
    $response[$i]['nhs_no'] = $hcdata->nhs_no;
    $response[$i]['address'] = $hcdata->address;
    $response[$i]['dob'] = $hcdata->dob;
    $response[$i]['gender'] = $hcdata->gender;
    $i++;
}

echo json_encode($response);
die();

?>