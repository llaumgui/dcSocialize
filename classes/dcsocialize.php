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

class dcSocialize
{
    const WIDGET_CSS_ID_PREFIX = 'dcsocialize_';
    const WIDGET_CSS_CLASSES = 'dcsocialize dcsocialize_widget dcsocialize_widget_';



    /**
     * Check if is homeonly condition is true
     *
     * @param dcWidgets $w
     * @return boolean
     */
    public static function isHomeOnly($w)
    {
        global $core;

        if ($w->homeonly && $core->url->type != 'default')
            return true;
        return false;
    }



    /**
     * Check if is homeexcept condition is true
     *
     * @param dcWidgets $w
     * @return boolean
     */
    public static function isHomeExcept($w)
    {
        global $core;

        if ($w->homeexcept && $core->url->type == 'default')
            return true;
        return false;
    }



    /**
     * Get title
     *
     * @param $w
     * @return unknown_type
     */
    public static function getWidgetTitle($w)
    {
        return ( $w->title != '' ) ? $title = '<h2>' . $w->title .'</h2>' : $title = '';
    }



    /**
     * Get and manage counter
     *
     * @param $w
     * @return unknown_type
     */
    public static function getWidgetCounter($w, $key)
    {
    	$key = self::WIDGET_CSS_ID_PREFIX.$key.'Counter';
        ( !isset( $GLOBALS[$key] ) ) ? $GLOBALS[$key] = 1 : $GLOBALS[$key]++;

        return $GLOBALS[$key];
    }

}

?>