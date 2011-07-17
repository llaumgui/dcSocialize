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

class dcSocializeGoogle extends dcSocialize
{
    const SCRIPT_URL_GOOGLEPLUS = 'https://apis.google.com/js/plusone.js';



    /**
     * Init widgets Twitter
     *
     * @param dcWidgets $w
     */
    public static function initWidgets($w)
    {
        // Google+
        $w->create('dcSocializeGooglePlus', __('Socialize: Google+'),
            array('dcSocializeGoogle','googlePlusWidget'));

        $w->dcSocializeGooglePlus->setting('title', __('Title (optional):'), '','text');

        $w->dcSocializeGooglePlus->setting('size', __('Size:'), 'normal', 'combo', array(
                __('Small') => 'small',
                __('Standard') => '',
                __('Medium') => 'medium',
                __('Tall') => 'tall' ) );

        $w->dcSocializeGooglePlus->setting('displaycounter', __('Show counter'), 1,'check');
        $w->dcSocializeGooglePlus->setting('homeonly', __('Home page only'), 0,'check');
        $w->dcSocializeGooglePlus->setting('homeexcept', __('Not in homepage:'), 0,'check');
    }



    /**
     * Add Google+ button
     *
     * @see http://www.google.com/intl/fr/webmasters/+1/button/index.html
     * @param dcWidget $w
     * @return string
     */
    public static function googlePlusWidget($w)
    {
        global $core;

        if ( self::isHomeExcept($w) )
            return;

        if ( self::isHomeOnly($w) )
            return;

        $count = '';
        if ( !$w->displaycounter )
            $count = ' count="false"';

        $size = '';
        if ( $w->size != '' )
            $size = ' size="' . $w->size . '"';

        $counter = self::getWidgetCounter($w, 'WidgetGooglePlusWidget');

        return '<script type="text/javascript">//<![CDATA[
        $(document).ready(function(){' .
            '$.getScript(\'' . self::SCRIPT_URL_GOOGLEPLUS . '\');' .
        '});
        //]]></script>
        <div class="' . self::WIDGET_CSS_CLASSES . 'googleplus" id="' . self::WIDGET_CSS_ID_PREFIX . 'WidgetGooglePlus' . $counter . '">
			' . self::getWidgetTitle($w) .
            '<g:plusone' . $size . $count. '></g:plusone>
        </div>';
    }
}

?>