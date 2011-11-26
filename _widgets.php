<?php
/**
 * File containing the widget definition part of the plugin
 *
 * @version //autogentag//
 * @package DCSocialize
 * @copyright Copyright (C) 2010-2011 Guillaume Kulakowski
 * @license Guillaume Kulakowski all rights reserved
 */
if ( !defined( 'DC_RC_PATH' ) ) { return; }

// Need DC 2.2
if ( !version_compare( DC_VERSION, '2.2', '>=' ) )
{
    echo 'dcSocialize: incorrect Dotclear version. dcSocialize need DC >= 2.2 !';
}

// Autoloads
$__autoload['dcSocialize'] = dirname( __FILE__ ).'/classes/dcsocialize.php';
$__autoload['dcSocializeAddThis'] = dirname( __FILE__ ).'/classes/dcsocializeaddthis.php';
$__autoload['dcSocializeFacebook'] = dirname( __FILE__ ).'/classes/dcsocializefacebook.php';
$__autoload['dcSocializeTwitter'] = dirname( __FILE__ ).'/classes/dcsocializetwitter.php';
$__autoload['dcSocializeGoogle'] = dirname( __FILE__ ).'/classes/dcsocializegoogle.php';

// Init widgets
$core->addBehavior( 'initWidgets', array('dcSocializeAddThis','initWidgets' ) );
$core->addBehavior( 'initWidgets', array('dcSocializeFacebook','initWidgets' ) );
$core->addBehavior( 'initWidgets', array('dcSocializeTwitter','initWidgets' ) );
$core->addBehavior( 'initWidgets', array('dcSocializeGoogle','initWidgets' ) );

?>