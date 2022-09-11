<?php

namespace cotcotfarm\common;

use PDO;
use Exception;

class OwnPDO extends PDO
{
    
    public function __construct($base, $file = './config/config.ini')
    {

        if (!$settings = parse_ini_file($file, TRUE)) 
        {
            throw new exception('Unable to open ' . $file . '.');
        }
        if (!isset($settings[$base])) 
        {
            throw new Exception("Section '" . $base . "' not found in '" . $file . "'.'");
        }
        else{
            $dns = $settings[$base]['driver'] .
            ':host=' . $settings[$base]['host'] .
            ((!empty($settings[$base]['port'])) ? (';port=' . $settings[$base]['port']) : '') .
            ';dbname=' . $settings[$base]['shema'];
       
            parent::__construct($dns, $settings[$base]['username'], $settings[$base]['password']);
        }
    }

    public function isConnected()
    {
        return $this->query('SELECT 1 ') ? true: false;
    }
    
    public function connect()
    {
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    
}
?>