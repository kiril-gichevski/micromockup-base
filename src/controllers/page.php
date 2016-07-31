<?php
namespace Controllers;

use Config\Init;
use Db\models\Page as PageModel;

class Page extends Init{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new PageModel($this->connection);
    }
    
    public function index()
    {
        $this->render('page', 'page', ['page'=>'First page']);
    }
}
