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
     * @param array $attributes
     */
    public function __construct($attributes = array())
    {
        // default options
        $this->setAttributes(array(
            'class' => '',
            'limit' => 2,
            'title' => 'Header',
            'sitetypes' => false,
            'showImage' => true,
            'order' => 'release_from DESC'
        ));

        parent::__construct($attributes);

        $this->addCSSFile(
            dirname(__FILE__) . '/Startpage2Box.css'
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
            'children' => $this->getSitesByList(),
            'this' => $this
        ));

        return $Engine->fetch(dirname(__FILE__) . '/Startpage2Box.html');
    }

    /**
     * Return the sites via the site types option
     *
     * @return array
     */
    protected function getSitesByList()
    {
        $sitetypes = $this->getAttribute('sitetypes');
        $limit     = $this->getAttribute('limit');

        if (!$limit) {
            $limit = 2;
        }

        // order
        switch ($this->getAttribute('order')) {
            case 'name ASC':
            case 'name DESC':
            case 'title ASC':
            case 'title DESC':
            case 'c_date ASC':
            case 'c_date DESC':
            case 'd_date ASC':
            case 'd_date DESC':
            case 'release_from ASC':
            case 'release_from DESC':
                $order = $this->getAttribute('order');
                break;

            default:
                $order = 'release_from DESC';
                break;
        }

        if (empty($sitetypes)) {
            return $this->getProject()->getSites(array(
                'limit' => $limit,
                'order' => $order
            ));
        }


        return QUI\Projects\Site\Utils::getSitesByInputList(
            $this->getProject(),
            $sitetypes,
            array(
                'limit' => $limit,
                'order' => $order
            )
        );
    }
}
