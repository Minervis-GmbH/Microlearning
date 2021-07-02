<?php

namespace srag\DataTableUI\ToGo\Implementation\Data\Row;

use srag\CustomInputGUIs\ToGo\PropertyFormGUI\Items\Items;

/**
 * Class GetterRowData
 *
 * @package srag\DataTableUI\ToGo\Implementation\Data\Row
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class GetterRowData extends AbstractRowData
{

    /**
     * @inheritDoc
     */
    public function __invoke(string $key)
    {
        return Items::getter($this->getOriginalData(), $key);
    }
}
