<?php

namespace minervis\ToGo\Tile\Renderer\Fixed;

use minervis\ToGo\Tile\Renderer\AbstractCollectionGUI;

/**
 * Class FixedCollectionGUI
 *
 * @package minervis\ToGo\Tile\Renderer\Fixed
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  studer + raimann ag - Martin Studer <ms@studer-raimann.ch>
 */
class FixedCollectionGUI extends AbstractCollectionGUI
{

    /**
     * @inheritDoc
     */
    public function __construct(array $obj_ref_ids)
    {
        parent::__construct($obj_ref_ids);
    }
}
