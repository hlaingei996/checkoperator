<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit162a18d94a386eec2087ffe9f141026f
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'BaganIT\\Checkoperator\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'BaganIT\\Checkoperator\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit162a18d94a386eec2087ffe9f141026f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit162a18d94a386eec2087ffe9f141026f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
