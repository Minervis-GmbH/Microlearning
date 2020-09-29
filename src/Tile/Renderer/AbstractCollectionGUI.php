<?php

namespace srag\Plugins\SrTile\Tile\Renderer;

use ilLink;
use ilToGoPlugin;
use ilToGoUIHookGUI;
use ilUIPluginRouterGUI;
use srag\DIC\SrTile\DICTrait;
use srag\Plugins\SrTile\LearningProgress\LearningProgressFilterGUI;
use srag\Plugins\SrTile\LearningProgress\LearningProgressLegendGUI;
use srag\Plugins\SrTile\Tile\Tile;
use srag\Plugins\SrTile\Utils\SrTileTrait;
use srag\Plugins\SrTile\Tile\TileGUI;
use srag\Plugins\SrTile\Collection\Collection;
use srag\Plugins\SrTile\Config\ConfigFormGUI;
use srag\Plugins\SrTile\Collection\Repository;


/**
 * Class AbstractCollectionGUI
 *
 * @package srag\Plugins\SrTile\Tile\Renderer
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  studer + raimann ag - Martin Studer <ms@studer-raimann.ch> * 
 */
abstract class AbstractCollectionGUI implements CollectionGUIInterface
{

    use SrTileTrait;
    use DICTrait;
    const PLUGIN_CLASS_NAME = ilToGoPlugin::class;
    private $test_link="";
    /**
     * @var CollectionInterface $collection
     */
    protected $collection;
    


    /**
     * AbstractCollectionGUI constructor
     *
     * @param mixed $param
     */
    public function __construct($param)
    {
        $this->collection = self::srTile()->tiles()->renderer()->factory()->newCollectionInstance($this, $param);
    }


    /**
     *
     */
    protected function initJS()/*: void*/
    {
        self::dic()->ui()->mainTemplate()->addJavascript(self::plugin()->directory() . "/js/tiles.js");
        self::dic()->ui()->mainTemplate()->addJavaScript(self::plugin()->directory() . "/node_modules/@iconfu/svg-inject/dist/svg-inject.min.js");
    }


