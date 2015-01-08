<?php

/**
 * This file contains QUI\TemplateQUI\Controls\Startpage2Box
 */

namespace QUI\TemplateQUI\Controls;

use QUI;

/**
 * Class Startpage2Box
 *
 * @package quiqqer/template-qui
 */
class Startpage2Box extends QUI\Control
{
    /**
     * constructor
     * @param Array $attributes
     */
    public function __construct($attributes = array())
    {
        // default options
        $this->setAttributes(array(
            'class' => '',
            'limit' => 2,
            'title' => 'Header'
        ));

        parent::setAttributes( $attributes );

        $this->addCSSFile(
            dirname( __FILE__ ) . '/Startpage2Box.css'
        );
    }

    /**
     * (non-PHPdoc)
     * @see \QUI\Control::create()
     */
    public function getBody()
    {
        $Engine   = QUI::getTemplateManager()->getEngine();
        $Project  = $this->_getProject();

        $limit = $this->getAttribute('limit');

        if ( !$limit ) {
            $limit = 2;
        }

        $children = $Project->getSites(array(
            'limit' => $limit,
            'order' => 'c_date ASC'
        ));


        $Engine->assign(array(
            'children' => $children,
            'this'     => $this
        ));


        return $Engine->fetch( dirname( __FILE__ ) .'/Startpage2Box.html' );
    }
}