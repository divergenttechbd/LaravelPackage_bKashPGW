<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd7f27d732c938c1f450283535cb78f28
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Divergent\\Bkash\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Divergent\\Bkash\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitd7f27d732c938c1f450283535cb78f28::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd7f27d732c938c1f450283535cb78f28::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd7f27d732c938c1f450283535cb78f28::$classMap;

        }, null, ClassLoader::class);
    }
}