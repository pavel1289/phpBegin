<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7bf193f426a94e6228c15428cdbee283
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Classes\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/classes',
        ),
    );

    public static $classMap = array (
        'Classes\\Book' => __DIR__ . '/../..' . '/src/classes/Book.php',
        'Classes\\Controller' => __DIR__ . '/../..' . '/src/classes/Controller.php',
        'Classes\\DVD' => __DIR__ . '/../..' . '/src/classes/DVD.php',
        'Classes\\Database' => __DIR__ . '/../..' . '/src/classes/Database.php',
        'Classes\\Furniture' => __DIR__ . '/../..' . '/src/classes/Furniture.php',
        'Classes\\Product' => __DIR__ . '/../..' . '/src/classes/Product.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7bf193f426a94e6228c15428cdbee283::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7bf193f426a94e6228c15428cdbee283::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7bf193f426a94e6228c15428cdbee283::$classMap;

        }, null, ClassLoader::class);
    }
}
