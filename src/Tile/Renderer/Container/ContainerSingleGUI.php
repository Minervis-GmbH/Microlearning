<?php

namespace minervis\ToGo\Tile\Renderer\Container;

use Closure;
use ilFileUploadGUI;
use ilFileUploadUtil;
use ilObjectFactory;
use ilObjFileUploadDropzone;
use LTI\ilGlobalTemplate;
use minervis\ToGo\Tile\Renderer\AbstractSingleGUI;

/**
 * Class ContainerSingleGUI
 *
 * @package minervis\ToGo\Tile\Renderer\Container
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  studer + raimann ag - Martin Studer <ms@studer-raimann.ch>
 */
class ContainerSingleGUI extends AbstractSingleGUI
{
    protected static $reset_file_upload_gui = false;


    /**
     * @return string
     */
    public function render() : string
    {
        return parent::render();
    }
}
