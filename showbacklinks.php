<?php

$wgExtensionCredits['skin'][] = array(
    'path' => __FILE__,
    'name' => 'showbacklinks',
    'author' => array( 'Michael Murtaugh <mm@automatist.org>' ),
    'url' => 'https://github.com/automatist/showbacklinks.php', 
    'description' => 'This extension adds a backlinks section to the end of every page.',
    'version'  => 1.0,
);

$dir = dirname( __FILE__ ) . '/';

// Message class
$wgExtensionMessagesFiles['WGSBL' ] = $dir . 'showbacklinks.i18n.php';
// Helper class
$wgAutoloadClasses[ 'ShowBackLinksHooks' ] = $dir . 'showbacklinks.body.php';
// Hooks
$wgHooks['SkinAfterContent' ][] = 'ShowBackLinksHooks::onSkinAfterContent';

