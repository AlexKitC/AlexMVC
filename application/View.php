<?php
namespace application;

class View {

    private $config = [
        'view_path'	    =>	APIROOT.'./application/',
        'cache_path'	=>	APIROOT.'./runtime/',
        'view_suffix'   =>	'.html',
    ];

    public function __construct(string $pathinfo,array $data) {
        $template = new \think\Template($this -> config);
        $template->assign("dirRoot",APIROOT);
        foreach($data as $k => $v) {
            $template->assign($k,$v);
        }
        $template->fetch($this -> realView($pathinfo));
    }

    /**
     * 得到模板真实路径
     */
    private function realView($pathinfo) {
        if($pathinfo){
            $path = array_values(array_filter(explode("/",$pathinfo)));
            if(count($path) == 1){
                try{
                    if(file_exists(APIROOT."/application/".$path[0]."/view/".APP_CONTROLLER."/".APP_ACTION.$this -> config['view_suffix'])){
                        include APIROOT."/application/".$path[0]."/view/".APP_CONTROLLER."/".APP_ACTION.$this -> config['view_suffix'];
                    }else{
                        echo("template ".APIROOT."/application/".$path[0]."/view/".APP_CONTROLLER."/".APP_ACTION.".html not exist!");
                    }
                    
                }catch(\Exception $e){
                    dump($e);
                }
            }elseif(count($path) == 2){
                try{
                    if(file_exists(APIROOT."/application/".$path[0]."/view/".$path[1]."/".APP_ACTION.$this -> config['view_suffix'])){
                        include APIROOT."/application/".$path[0]."/view/".$path[1]."/".APP_ACTION.$this -> config['view_suffix'];
                    }else{
                        echo("template ".APIROOT."/application/".$path[0]."/view/".$path[1]."/".APP_ACTION.".html not exist!"); 
                    }    
                }catch(\Exception $e){
                    dump($e);
                }    
            }elseif(count($path) == 3){
                try{
                    if(file_exists(APIROOT."/application/".$path[0]."/view/".$path[1]."/".$path[2].$this -> config['view_suffix'])){
                        return APIROOT."/application/".$path[0]."/view/".$path[1]."/".$path[2].$this -> config['view_suffix'];
                    }else{
                        echo("template ".APIROOT."/application/".$path[0]."/view/".$path[1]."/".$path[2].".html not exist!"); 
                    }       
                }catch(\Exception $e){
                    dump($e);
                }
            }elseif(count($path) > 3){
                echo("Error!class View() needs params like View('/moudle/controller/action')"); 
            }
        }else{
            echo("class View() params error!you should use <pre>new \View\View('index/Index/yourpage')</pre>");
        }
    }
    

}