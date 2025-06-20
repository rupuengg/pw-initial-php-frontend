<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita595d72f7f24e4334ddc975cc57b7cca
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rupuengg\\Initial\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rupuengg\\Initial\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita595d72f7f24e4334ddc975cc57b7cca::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita595d72f7f24e4334ddc975cc57b7cca::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita595d72f7f24e4334ddc975cc57b7cca::$classMap;

        }, null, ClassLoader::class);
    }
}
