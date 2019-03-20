<?php

/**
 * 友好的dump
 */
if(!function_exists("dump")){
    function dump($data){
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}

/**
 * 执行页面跳转
 * @param $conn 控制器中方法调用跳转函数时，需在该方法中传入$connection参数
 * @param $pathinfo 模块/控制器/方法
 */
if(!function_exists("location")){
    function location($conn,$pathinfo){
        \Workerman\Protocols\Http::header("location:".(substr($pathinfo,0,1) == "/" ? $pathinfo : "/".$pathinfo));
        return $conn->send('success');
    }
}

/**
 * 删除session
 */
if(!function_exists("delSession")){
    function delSession(){
        if(file_exists(\Workerman\Protocols\HttpCache::$sessionPath.DIRECTORY_SEPARATOR."alex_".$_COOKIE[\Workerman\Protocols\HttpCache::$sessionName])) {
            try {
                unlink(\Workerman\Protocols\HttpCache::$sessionPath.DIRECTORY_SEPARATOR."alex_".$_COOKIE[\Workerman\Protocols\HttpCache::$sessionName]);
                if(file_exists(\Workerman\Protocols\HttpCache::$sessionPath.DIRECTORY_SEPARATOR."alex_".$_COOKIE[\Workerman\Protocols\HttpCache::$sessionName])) {
                    return false;
                }else {
                    return true;
                }
            } catch(\Exception $e){
                dump($e -> getMessage());
            }

        }
    }
}

/**
 * 存入session
 * @param $key
 * @param $vals
 * @param $holdTime 有效时长，默认7200s
 */
if(!function_exists("setSession")){
    function setSession($key,$vals,$holdTime=7200){
        \Workerman\Protocols\Http::sessionStart();
        $vals['outdateTime'] = time() + $holdTime;
        $_SESSION[$key] = $vals;
        if(!empty($_SESSION[$key])) {
            return true;
        }else {
            return false;
        }
    }
}

/**
 * 获取session
 */
if(!function_exists('getSession')) {
    function getSession($key) {
        \Workerman\Protocols\Http::sessionStart();
        $vals = $_SESSION[$key];
        if($vals['outdateTime'] < time()) {
            delSession();
            return false;
        }else {
            return $vals;
        }
    }
}


