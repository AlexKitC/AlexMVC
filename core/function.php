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
        if(isset($vals['outdateTime'])) {
            if($vals['outdateTime'] < time()) {
                delSession();
                return false;
            }else {
                return $vals;
            }
        }else {
            return $vals;
        }
        
    }
}

/**
 * 向浏览器输出验证码
 */
if(!function_exists('captcha')) {
    function captcha() {
        \Workerman\Protocols\Http::sessionStart();
        $image = imagecreatetruecolor(100, 30);    //1>设置验证码图片大小的函数
        //5>设置验证码颜色 imagecolorallocate(int im, int red, int green, int blue);
        $bgcolor = imagecolorallocate($image,255,255,255); //#ffffff
        //6>区域填充 int imagefill(int im, int x, int y, int col) (x,y) 所在的区域着色,col 表示欲涂上的颜色
        imagefill($image, 0, 0, $bgcolor);
        //10>设置变量
        $captcha_code = "";


        //7>生成随机数字
        for($i=0;$i<4;$i++){
        //设置字体大小
        $fontsize = 6;    
        //设置字体颜色，随机颜色
        $fontcolor = imagecolorallocate($image, rand(0,120),rand(0,120), rand(0,120));      //0-120深颜色
        //设置数字
        $fontcontent = rand(0,9);
        //10>.=连续定义变量
        $captcha_code .= $fontcontent;  
        //设置坐标
        $x = ($i*100/4)+rand(5,10);
        $y = rand(5,10);

        imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
        }
        //10>存到session
        $_SESSION['captcha'] = $captcha_code;
        //8>增加干扰元素，设置雪花点
        for($i=0;$i<200;$i++){
        //设置点的颜色，50-200颜色比数字浅，不干扰阅读
        $pointcolor = imagecolorallocate($image,rand(50,200), rand(50,200), rand(50,200));    
        //imagesetpixel — 画一个单一像素
        imagesetpixel($image, rand(1,99), rand(1,29), $pointcolor);
        }
        //9>增加干扰元素，设置横线
        for($i=0;$i<4;$i++){
        //设置线的颜色
        $linecolor = imagecolorallocate($image,rand(80,220), rand(80,220),rand(80,220));
        //设置线，两点一线
        imageline($image,rand(1,99), rand(1,29),rand(1,99), rand(1,29),$linecolor);
        }

        //2>设置头部，image/png
        \Workerman\Protocols\Http::headerRemove('Content-Type');
        \Workerman\Protocols\Http::header('Content-Type: image/png');
        //3>imagepng() 建立png图形函数
        imagepng($image);
        //4>imagedestroy() 结束图形函数 销毁$image
        imagedestroy($image);
    }
}

/**
 * 生成pathinfo url
 * @return string $url
 */
if(!function_exists('url')) {
    function url($url) {
        $urlArr = array_values(array_filter(explode("/",$url)));
        return 'http://'.$_SERVER['HTTP_HOST'].'/'.$urlArr[0].'/'.$urlArr[1].'/'.$urlArr[2];
    }
}

/**
 * 得到验证码执行pathinfo路径
 * @return string url
 */
if(!function_exists('captchaUrl')) {
    function captchaUrl() {
        return 'http://'.$_SERVER['HTTP_HOST'].'/'.$_SERVER['m'].'/'.$_SERVER['c'].'/captcha';
    }
}

/**
 * 输出验证码图片
 * @return html5 <img src='xx' onclick = 'xx' />
 */
if(!function_exists('getCaptcha')) {
    function getCaptcha() {
        echo "<img class='captcha' style='cursor:pointer;' src='".captchaUrl()."'"." onClick=".'"'."var src = this.src;if(src.indexOf('?') !== -1) {this.src = src.substr(0,src.indexOf('?'))+'?'+Math.random()} else {this.src = this.src + '?' +Math.random()}".'"'."; />";
    }
}

/**
 * 验证 验证码是否正确
 * @param $captcha 提交的验证码
 * @return bool
 */
if(!function_exists('checkCaptcha')) {
    function checkCaptcha($captcha) {
        $sessionCaptcha = getSession('captcha');
        if($sessionCaptcha == $captcha) {
            return true;
        }else {
            return false;
        }
    }
}

/**
 * 文件上传
 */
if(!function_exists('fileUpload')) {
    function fileUpload($fileName) {
        if(!empty($_FILES[0]['file_data'])) {
            $extArr = array_values(array_filter(explode(".",$_FILES[0]['file_name'])));
            $ext = $extArr[count($extArr)-1];
            if(!is_dir(APIROOT.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'uploads')) {
                mkdir(APIROOT.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'uploads');
            }
            if(!is_dir(APIROOT.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.date('Ymd',time()))) {
                mkdir(APIROOT.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.date('Ymd',time()));
            }
            file_put_contents(APIROOT.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.date('Ymd',time()).DIRECTORY_SEPARATOR.$fileName.'.'.$ext,$_FILES[0]['file_data']);
        }else {
            echo 'no files!';
        }
        
    }
}


