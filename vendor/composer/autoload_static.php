<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit717e420b9c36eb4aeea6998d4f8b081f
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'think\\' => 6,
        ),
        'W' => 
        array (
            'Workerman\\MySQL\\' => 16,
            'Workerman\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'think\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-template/src',
        ),
        'Workerman\\MySQL\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/mysql/src',
        ),
        'Workerman\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/workerman',
        ),
    );

    public static $classMap = array (
        'ComposerAutoloaderInit717e420b9c36eb4aeea6998d4f8b081f' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit717e420b9c36eb4aeea6998d4f8b081f' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Error' => __DIR__ . '/..' . '/workerman/workerman/Lib/Constants.php',
        'Workerman\\Autoloader' => __DIR__ . '/..' . '/workerman/workerman/Autoloader.php',
        'Workerman\\Connection\\AsyncTcpConnection' => __DIR__ . '/..' . '/workerman/workerman/Connection/AsyncTcpConnection.php',
        'Workerman\\Connection\\AsyncUdpConnection' => __DIR__ . '/..' . '/workerman/workerman/Connection/AsyncUdpConnection.php',
        'Workerman\\Connection\\ConnectionInterface' => __DIR__ . '/..' . '/workerman/workerman/Connection/ConnectionInterface.php',
        'Workerman\\Connection\\TcpConnection' => __DIR__ . '/..' . '/workerman/workerman/Connection/TcpConnection.php',
        'Workerman\\Connection\\UdpConnection' => __DIR__ . '/..' . '/workerman/workerman/Connection/UdpConnection.php',
        'Workerman\\Events\\Ev' => __DIR__ . '/..' . '/workerman/workerman/Events/Ev.php',
        'Workerman\\Events\\Event' => __DIR__ . '/..' . '/workerman/workerman/Events/Event.php',
        'Workerman\\Events\\EventInterface' => __DIR__ . '/..' . '/workerman/workerman/Events/EventInterface.php',
        'Workerman\\Events\\Libevent' => __DIR__ . '/..' . '/workerman/workerman/Events/Libevent.php',
        'Workerman\\Events\\React\\Base' => __DIR__ . '/..' . '/workerman/workerman/Events/React/Base.php',
        'Workerman\\Events\\React\\ExtEventLoop' => __DIR__ . '/..' . '/workerman/workerman/Events/React/ExtEventLoop.php',
        'Workerman\\Events\\React\\ExtLibEventLoop' => __DIR__ . '/..' . '/workerman/workerman/Events/React/ExtLibEventLoop.php',
        'Workerman\\Events\\React\\StreamSelectLoop' => __DIR__ . '/..' . '/workerman/workerman/Events/React/StreamSelectLoop.php',
        'Workerman\\Events\\Select' => __DIR__ . '/..' . '/workerman/workerman/Events/Select.php',
        'Workerman\\Events\\Swoole' => __DIR__ . '/..' . '/workerman/workerman/Events/Swoole.php',
        'Workerman\\Lib\\Timer' => __DIR__ . '/..' . '/workerman/workerman/Lib/Timer.php',
        'Workerman\\MySQL\\Connection' => __DIR__ . '/..' . '/workerman/mysql/src/Connection.php',
        'Workerman\\Protocols\\Frame' => __DIR__ . '/..' . '/workerman/workerman/Protocols/Frame.php',
        'Workerman\\Protocols\\Http' => __DIR__ . '/..' . '/workerman/workerman/Protocols/Http.php',
        'Workerman\\Protocols\\HttpCache' => __DIR__ . '/..' . '/workerman/workerman/Protocols/Http.php',
        'Workerman\\Protocols\\ProtocolInterface' => __DIR__ . '/..' . '/workerman/workerman/Protocols/ProtocolInterface.php',
        'Workerman\\Protocols\\Text' => __DIR__ . '/..' . '/workerman/workerman/Protocols/Text.php',
        'Workerman\\Protocols\\Websocket' => __DIR__ . '/..' . '/workerman/workerman/Protocols/Websocket.php',
        'Workerman\\Protocols\\Ws' => __DIR__ . '/..' . '/workerman/workerman/Protocols/Ws.php',
        'Workerman\\WebServer' => __DIR__ . '/..' . '/workerman/workerman/WebServer.php',
        'Workerman\\Worker' => __DIR__ . '/..' . '/workerman/workerman/Worker.php',
        'application\\View' => __DIR__ . '/../..' . '/application/View.php',
        'application\\controller\\Home' => __DIR__ . '/../..' . '/application/index/controller/Home.php',
        'application\\controller\\Index' => __DIR__ . '/../..' . '/application/index/controller/Index.php',
        'think\\Template' => __DIR__ . '/..' . '/topthink/think-template/src/Template.php',
        'think\\template\\TagLib' => __DIR__ . '/..' . '/topthink/think-template/src/template/TagLib.php',
        'think\\template\\driver\\File' => __DIR__ . '/..' . '/topthink/think-template/src/template/driver/File.php',
        'think\\template\\exception\\TemplateNotFoundException' => __DIR__ . '/..' . '/topthink/think-template/src/template/exception/TemplateNotFoundException.php',
        'think\\template\\taglib\\Cx' => __DIR__ . '/..' . '/topthink/think-template/src/template/taglib/Cx.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit717e420b9c36eb4aeea6998d4f8b081f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit717e420b9c36eb4aeea6998d4f8b081f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit717e420b9c36eb4aeea6998d4f8b081f::$classMap;

        }, null, ClassLoader::class);
    }
}