<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/deleteHcData.php';

use \hcdata\hcdata;
use \deletedata\deletedata;

$dd = new deletedata;

$delHcData = $dd ->hc_delete($_POST['delete_hcdata']);
?>