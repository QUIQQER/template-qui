<?php

/**
 * Emotion
 */

\QUI\Utils\Site::setRecursivAttribute($Site, 'image_emotion');

/**
 * Project Logo
 */
$logo = false;
$configLogo = $Project->getConfig('templateQUI.settings.logo');

if (QUI\Projects\Media\Utils::isMediaUrl($configLogo)) {
    $logo = $configLogo;
}

/**
 * min header ?
 */

$minHeader = false;

switch ($Template->getLayoutType()) {
    case 'layout/rightSidebar':
        $minHeader = $Project->getConfig('templateQUI.settings.minHeaderRightSidebar');
        break;

    case 'layout/leftSidebar':
        $minHeader = $Project->getConfig('templateQUI.settings.minHeaderLeftSidebar');
        break;

    case 'layout/noSidebar':
        $minHeader = $Project->getConfig('templateQUI.settings.minHeaderNoSidebar');
        break;

}


/**
 * own site type?
 */

$Engine->assign(array(
    'logo'          => $logo,
    'ownSideType'   =>
        strpos($Site->getAttribute('type'), 'quiqqer/template-qui:') !== false
            ? 1 : 0,
    'quiTplType'    => $Project->getConfig('templateQUI.settings.standardType'),
    'BricksManager' => \QUI\Bricks\Manager::init(),
    'minHeader'     => $minHeader
));
