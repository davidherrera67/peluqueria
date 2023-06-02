<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit346ec73872c53b680cbc8b2b90ecab4f
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit346ec73872c53b680cbc8b2b90ecab4f', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit346ec73872c53b680cbc8b2b90ecab4f', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit346ec73872c53b680cbc8b2b90ecab4f::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
