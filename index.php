<?php
use \Workerman\Worker;
use \Workerman\WebServer;
const APIROOT = __DIR__;
const APP_CONTROLLER = 'Index';
const APP_ACTION = "index";
include __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/config/globalConfig.php';
include __DIR__ . '/core/function.php';

class httpServer{
    private $httpServer;
    public function __construct(){
        global $globalConfig;
        $this -> httpServer = new WebServer('http://0.0.0.0:'.$globalConfig['httpport']);
        $this -> httpServer -> addRoot('alex.91mylover.top','/var/www/php/AlexMVC');
        $this -> httpServer -> count = 1;
        $this -> httpServer -> onWorkerStart = function($worker) {//初始化全局mysql连接
            global $db;
            global $globalConfig;
            try{
                $db = new \Workerman\MySQL\Connection($globalConfig['sqlhost'], $globalConfig['sqlport'], $globalConfig['sqluser'], $globalConfig['password'], $globalConfig['database']);
            } catch(\Exception $e) {
                echo $e -> getMessage();
                die;
            }
        };
        
    }
}
new httpServer();
Worker::runAll();
