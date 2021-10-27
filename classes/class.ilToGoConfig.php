<?php
require_once __DIR__ . "/../vendor/autoload.php"; 
use ILIAS\DI\Container;
use minervis\ToGo\Utils\ToGoTrait;

/**
 * class ilToGoConfig
 * @author  Jephte Abijuru <jephte.abijuru@minervis.com>
 * @version $Id$
 *
 */

 class ilToGoConfig
 {
    use ToGoTrait;
    const PLUGIN_CLASS_NAME = ilToGoPlugin::class;
    const PLUGIN_ID = "togo";
    const TABLE_NAME = "ui_uihk_togo_config";

    /** @var Container $dic */
    private $dic;
    /** @var ilDBInterface $db */
    private $db;

    private static $instance = null;

    private $values;

    /**
     * Constructor
     */
	public function __construct()
	{
	    global $DIC; /** @var Container $DIC */
        $this->dic = $DIC;
        $this->db = $DIC->database();
        $this->read();
	}

    /**
     * Get singleton instance
     *
     * @param int|null $connId
     * @return ilToGoConfig
     */
	public static function getInstance()
	{
		if(self::$instance)
		{
			return self::$instance;
		}
		return self::$instance = new ilToGoConfig();
	}

    public function save()
    {
        global $ilDB;
        // check if data exisits decide to update or insert
        $result = $ilDB->query("SELECT * FROM " .self::TABLE_NAME);
        $num = $ilDB->numRows($result);
        if ($num==0) {
            $insert_query = "INSERT INTO " .self::TABLE_NAME ."(name, value) VALUES ";
            foreach($this->values as $name=>$value){
                $insert_query = $insert_query . "( ". $ilDB->quote($name, "text") . " , ". $ilDB->quote($value, "text") . ")";
            }

        }else{
            $a_data = array();
            foreach($this->values as $name=>$value){
                $ilDB->manipulate("UPDATE ". self::TABLE_NAME . " set ".
                " value = ". $ilDB->quote( $value, "text") . 
                " WHERE name = " . $ilDB->quote( $name, "text"));
            }
        }
    }
    public function read()
    {
        global $ilDB;
        $values = [];
        $result = $ilDB->query("SELECT * FROM  ". self::TABLE_NAME);
        while ($record = $ilDB->fetchAssoc($result)){
            $values[$record['name']]= $record['value'];
        }
        $this->values = $values;
    }

    public function getValue($name){      
        return $this->values[$name];
    }

    public function setValue($name, $value)
    {
        $this->values[$name] = $value;
    }
    public function getValues()
    {
        return $this->values;
    }
    public function setValues($values)
    {
        foreach($values as $name=>$value) {
            if( in_array($name, array_keys($this->values))) {
                $this->values[$name] = $value;
            }
        }
    }

    public static function installTables() 
    {
        global $ilDB;
        if (!$ilDB->tableExists(self::TABLE_NAME)){
            $ilDB->createTable(self::TABLE_NAME, array(
                'name' => array(
                    'type' => 'text',
                    'length' => 128,
                    'notnull' => false
                ),
                'value' => array(
                    'type' => 'text',
                    'length' => 128,
                    'notnull' => false
                )
            ));
            $ilDB->addPrimaryKey(self::TABLE_NAME, array("name"));
            $query = " INSERT INTO ". self::TABLE_NAME . " (name, value) VALUES" . 
                    "(". $ilDB->quote("base_container","text") .", ". $ilDB->quote("","text") . "), " . 
                    "(". $ilDB->quote("was_sind","text") .", ". $ilDB->quote("","text") . "), " . 
                    '('. $ilDB->quote("umfrage_object","text") .", ". $ilDB->quote("",'text') . ")";
            $ilDB->manipulate($query);

        }       
    }

    public function getHomeRefId()
    {
        return intval($this->getValue('base_container'));
    }

    public function getUmfrageObjRefId()
    {
        return intval($this->getValue('umfrage_object'));
    }
    public function getWasSindObjRefId()
    {
        return intval($this->getValue('was_sind'));        
    }

    public function dropTables() 
    {
        global $ilDB;
        if ($ilDB->tableExists(self::TABLE_NAME)){
            $ilDB->dropTable(self::TABLE_NAME);            
        }       
    }

 }