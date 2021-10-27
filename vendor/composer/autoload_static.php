<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3b817b3ab12e84deda939e49bdc7090e
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'minervis\\ToGo\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'minervis\\ToGo\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'ilToGoAccess' => __DIR__ . '/../..' . '/classes/class.ilToGoAccess.php',
        'ilToGoConfig' => __DIR__ . '/../..' . '/classes/class.ilToGoConfig.php',
        'ilToGoConfigGUI' => __DIR__ . '/../..' . '/classes/class.ilToGoConfigGUI.php',
        'ilToGoPlugin' => __DIR__ . '/../..' . '/classes/class.ilToGoPlugin.php',
        'ilToGoUIHookGUI' => __DIR__ . '/../..' . '/classes/class.ilToGoUIHookGUI.php',
        'minervis\\ToGo\\Access\\Access' => __DIR__ . '/../..' . '/src/Access/Access.php',
        'minervis\\ToGo\\Collection\\AnonymousSession' => __DIR__ . '/../..' . '/src/Collection/AnonymousSession.php',
        'minervis\\ToGo\\Collection\\Collection' => __DIR__ . '/../..' . '/src/Collection/Collection.php',
        'minervis\\ToGo\\Collection\\CollectionGUI' => __DIR__ . '/../..' . '/src/Collection/class.CollectionGUI.php',
        'minervis\\ToGo\\Collection\\Factory' => __DIR__ . '/../..' . '/src/Collection/Factory.php',
        'minervis\\ToGo\\Collection\\Filter' => __DIR__ . '/../..' . '/src/Collection/Filter.php',
        'minervis\\ToGo\\Collection\\Repository' => __DIR__ . '/../..' . '/src/Collection/Repository.php',
        'minervis\\ToGo\\Rating\\Factory' => __DIR__ . '/../..' . '/src/Rating/Factory.php',
        'minervis\\ToGo\\Rating\\Rating' => __DIR__ . '/../..' . '/src/Rating/Rating.php',
        'minervis\\ToGo\\Rating\\RatingGUI' => __DIR__ . '/../..' . '/src/Rating/class.RatingGUI.php',
        'minervis\\ToGo\\Rating\\Repository' => __DIR__ . '/../..' . '/src/Rating/Repository.php',
        'minervis\\ToGo\\Repository' => __DIR__ . '/../..' . '/src/Repository.php',
        'minervis\\ToGo\\Tile\\Factory' => __DIR__ . '/../..' . '/src/Tile/Factory.php',
        'minervis\\ToGo\\Tile\\Renderer\\AbstractCollection' => __DIR__ . '/../..' . '/src/Tile/Renderer/AbstractCollection.php',
        'minervis\\ToGo\\Tile\\Renderer\\AbstractCollectionGUI' => __DIR__ . '/../..' . '/src/Tile/Renderer/AbstractCollectionGUI.php',
        'minervis\\ToGo\\Tile\\Renderer\\AbstractSingleGUI' => __DIR__ . '/../..' . '/src/Tile/Renderer/AbstractSingleGUI.php',
        'minervis\\ToGo\\Tile\\Renderer\\CollectionGUIFactory' => __DIR__ . '/../..' . '/src/Tile/Renderer/CollectionGUIFactory.php',
        'minervis\\ToGo\\Tile\\Renderer\\CollectionGUIInterface' => __DIR__ . '/../..' . '/src/Tile/Renderer/CollectionGUIInterface.php',
        'minervis\\ToGo\\Tile\\Renderer\\CollectionInterface' => __DIR__ . '/../..' . '/src/Tile/Renderer/CollectionInterface.php',
        'minervis\\ToGo\\Tile\\Renderer\\Container\\ContainerCollection' => __DIR__ . '/../..' . '/src/Tile/Renderer/Container/ContainerCollection.php',
        'minervis\\ToGo\\Tile\\Renderer\\Container\\ContainerCollectionGUI' => __DIR__ . '/../..' . '/src/Tile/Renderer/Container/ContainerCollectionGUI.php',
        'minervis\\ToGo\\Tile\\Renderer\\Container\\ContainerSingleGUI' => __DIR__ . '/../..' . '/src/Tile/Renderer/Container/ContainerSingleGUI.php',
        'minervis\\ToGo\\Tile\\Renderer\\Desktop\\DesktopCollection' => __DIR__ . '/../..' . '/src/Tile/Renderer/Desktop/DesktopCollection.php',
        'minervis\\ToGo\\Tile\\Renderer\\Desktop\\DesktopCollectionGUI' => __DIR__ . '/../..' . '/src/Tile/Renderer/Desktop/DesktopCollectionGUI.php',
        'minervis\\ToGo\\Tile\\Renderer\\Desktop\\DesktopSingleGUI' => __DIR__ . '/../..' . '/src/Tile/Renderer/Desktop/DesktopSingleGUI.php',
        'minervis\\ToGo\\Tile\\Renderer\\Factory' => __DIR__ . '/../..' . '/src/Tile/Renderer/Factory.php',
        'minervis\\ToGo\\Tile\\Renderer\\Fixed\\FixedCollection' => __DIR__ . '/../..' . '/src/Tile/Renderer/Fixed/FixedCollection.php',
        'minervis\\ToGo\\Tile\\Renderer\\Fixed\\FixedCollectionGUI' => __DIR__ . '/../..' . '/src/Tile/Renderer/Fixed/FixedCollectionGUI.php',
        'minervis\\ToGo\\Tile\\Renderer\\Fixed\\FixedSingleGUI' => __DIR__ . '/../..' . '/src/Tile/Renderer/Fixed/FixedSingleGUI.php',
        'minervis\\ToGo\\Tile\\Renderer\\Repository' => __DIR__ . '/../..' . '/src/Tile/Renderer/Repository.php',
        'minervis\\ToGo\\Tile\\Renderer\\SingleGUIInterface' => __DIR__ . '/../..' . '/src/Tile/Renderer/SingleGUIInterface.php',
        'minervis\\ToGo\\Tile\\Repository' => __DIR__ . '/../..' . '/src/Tile/Repository.php',
        'minervis\\ToGo\\Tile\\Tile' => __DIR__ . '/../..' . '/src/Tile/Tile.php',
        'minervis\\ToGo\\Tile\\TileFormGUI' => __DIR__ . '/../..' . '/src/Tile/TileFormGUI.php',
        'minervis\\ToGo\\Tile\\TileGUI' => __DIR__ . '/../..' . '/src/Tile/class.TileGUI.php',
        'minervis\\ToGo\\Tile\\TileReference' => __DIR__ . '/../..' . '/src/Tile/TileReference.php',
        'minervis\\ToGo\\Utils\\Plugin' => __DIR__ . '/../..' . '/src/Utils/Plugin.php',
        'minervis\\ToGo\\Utils\\ToGoTrait' => __DIR__ . '/../..' . '/src/Utils/ToGoTrait.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3b817b3ab12e84deda939e49bdc7090e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3b817b3ab12e84deda939e49bdc7090e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3b817b3ab12e84deda939e49bdc7090e::$classMap;

        }, null, ClassLoader::class);
    }
}
