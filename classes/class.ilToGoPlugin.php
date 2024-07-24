<?php

require_once __DIR__ . "/../vendor/autoload.php";


use minervis\ToGo\Utils\ToGoTrait;


/**
 * Class ilToGoPlugin
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ilToGoPlugin extends ilUserInterfaceHookPlugin
{
   // use PluginUninstallTrait;
    use ToGoTrait;
    const PLUGIN_ID = "togo";
    const PLUGIN_NAME = "ToGo";
    const PLUGIN_CLASS_NAME = self::class;
    const WEB_DATA_FOLDER = self::PLUGIN_ID . "_data";
    const EVENT_CHANGE_TILE_BEFORE_RENDER = "change_title_before_render";
    const EVENT_SHOULD_NOT_DISPLAY_ALERT_MESSAGE = "should_not_display_alert_message";
    /**
     * @var self|null
     */
    protected static $instance = null;
    public static ?ilComponentRepositoryWrite $cached_component_repository = null;
    public static $cached_id = 0;

    public function __construct(ilDBInterface $db, ilComponentRepositoryWrite $component_repository, string $id)
    {
        parent::__construct($db, $component_repository, $id);
        self::$cached_id = $id;
        self::$cached_component_repository = $component_repository;

    }

    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self(self::ildic()->database(), self::$cached_component_repository, self::$cached_id);
        }

        return self::$instance;
    }

    public function getPluginName() : string
    {
        return self::PLUGIN_NAME;
    }


    public function handleEvent(/*string*/ $a_component, /*string*/ $a_event, /*array*/ $a_parameter)/* : void*/
    {
        switch ($a_component) {
            case "Services/Object":
                switch ($a_event) {
                    case "cloneObject":
                        self::togo()->tiles()->cloneTile($a_parameter["cloned_from_object"]->getRefId(), $a_parameter["object"]->getRefId());
                        break;
                    default:
                        break;
                }
                break;

            default:
                break;
        }
    }


    protected function deleteData()/*: void*/
    {
        self::togo()->dropTables();
    }

    protected function beforeUninstall(): bool
    {
        self::togo()->dropTables();
        return true;
    }
}
