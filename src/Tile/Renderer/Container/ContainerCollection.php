<?php

namespace minervis\ToGo\Tile\Renderer\Container;

use minervis\ToGo\Tile\Renderer\AbstractCollection;

/**
 * Class ContainerCollection
 *
 * @package minervis\ToGo\Tile\Renderer\Container
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  studer + raimann ag - Martin Studer <ms@studer-raimann.ch>
 */
class ContainerCollection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $html;


    /**
     * ContainerCollection constructor
     *
     * @param string $html
     */
    public function __construct(string $html)
    {
        $this->html = $html;

        parent::__construct();
    }


    /**
     * @inheritDoc
     */
    protected function initObjRefIds() /*: void*/
    {
        $obj_ref_ids = [];

        preg_match_all('/\\s+id\\s*=\\s*["\']{1}lg_div_([0-9]+)/', $this->html, $obj_ref_ids);

        if (is_array($obj_ref_ids) && count($obj_ref_ids) > 1 && is_array($obj_ref_ids[1]) && count($obj_ref_ids[1]) > 0) {
            $this->obj_ref_ids = array_map("intval", $obj_ref_ids[1]);
        }
    }
}
