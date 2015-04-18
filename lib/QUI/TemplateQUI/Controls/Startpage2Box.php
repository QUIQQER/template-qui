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
     *
     * @param Array $attributes
     */
    public function __construct($attributes = array())
    {
        // default options
        $this->setAttributes(array(
            'class'     => '',
            'limit'     => 2,
            'title'     => 'Header',
            'sitetypes' => false,
            'showImage' => true
        ));

        parent::setAttributes($attributes);

        $this->addCSSFile(
            dirname(__FILE__).'/Startpage2Box.css'
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

        $limit = $this->getAttribute('limit');
        $sitetypes = $this->getAttribute('sitetypes');
        $order = $this->getAttribute('order');

        if (!$limit) {
            $limit = 2;
        }

        if (!$order) {
            $order = 'release_from ASC';
        }

        if (!empty($sitetypes)) {
            $children = $this->_getSitesByList();

        } else {
            $children = $this->_getProject()->getSites(array(
                'limit' => $limit,
                'order' => $order
            ));
        }

        $Engine->assign(array(
            'children' => $children,
            'this'     => $this
        ));


        return $Engine->fetch(dirname(__FILE__).'/Startpage2Box.html');
    }

    /**
     * Return the sites via the site types option
     *
     * @return array
     */
    protected function _getSitesByList()
    {
        $limit = $this->getAttribute('limit');
        $order = $this->getAttribute('order');

        if (!$limit) {
            $limit = 2;
        }

        if (!$order) {
            $order = 'release_from ASC';
        }

        return QUI\Projects\Site\Utils::getSitesByInputList(
            $this->_getProject(),
            $this->getAttribute('sitetypes'),
            array(
                'limit' => $limit,
                'order' => $order
            )
        );
    }
}