    /**
     * @inheritDoc
     */
    public function render() : string
    {
        
        $this->initJS();

        $collection_html = "";

        if (count($this->collection->getTiles()) > 0) {

            $parent_tile = self::srTile()->tiles()->getInstanceForObjRefId(ilToGoUIHookGUI::filterRefId() ?? ROOT_FOLDER_ID);
            
            self::dic()->ui()->mainTemplate()->addCss(self::plugin()->directory() . "/css/togo.css");

            $tpl = self::plugin()->template("TileCollection/collection.html");

            self::dic()->ctrl()->setParameterByClass(TileGUI::class, TileGUI::GET_PARAM_REF_ID, intval(ilToGoUIHookGUI::filterRefId()));

            $tpl->setVariableEscaped("HEADER",self::plugin()->directory() ."/templates/images/headerImage.png");
            $tpl->setVariableEscaped("HEADER_RESPONSIVE",self::plugin()->directory() ."/templates/images/headerImage.png");
            
            

            $home_link=ilLink::_getStaticLink(intval(self::srTile()->config()->getHomeRefId()));

            
            
            $coll=self::srTile()->collections(self::dic()->user());
            $tpl->setVariableEscaped("VIEW", $parent_tile->getView());

            $tile_html = self::output()->getHTML(array_map(function (Tile $tile) : SingleGUIInterface {
                return self::srTile()->tiles()->renderer()->factory()->newSingleGUIInstance($this, $tile);
            }, $this->collection->getTiles()));

            $tpl->setVariable("TILES", $tile_html);
            $tpl->setVariable("TOPICS",self::output()->getHTML($this->renderTopicDropdown($coll->getTopics())));
            $tpl->setVariable("BRANCHES",self::output()->getHTML($this->renderBranchDropdown($coll->getBranches())));

            
            $tpl->setVariable("BACK_HOME_LINK", $home_link);

            /**
             * Bag Image was cancelled
             */
            $tpl_ls_mainmenu=self::plugin()->template("MainMenu/header_menu.html");
            $tpl_ls_mainmenu->setVariable("LOGO_IMAGE",self::plugin()->directory() ."/templates/images/HeaderIcon.png");
            $tpl_ls_mainmenu->setVariable("TOGO_IMAGE",self::plugin()->directory() ."/templates/images/BGN_togo.png");
            $bag_image_path=ConfigFormGUI::getImagePathWithCheck();
            if(!empty($bag_image_path)){
                $tpl_ls_mainmenu->setVariable("BAG_IMAGE","./".$bag_image_path);
            }else{
                $tpl_ls_mainmenu->setVariable("BAG_IMAGE",self::plugin()->directory() ."/templates/images/Rucksack.jpg");
            }
            $colors=self::srTile()->config()->getValue(ConfigFormGUI::BACK_COLOR);
            if (!empty($colors)){
                $tpl_ls_mainmenu->setVariable("BACK_COLOR", "#".$colors);
            }else{
                $tpl_ls_mainmenu->setVariable("BACK_COLOR", "#EAF3F2"); 
            }
            
            

            $umfrage_obj_ref_id=self::srTile()->config()->getUmfrageObjRefId();
            $umfrage_link="Umfrage";
            if($umfrage_obj_ref_id){
                $umfrage_link=self::srTile()->tiles()->getInstanceForObjRefId(intval($umfrage_obj_ref_id))->_getAdvancedLink();
                $umfrage_link=str_replace("href=","",$umfrage_link);
                $umfrage_link=str_replace('"',"",$umfrage_link);
            }
            $tpl_ls_mainmenu->setVariable("LS_UMFRAGE",self::output()->getHTML($this->generateLinks("Umfrage",$umfrage_link)));

            $was_sind_obj_ref_id=self::srTile()->config()->getWasSindObjRefId();
            $was_sind_link="Was sind die Lern-Snacks?";
            if($was_sind_obj_ref_id){
                $was_sind_link=self::srTile()->tiles()->getInstanceForObjRefId(intval($was_sind_obj_ref_id))->_getAdvancedLink();
                $was_sind_link=str_replace("href=","",$was_sind_link);
                $was_sind_link=str_replace('"',"",$was_sind_link);
            }
           


            $tpl_ls_mainmenu->setVariable("LS_WAS_SIND", self::output()->getHTML($this->generateLinks("Was sind Lern-Snacks?",$was_sind_link)));
            $tpl_ls_mainmenu->setVariable("LS_HOME", self::output()->getHTML($this->generateLinks("Angebot",$home_link)));
            $tpl_ls_mainmenu->setVariable("LS_FILTER_TOPIC",self::output()->getHTML($this->renderTopicDropdown($coll->getTopics())) );
            $tpl_ls_mainmenu->setVariable("LS_FILTER_BRANCH",self::output()->getHTML($this->renderBranchDropdown($coll->getBranches())));

            $tpl->setVariable("LS_MAINMENU",self::output()->getHTML($tpl_ls_mainmenu));



            


            if (!self::dic()->ctrl()->isAsynch() && $parent_tile->getShowLearningProgressFilter() === Tile::SHOW_TRUE) {
                LearningProgressFilterGUI::initToolbar(intval(ilToGoUIHookGUI::filterRefId()));
            }

            if (!self::dic()->ctrl()->isAsynch() && $parent_tile->getShowLearningProgressLegend() === Tile::SHOW_TRUE) {
                $tpl->setVariable("LP_LEGEND", self::output()->getHTML(new LearningProgressLegendGUI()));
            }

            $collection_html = self::output()->getHTML($tpl);

            $this->hideOriginalRowsOfTiles();
        }

        return $collection_html;
    }


