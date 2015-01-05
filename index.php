<?php

/**
 * Emotion
 */

\QUI\Utils\Site::setRecursivAttribute( $Site, 'image_emotion' );

/**
 * own site type?
 */

$Engine->assign(array(
    'ownSideType' => strpos( $Site->getAttribute('type'), 'quiqqer/template-qui:' ) !== false ? 1 : 0
));
