<?php
# Basic includes
require_once('./igw-includes/config/config.php'); 
require_once('./igw-includes/functions/functions.php'); 
require_once('./igw-includes/functions/PleskApiClient.php'); 
include './vendor/plesk/api-php-lib/src/Api/Client.php';
include './vendor/plesk/api-php-lib/src/Api/AbstractStruct.php';
include './vendor/plesk/api-php-lib/src/Api/InternalClient.php';
include './vendor/autoload.php'; 
$serv = isset($_GET['serv']) ? $_GET['serv'] : null;
	
# Server info (ALL file and individual)
igw_plesk_server_info($datos,"server",$serv);

# Domains info (ALL file and individual)
igw_plesk_server_info($datos,"domains",$serv);

# Clients info (ALL file and individual)
igw_plesk_server_info($datos,"clients",$serv);

# Services status
service_status($datos,'status','',$serv);
	