    /**
     * @inheritDoc
     */
    public function hideOriginalRowsOfTiles() /*: void*/
    {
        $css = '';

        $parent_tile = self::srTile()->tiles()->getInstanceForObjRefId(ilToGoUIHookGUI::filterRefId() ?? ROOT_FOLDER_ID);

        $css .= '.tile';
        $css .= '{' . $parent_tile->_getLayout() . '}';

        $is_parent_css_rendered = false;
        foreach ($this->collection->getTiles() as $tile) {
            self::dic()->appEventHandler()->raise(IL_COMP_PLUGIN . "/" . ilToGoPlugin::PLUGIN_NAME, ilToGoPlugin::EVENT_CHANGE_TILE_BEFORE_RENDER, [
                "tile" => $tile
            ]);

            $css .= '#sr_tile_' . $tile->getTileId();
            $css .= '{' . $tile->_getSize() . '}';

            $css .= '#sr_tile_' . $tile->getTileId() . ' .card_bottom';
            $css .= '{' . $tile->_getColor(false, true) . '}';

            $css .= '#sr_tile_' . $tile->getTileId() . ' > .card';
            $css .= '{' . $tile->_getColor() . $tile->_getBorder() . '}';

            $css .= '#sr_tile_' . $tile->getTileId() . ' .btn-default, ';
            $css .= '#sr_tile_' . $tile->getTileId() . ' .badge';
            $css .= '{' . $tile->_getColor(true) . '}';

            if (!$is_parent_css_rendered) {
                $is_parent_css_rendered = true;

                if ($parent_tile->getApplyColorsToGlobalSkin() === Tile::SHOW_TRUE) {
                    if (!empty($parent_tile->_getBackgroundColor())) {
                        $css .= 'a#il_mhead_t_focus';
                        $css .= '{color:rgb(' . $parent_tile->_getBackgroundColor() . ')!important;}';
                    }

                    $css .= '.btn-default';
                    $css .= '{' . $tile->_getColor();
                    if (!empty($parent_tile->_getBackgroundColor())) {
                        $css .= 'border-color:rgb(' . $parent_tile->_getBackgroundColor() . ')!important;';
                    }
                    $css .= '}';
                }
            }
        }

        self::dic()->ui()->mainTemplate()->addInlineCss($css);
    }

    public function generateLinks(string $label, string $obj_link){
        //cut the href out
        
        $ui=self::dic()->ui()->factory();
        $renderer=self::dic()->ui()->renderer();
        return $renderer->render($ui->link()->standard($label,$obj_link));
    }


    public function renderTopicDropdown($all_topics=array()){
        $init_topics=array(
            'Lärmschutz',
            'Leitern und Tritte',
            'KommMitMensch',
            'Brandschutz',
            'Stress',
            'Sicher schneiden',
            'Transport',
            'Verkehrssicherheit'
        );
        $ui=self::dic()->ui()->factory();
        $renderer =self::dic()->ui()->renderer();
        $topics=array();
        $item_link=self::dic()->ctrl()->getLinkTargetByClass([
            ilUIPluginRouterGUI::class,
            TileGUI::class
        ], TileGUI::CMD_FILTER);



        foreach ($all_topics as $topic){
            $topics[]=$ui->button()->shy($topic, $this->editLink($item_link, $topic));
            
        }

        if(count($all_topics)==0){
            $actions=array("Kein Thema"=>"#");
            $labels="Kein Thema";
            $topics[]=$ui->viewControl()->mode($actions,$labels);

        }

        return $renderer->render($ui->dropdown()->standard($topics)->withLabel("Nach Thema"));

    }

    public function renderBranchDropdown($all_branches=array()){

        /**
         * Branches have moved to the tiles table and the initialzationmis not necessary
         */
        $init_branches=array(
            'Lärmschutz',
            'Leitern und Tritte',
            'KommMitMensch',
            'Brandschutz',
            'Stress',
            'Sicher schneiden',
            'Transport',
            'Verkehrssicherheit'
        );
        $ui=self::dic()->ui()->factory();
        $renderer =self::dic()->ui()->renderer();
        $branches=array();
        $item_link=self::dic()->ctrl()->getLinkTargetByClass([
            ilUIPluginRouterGUI::class,
            TileGUI::class
        ], TileGUI::CMD_FILTER);

        


        foreach ($all_branches as $branch){
            $branches[]=$ui->button()->shy($branch, $this->editLink($item_link, $branch, $item_type="branch"));
            
        }
        
        if(count($all_branches)==0){
            $actions=array("Keine Branche"=>"#");
            $labels="Keine Branche";
            $branches[]=$ui->viewControl()->mode($actions,$labels);


        }
        return $renderer->render($ui->dropdown()->standard($branches)->withLabel("Nach Branche"));

    }


    private function editLink($link, $filter_item, $item_type="topic"){

        self::dic()->ctrl()->saveParameterByClass(TileGUI::class,TileGUI::GET_FILTER_BY);
        self::dic()->ctrl()->saveParameterByClass(TileGUI::class,TileGUI::GET_FILTER_ITEM);
        self::dic()->ctrl()->setParameterByClass(TileGUI::class, TileGUI::GET_FILTER_BY,$item_type);
        self::dic()->ctrl()->setParameterByClass(TileGUI::class, TileGUI::GET_FILTER_ITEM,$filter_item);
        $item_link=self::dic()->ctrl()->getLinkTargetByClass([
            ilUIPluginRouterGUI::class,
            TileGUI::class
        ], TileGUI::CMD_FILTER);

        return $item_link;

    }


}
