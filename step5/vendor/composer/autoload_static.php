<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2b110c226ecf6e969e6131a24d0a904a
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Guessing\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Guessing\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/Guessing',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2b110c226ecf6e969e6131a24d0a904a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2b110c226ecf6e969e6131a24d0a904a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
