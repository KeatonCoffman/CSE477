<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite4ef743c48a56838c451c4f7d141f09f
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Felis\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Felis\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/Felis',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite4ef743c48a56838c451c4f7d141f09f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite4ef743c48a56838c451c4f7d141f09f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
