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
        $html = parent::render();
        return $this->tpl->get();

        if ( false || !self::$reset_file_upload_gui) {
            Closure::bind(function () {
            }, null, ilObjFileUploadDropzone::class)();
            $on_load_code = self::ildic()->ui()->mainTemplate()->getOnLoadCodeForAsynch();
            foreach ((array) $on_load_code as &$codes) {
                self::ildic()->logger()->root()->dump(array(strpos($codes, "il.UI.Dropzone")));
                if (strpos($codes, "il.UI.Dropzone") !== false) {
                    $codes = "";

                }
            }
            self::ildic()->logger()->root()->dump(array(count((array) $on_load_code), ));

            self::$reset_file_upload_gui = true;
        }
        global $DIC, $tpl;
        //$html = $this->tpl->get();

        $il_object = ilObjectFactory::getInstanceByRefId($this->tile->getObjRefId(), false);
        $file_upload_zone = new ilObjFileUploadDropzone($this->tile->getObjRefId(),  $this->tpl->get());
        if ($file_upload_zone->isUploadAllowed($il_object->getType())) {
            //$tpl->setFileUploadRefId($this->tile->getObjRefId());
            $html = self::togoplugin()->getHTML([
                //$this->tpl->get(),
                $file_upload_zone->getDropzoneHtml()
            ]);
        }

        return $html;
    }
}
