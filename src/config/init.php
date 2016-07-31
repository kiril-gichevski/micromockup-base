<?php
namespace Config;
    
use Db\Connection;

class Init {

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * Init constructor.
     */
    public function __construct()
    {
        $this->connection = Connection::getConnection(
            Config::DB_HOST,
            Config::DB_NAME,
            Config::DB_USERNAME,
            Config::DB_PASSWORD
        );
    }
    
    protected function render($file, $title, $vars)
    {
        require_once('src/views/head.html');
        require_once ('src/views/page/'.$file.'.phtml');
        require_once('src/views/foot.html');
    }
}
