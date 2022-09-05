<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit61dd6a6be26c0d9e832f0bac8250079f
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit61dd6a6be26c0d9e832f0bac8250079f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit61dd6a6be26c0d9e832f0bac8250079f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit61dd6a6be26c0d9e832f0bac8250079f::$classMap;

        }, null, ClassLoader::class);
    }
}
