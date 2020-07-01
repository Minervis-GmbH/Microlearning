<?php

namespace srag\Plugins\SrTile\Collection;

use ActiveRecord;
use arConnector;
use ilSrTilePlugin;
use srag\DIC\SrTile\DICTrait;
use srag\Plugins\SrTile\Utils\SrTileTrait;

/**
 * Class Branch
 *
 * @package srag\Plugins\SrTile\Collection
 *
 * @author  Jephte Abijuru <jephte.abijuru@minervis.com>
 */
class Branch extends ActiveRecord
{

    use DICTrait;
    use SrTileTrait;
    const TABLE_NAME = "ui_uihk_" . ilSrTilePlugin::PLUGIN_ID . "_branch";
    const PLUGIN_CLASS_NAME = ilSrTilePlugin::class;



    /**
     * @inheritDoc
     */
    public function getConnectorContainerName() : string
    {
        return static::TABLE_NAME;
    }


    /**
     * @inheritDoc
     *
     * @deprecated
     */
    public static function returnDbTableName() : string
    {
        return self::TABLE_NAME;
    }
    /**
     * @var int
     *
     * @con_has_field    true
     * @con_fieldtype    integer
     * @con_length       8
     * @con_is_notnull   true
     * @con_is_primary   true
     * @con_sequence     true
     */
    protected $branch_id;

    /**
     * @var string
     *
     * @con_has_field    true
     * @con_fieldtype    text
     * @con_is_notnull   true
     * @con_length        256
     */
    protected $branch_name;
   

    /**
     * Branch constructor
     *
     * @param int              $primary_key_value
     * @param arConnector|null $connector
     */
    public function __construct(/*int*/
        $primary_key_value = 0,
        arConnector $connector = null
    ) {
        parent::__construct($primary_key_value, $connector);
    }


    /**
     * @inheritDoc
     */
    public function sleep(/*string*/ $field_name)
    {
        $field_value = $this->{$field_name};

        switch ($field_name) {
            default:
                return null;
        }
    }


    /**
     * @inheritDoc
     */
    public function wakeUp(/*string*/ $field_name, $field_value)
    {
        switch ($field_name) {
            case "branch_name":
                return $field_value;

            default:
                return null;
        }
    }


    /**
     * @return string
     */
    public function getBranchId() : string
    {
        return $this->branch_id;
    }


    /**
     * @param int $branch_id
     */
    public function setBranchId(int $branch_id)/*: void*/
    {
        $this->branch_id = $branch_id;
    }


    /**
     * @return string
     */
    public function getBranchName() : string
    {
        return $this->branch_name;
    }


    /**
     * @param string $branch_name
     */
    public function setBranchName(string $branch_name)/*: void*/
    {
        $this->branch_name = $branch_name;
    }

}