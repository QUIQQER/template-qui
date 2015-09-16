<?php

/**
 * This file contains QUI\TemplateQUI\Controls\StartpageIntro
 */

namespace QUI\TemplateQUI\Controls;

use QUI;

/**
 * Class Startpage2Box
 *
 * @package quiqqer/template-qui
 */
class StartpageIntro extends QUI\Control
{
    /**
     * constructor
     *
     * @param Array $attributes
     */
    public function __construct($attributes = array())
    {
        // default options
        $this->setAttributes(array(
            'class'  => '',
            'title1' => '',
            'icon1'  => '',
            'text1'  => '',
            'link1'  => '',
            'title2' => '',
            'icon2'  => '',
            'text2'  => '',
            'link2'  => '',
            'title3' => '',
            'icon3'  => '',
            'text3'  => '',
            'link3'  => ''
        ));

        parent::__construct($attributes);

        $this->addCSSFile(
            dirname(__FILE__).'/StartpageIntro.css'
        );
    }

    /**
     * (non-PHPdoc)
     *
     * @see \QUI\Control::create()
     */
    public function getBody()
    {
        $Engine = QUI::getTemplateManager()->getEngine();

        $Engine->assign(array(
            'this' => $this
        ));

        return $Engine->fetch(dirname(__FILE__).'/StartpageIntro.html');
    }
}