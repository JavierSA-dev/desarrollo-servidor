<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9d75771207ad1a32aacb0d000f713e60
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9d75771207ad1a32aacb0d000f713e60::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9d75771207ad1a32aacb0d000f713e60::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9d75771207ad1a32aacb0d000f713e60::$classMap;

        }, null, ClassLoader::class);
    }
}
