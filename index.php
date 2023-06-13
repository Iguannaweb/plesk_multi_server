<?php
# Basic includes
require_once('./igw-includes/config/config.php'); 
require_once('./igw-includes/functions/functions.php'); 
require_once('./igw-includes/functions/PleskApiClient.php'); 
include './vendor/plesk/api-php-lib/src/Api/Client.php';
include './vendor/plesk/api-php-lib/src/Api/AbstractStruct.php';
include './vendor/plesk/api-php-lib/src/Api/InternalClient.php';
include './vendor/autoload.php'; 

# Variables
$serv = isset($_GET['serv']) ? $_GET['serv'] : null;
$go = isset($_GET['go']) ? $_GET['go'] : null;

# Header
include './igw-templates/header.php';
include './igw-templates/top.php'; 

# Body
include './igw-templates/sidebar.php';
include './igw-includes/actions/dashboard.php'; 

include './igw-templates/sidebar-second.php'; 

# Footer
include './igw-templates/footer.php';