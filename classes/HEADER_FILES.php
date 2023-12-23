<?php
require_once('config/initDBConnection.php');
require_once('accounts/user/UserAccountPull.class.php');
require_once('errors/errors.class.php');
require_once('sanitize/sanitize.class.php');
require_once('graphs/graphSimulator.class.php');

use DBTemplates\DBConnectionTemplate;
use AccountsManager\UserAccountPull;
use ErrorManager\AdministratorErros;
use ErrorManager\AdvertiserErros;
use SanitizeManager\NameSanitizer;
use SanitizeManager\PasswordSanitize;
use SanitizeManager\RecognizeNumberEmailSanitize;
use SanitizeManager\DescriptionSanitize;
use SanitizeManager\MonieSanitize;
use SanitizeManager\GeocoordSanitize;
use UtilityManager\UtilityPull;
use GraphSimulationManager\GraphSimulator;

$DBConnectionTemplates = new DBConnectionTemplate();
$UserAccountPull = new UserAccountPull();
$UserErrorsPool = new AdvertiserErros();
$AdminiErrorsPool = new AdministratorErros();
$NameSanitizer = new NameSanitizer();
$PasswordSanitize = new PasswordSanitize();
$RecognizeNumberEmailSanitize = new RecognizeNumberEmailSanitize();
$DescriptionSanitize = new DescriptionSanitize();
$MonieSanitize = new MonieSanitize();
$GeocoordSanitize = new GeocoordSanitize();
$Utility = new UtilityPull();
$GraphSimulator = new GraphSimulator();
?>
