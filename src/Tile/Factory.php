<?php

namespace minervis\ToGo\Tile;

use ilToGoPlugin;
//use srag\DIC\ToGo\DICTrait;
use minervis\ToGo\Utils\ToGoTrait;

/**
 * Class Factory
 *
 * @package minervis\ToGo\Tile
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Factory
{
    //use DICTrait;
    use ToGoTrait;
    const PLUGIN_CLASS_NAME = ilToGoPlugin::class;
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * Factory constructor
     */
    private function __construct()
    {
    }


    /**
     * @return Tile
     */
    public function newInstance() : Tile
    {
        $tile = new Tile();

        return $tile;
    }


    /**
     * @param TileGUI $parent
     * @param Tile                       $tile
     *
     * @return TileFormGUI
     */
    public function newFormInstance(TileGUI $parent, Tile $tile) : TileFormGUI
    {
        $form = new TileFormGUI($parent, $tile);

        return $form;
    }
}
