<?php
/**
 * File containing the dcSocializeAddThis class
 *
 * @version //autogentag//
 * @package DCSocialize
 * @copyright Copyright (C) 2010-2011 Guillaume Kulakowski
 * @license Guillaume Kulakowski all rights reserved
 */
if ( !defined( 'DC_RC_PATH' ) ) { return; }


/**
 * The class for AddThis
 *
 * @package DCSocialize
 * @version //autogentag//
 */
class dcSocializeAddThis extends dcSocialize
{
	const SCRIPT_URL_WIDGET = 'http://s7.addthis.com/js/250/addthis_widget.js';
	const SCRIPT_URL_BOOKMARK = 'http://www.addthis.com/bookmark.php';



    /**
     * Init widget AddThis
     *
     * @param dcWidgets $w
     */
    public static function initWidgets($w)
    {
        $w->create( 'dcSocializeAddThis', __( 'Socialize: AddThis' ),
            array( 'dcSocializeAddThis','addThisWidget' ) );

        $w->dcSocializeAddThis->setting( 'title', __( 'Title (optional):' ), '', 'text' );
        $w->dcSocializeAddThis->setting( 'text', __( 'Text (optional):' ), __( 'Share' ), 'text' );

        $w->dcSocializeAddThis->setting( 'style', __( 'Style:' ), null, 'combo', array(
            __( 'Button with text' ) => 'buttonWithText',
            __( 'Button without icon' ) => 'buttonWithoutIcon',
            __( 'Toolbox' ) => 'toolbox' ) );

        $w->dcSocializeAddThis->setting( 'services', __( 'Services (for toolbar):' ), 'twitter,googlebuzz,facebook,delicious,google,digg', 'text' );
        $w->dcSocializeAddThis->setting( 'separator', __( 'Separator (for toolbar):' ), '|', 'text' );
        $w->dcSocializeAddThis->setting( 'username', __( 'Username (optional):' ), '', 'text' );
        $w->dcSocializeAddThis->setting( 'homeonly', __( 'Home page only' ), 0, 'check' );
    }



    /**
     * Get widget AddThis
     *
     * @param dcWidget $w
     * @return string
     */
    public static function addThisWidget($w)
    {
        if ( self::isHomeOnly( $w ) )
        {
            return;
        }

        // Get style
        $style = 'get' . ucfirst( $w->style );
        if ( !is_callable( array( 'self', $style ) ) )
        {
            return '';
        }

        ( $w->username != '' ) ? $username = '#username=' . $w->username : $username = '';

        return '<div class="' . self::WIDGET_CSS_CLASSES . 'addthis" id="' . self::WIDGET_CSS_ID_PREFIX . 'WidgetAddThis' . self::getWidgetCounter( $w, 'WidgetAddThis' ) . '">
            ' . self::getWidgetTitle( $w ) .
            self::$style( $w ) . '
        </div>
        <script type="text/javascript">//<![CDATA[
        $(document).ready(function(){' .
            '$.getScript(\'' . self::SCRIPT_URL_WIDGET . $username . '\');' .
        '});
        //]]></script>';
    }



    /**
     * Get AddThis Toolbox
     *
     * @param dcWidget $w
     * @return string
     */
    public static function getToolbox( &$w )
    {
        ( $w->username != '' ) ? $username = '&amp;username=' . $w->username : $username = '';

        $services = '';
        foreach ( explode( ',', $w->services ) as $s )
        {
            $services .= '<a class="addthis_button_' . trim( $s ) .' "></a>';
        }

        return '<p class="addthis addthis_toolbox addthis_default_style">
            <a href="' . self::SCRIPT_URL_BOOKMARK . '?v=250' . $username . '" class="addthis_button_compact">' . $w->text . '</a>
            <span class="addthis_separator">' . $w->separator . '</span>
            ' . $services .'
        </p>';
    }



    /**
     * Get AddThis button with text
     *
     * @param dcWidget $w
     * @return string
     */
    public static function getButtonWithText( &$w )
    {
        return self::button( $w, 'lg', 125 );
    }



    /**
     * Get AddThis button without text
     *
     * @param dcWidget $w
     * @return string
     */
    public static function getButtonWithoutIcon( &$w )
    {
        return self::button( $w, 'sm', 83 );
    }



    /**
     * Get AddThis button
     *
     * @param dcWidget $w
     * @param string $btn
     * @return string
     */
    public static function button( &$w, $btn )
    {
        global $_lang;
        ( $w->username != '' ) ? $username = '&amp;username=' . $w->username : $username = '';

        return '<a class="addthis_button" href="' . self::SCRIPT_URL_BOOKMARK . '?v=250' . $username .'">
            <img src="http://s7.addthis.com/static/btn/v2/' . $btn . '-share-' . $_lang . '.gif" height="16" alt="' . $w->text . '" style="border:0"/>
        </a>';
    }

}

?>