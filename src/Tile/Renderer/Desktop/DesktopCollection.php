<?php

namespace minervis\ToGo\Tile\Renderer\Desktop;

use ilObjUser;
use minervis\ToGo\Tile\Renderer\AbstractCollection;

/**
 * Class DesktopCollection
 *
 * @package minervis\ToGo\Tile\Renderer\Desktop
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  studer + raimann ag - Martin Studer <ms@studer-raimann.ch>
 */
class DesktopCollection extends AbstractCollection
{

    /**
     * @var ilObjUser
     */
    protected $user;


    /**
     * DesktopCollection constructor
     *
     * @param ilObjUser $user
     */
    public function __construct(ilObjUser $user)
    {
        $this->user = $user;

        parent::__construct();
    }


    /**
     * @inheritDoc
     */
    protected function initObjRefIds() /*: void*/
    {
        $this->obj_ref_ids = array_map(function (array $item) : int {
            return intval($item["child"]);
        }, self::togo()->favorites($this->user)
            ->getFavorites());
    }
}
