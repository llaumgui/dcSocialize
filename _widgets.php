<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of dcSocialize.
#
# Copyright (c) 2010-2011 Guillaume Kulakowski and contributors
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK ------------------------------------
if (!defined('DC_RC_PATH')) { return; }

// Need DC 2.2
if (!version_compare(DC_VERSION,'2.2','>=')) { echo "dcSocialize: incorrect Dotclear version. dcSocialize need DC >= 2.2 !"; }

// Autoloads
$__autoload['dcSocialize'] = dirname(__FILE__).'/classes/dcsocialize.php';
$__autoload['dcSocializeAddThis'] = dirname(__FILE__).'/classes/dcsocializeaddthis.php';
$__autoload['dcSocializeFacebook'] = dirname(__FILE__).'/classes/dcsocializefacebook.php';
$__autoload['dcSocializeTwitter'] = dirname(__FILE__).'/classes/dcsocializetwitter.php';

// Init widgets
$core->addBehavior('initWidgets', array('dcSocializeAddThis','initWidgets'));
$core->addBehavior('initWidgets', array('dcSocializeFacebook','initWidgets'));
$core->addBehavior('initWidgets', array('dcSocializeTwitter','initWidgets'));

?>