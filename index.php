<?php
define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

use cotcotfarm\controller\AccueilController;

require_once __DIR__ . '/vendor/autoload.php';

new AccueilController();
