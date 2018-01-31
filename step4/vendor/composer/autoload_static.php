<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticIniteb084acb47ca0b39c7d3705c98805392
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Wumpus\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Wumpus\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/Wumpus',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticIniteb084acb47ca0b39c7d3705c98805392::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticIniteb084acb47ca0b39c7d3705c98805392::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}