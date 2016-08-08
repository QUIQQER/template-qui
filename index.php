<?php

/**
 * Emotion
 */

\QUI\Utils\Site::setRecursivAttribute($Site, 'image_emotion');

/**
 * Project Logo
 */
$logo       = false;
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
 * colors
 */

$colorFooterBackground = '#414141';
$colorFooterFont       = '#D1D1D1';
$colorMain             = '#dd151b';
$colorBackground       = '#F7F7F7';
$colorFooterLinks      = 'E6E6E6';

if ($Project->getConfig('templateQUI.settings.colorFooterBackground')) {
    $colorFooterBackground = $Project->getConfig('templateQUI.settings.colorFooterBackground');
}

if ($Project->getConfig('templateQUI.settings.colorFooterFont')) {
    $colorFooterFont = $Project->getConfig('templateQUI.settings.colorFooterFont');
}

if ($Project->getConfig('templateQUI.settings.colorMain')) {
    $colorMain = $Project->getConfig('templateQUI.settings.colorMain');
}

if ($Project->getConfig('templateQUI.settings.colorBackground')) {
    $colorBackground = $Project->getConfig('templateQUI.settings.colorBackground');
}

if ($Project->getConfig('templateQUI.settings.colorFooterLinks')) {
    $colorFooterLinks = $Project->getConfig('templateQUI.settings.colorFooterLinks');
}

$Engine->assign(array(
    'colorFooterBackground' => $colorFooterBackground,
    'colorFooterFont'       => $colorFooterFont,
    'colorMain'             => $colorMain,
    'colorBackground'       => $colorBackground,
    'colorFooterLinks'      => $colorFooterLinks
));

/**
 * lang settings
 */

$langOption = $Project->getConfig('templateQUI.settings.langSwitch.options');

switch ($langOption) {
    case "showFlag":
        $langFlag = "inline";
        $langText = "none";
        break;

    case "showText":
        $langFlag = "none";
        $langText = "inline";
        break;

    default:
    case "showBoth":
        $langFlag = "inline;";
        $langText = "inline";
        break;
}

/**
 * own site type?
 */

$Engine->assign(array(
    'logo'                => $logo,
    'ownSideType'         =>
        strpos($Site->getAttribute('type'), 'quiqqer/template-qui:') !== false
            ? 1 : 0,
    'quiTplType'          => $Project->getConfig('templateQUI.settings.standardType'),
    'BricksManager'       => \QUI\Bricks\Manager::init(),
    'minHeader'           => $minHeader,
    'langSwitchDisplay'   => $Project->getConfig('templateQUI.settings.langSwitch.display'),
    'langSwitchShowLabel' => $Project->getConfig('templateQUI.settings.langSwitch.show.label'),
    'langFlag'            => $langFlag,
    'langText'            => $langText

));


/**
 * Body Class
 */

$bodyClass = '';

switch ($Template->getLayoutType()) {
    case 'layout/startpage':
        $bodyClass = 'homepage';
        break;

    case 'layout/leftSidebar':
        $bodyClass = 'left-sidebar';
        break;

    case 'layout/rightSidebar':
        $bodyClass = 'right-sidebar';
        break;

    default:
        $bodyClass = 'no-sidebar';
}

$Engine->assign('bodyClass', $bodyClass);

$Engine->assign(
    'typeClass',
    'type-' . str_replace(array('/', ':'), '-', $Site->getAttribute('type'))
);
