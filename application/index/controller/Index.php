<?php
namespace application\controller;
class Index{

    //默认执行的方法，此处实例化了视图类，并传入了模块控制器，和 需要传入模板的变量数组
    public function index(){
        return new \application\View("index/Index/index",[
            'fname'   =>   'AlexMVC',
            'author'  =>   'Alex-黑白',
            'qq'      =>   '392999164',
            'version' =>   '1.0.0',
            'content' =>   'just free yourself :)'
         ]);
    }

    //如果需要使用跳转，则需要传入$connection参数，然后调用location方法,并传入 模块/控制器/方法
    public function testLocation($connection) {
        location($connection,"index/Home/index");
    }

    //如果需要使用db，可以自行写model类，实例化然后调用模型方法，也可以直接写在控制器中,引入全局的$db,然后进行curd，例如
    public function testDb() {
        global $db;
        $users = $db->query('select * from bdj_article limit 400,30');
        echo json_encode($users);
    }

    public function testSession() {
        \Workerman\Protocols\Http::sessionStart();
        //delSession();
        $_SESSION['userinfo'] = ['username'=>'lilin','uid'=>1];
    }

    public function del() {
        $res = delSession();
    }

    public function testPost() {
        dump($_POST);
    }

    public function testUploadFile() {
        dump(strlen($_POST));
        dump($_FILES);
    }
}