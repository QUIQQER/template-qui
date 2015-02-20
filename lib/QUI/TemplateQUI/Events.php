<?php

/**
 * This file contains \QUI\TemplateQUI\Events
 */

namespace QUI\TemplateQUI;

use QUI;
use QUI\Bricks\Manager as BrickManager;
use QUI\Projects\Project;
use QUI\Utils\XML;

/**
 * Class QUI\TemplateQUI\Events
 * Event handling
 *
 * @package quiqqer/template-qui
 */

class Events
{
    /**
     *
     */
    static function onBricksGetAreaByProject(BrickManager $Bricks, Project $Project, &$areaList)
    {
        $projectName = $Project->getName();

        // get all vhosts, and the used templates of the project
        $vhosts     = QUI::getRewrite()->getVHosts();
        $quiTplUsed = false;

        foreach ( $vhosts as $vhost )
        {
            if ( !isset( $vhost['template'] ) ) {
                continue;
            }

            if ( $vhost['project'] != $projectName ) {
                continue;
            }

            if ( 'quiqqer/template-qui' == $vhost['template'] ) {
                $quiTplUsed = true;
            }
        }

        if ( $quiTplUsed === false ) {
            return;
        }

        $defaultType = $Project->getConfig( 'templateQUI.settings.standardType' );

        if ( $defaultType != 'rightSidebar' && $defaultType != 'leftSidebar' ) {
            return;
        }

        $brickXML = realpath( OPT_DIR . 'quiqqer/template-qui/bricks.xml' );

        if ( !$brickXML ) {
            return;
        }

        $Dom  = XML::getDomFromXml( $brickXML );
        $Path = new \DOMXPath( $Dom );

        $siteType = 'quiqqer/template-qui:types/'. $defaultType;

        $areas = $Path->query(
            "//quiqqer/bricks/templateAreas/types/type[@type='{$siteType}']/area"
        );


        foreach ( $areas as $Area )
        {
            $area = QUI\Bricks\Utils::parseAreaToArray( $Area, $Path );
            $name = $area[ 'name' ];

            foreach ( $areaList as $available  )
            {
                if ( $available['name'] == $name ) {
                    continue 2;
                }
            }

            $areaList[] = $area;
        }
    }
}