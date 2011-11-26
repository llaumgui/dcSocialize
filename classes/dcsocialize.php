<?php
/**
 * File containing the dcSocialize class
 *
 * @version //autogentag//
 * @package DCSocialize
 * @copyright Copyright (C) 2010-2011 Guillaume Kulakowski
 * @license Guillaume Kulakowski all rights reserved
 */
if ( !defined( 'DC_RC_PATH' ) ) { return; }


/**
 * The dcSocialize class is the parent class of all socialize classes
 *
 * @package DCSocialize
 * @version //autogentag//
 */
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

        if ( $w->homeonly && $core->url->type != 'default' )
        {
            return true;
        }
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
        {
            return true;
        }
        return false;
    }



    /**
     * Get title
     *
     * @param dcWidget $w
     * @return string
     */
    public static function getWidgetTitle( $w )
    {
        return ( $w->title != '' ) ? $title = '<h2>' . $w->title .'</h2>' : $title = '';
    }



    /**
     * Get and manage counter
     *
     * @param dcWidget $w
     * @param string $key
     * @return string
     */
    public static function getWidgetCounter($w, $key)
    {
        $key = self::WIDGET_CSS_ID_PREFIX.$key.'Counter';
        ( !isset( $GLOBALS[$key] ) ) ? $GLOBALS[$key] = 1 : $GLOBALS[$key]++;

        return $GLOBALS[$key];
    }

}

?>