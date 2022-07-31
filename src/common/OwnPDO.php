<?php

namespace cotcotfarm\common;
use PDO;
use Exception;

class OwnPDO extends PDO
{
    public function __construct($file = 'setting.ini')
    {
        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
       
        $dns = $settings['database']['driver'] .
        ':host=' . $settings['database']['host'] .
        ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
        ';dbname=' . $settings['database']['schema'];
       
        parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
    }

    public function isConnected()
    {
        return $this->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    }

    public function connect()
    {
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function disconnect()
    {
        $this->close();
    }
}
?>