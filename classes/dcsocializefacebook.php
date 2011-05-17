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

class dcSocializeFacebook extends dcSocialize
{
    const SCRIPT_URL_ILIKE = 'http://www.facebook.com/plugins/like.php';
    const SCRIPT_URL_SHARE = 'http://static.ak.fbcdn.net/connect.php/js/FB.Share';



    /**
     * Init widgets Facebook
     *
     * @param dcWidgets $w
     */
    public static function initWidgets($w)
    {
        // I like
        $w->create('dcSocializeFacebookILike', __('Socialize: Facebook, I like'),
            array('dcSocializeFacebook','facebookILikeWidget'));

        $w->dcSocializeFacebookILike->setting('title',__('Title (optional):'), '','text');
        $w->dcSocializeFacebookILike->setting('style',__('Style:'), 'button_count','combo',array(
            __("Standard") => 'standard',
            __("Button") => 'button_count' ) );

        $w->dcSocializeFacebookILike->setting('showface',__('Show Face:'), 1,'check');

        $w->dcSocializeFacebookILike->setting('action',__('Verb to display:'), 'like','combo',array(
            __("Like") => 'like',
            __("Recommend") => 'recommend' ) );

        $w->dcSocializeFacebookILike->setting('colorscheme',__('Color Scheme:'), 'light','combo',array(
            __("Light") => 'light',
            __("Dark") => 'dark' ) );

        $w->dcSocializeFacebookILike->setting('height',__('Height:'), '80','text');
        $w->dcSocializeFacebookILike->setting('homeonly',__('Home page only'), 0,'check');
        $w->dcSocializeFacebookILike->setting('homeexcept',__('Not in homepage:'), 0,'check');
        $w->dcSocializeFacebookILike->setting('usehomepage',__('Use homepage URL for other page than post:'), 1,'check');


        /* Share */
        $w->create('dcSocializeFacebookShare', __('Socialize: Facebook, Share'),
            array('dcSocializeFacebook','facebookShareWidget'));

        $w->dcSocializeFacebookShare->setting('title',__('Title (optional):'), '','text');

        $w->dcSocializeFacebookShare->setting('style',__('Style:'), 'box_count','combo',array(
            __("Box count") => 'box_count',
            __("Button count") => 'button_count',
            __("Button") => 'button',
            __("Icon with link") => 'icon_link',
            __("Icon") => 'icon' ) );

        $w->dcSocializeFacebookShare->setting('homeonly',__('Home page only'), 0,'check');
        $w->dcSocializeFacebookShare->setting('homeexcept',__('Not in homepage:'), 0,'check');
    }



    /**
     * Get I like widget
     *
     * @param dcWidget $w
     * @return string
     */
    public static function facebookILikeWidget($w)
    {
    	return dcSocializeFacebook::dcFacebookILikeWidget($w);
    }



    /**
     * Return I like widget code
     *
     * @param dcWidget $w
     * @return string
     */
    public static function dcFacebookILikeWidget($w)
    {
        global $core;

        if ( self::isHomeExcept($w) )
            return;

        if ( self::isHomeOnly($w) )
            return;

        if ($w->usehomepage && $core->url->type != 'post' )
            $link = $core->blog->host;
        else
            $link = $core->blog->host . $_SERVER['REQUEST_URI'];
        $link = urlencode($link);

        $counter = self::getWidgetCounter($w, 'WidgetFacebookILike');
        ( $w->showface ) ? $showface = 'true' : $showface = 'false';

        return '<div class="' . self::WIDGET_CSS_CLASSES . 'facebook_ilike" id="' . self::WIDGET_CSS_ID_PREFIX . 'WidgetFacebookILike' . $counter . '">
        ' . self::getWidgetTitle($w) .
        '<div id="replace_widget_facebook_ilike_' . $counter . '"></div>' .
        '<script type="text/javascript">//<![CDATA[
        $(document).ready(function(){' .
            '$object_code=\'<iframe src="' . self::SCRIPT_URL_ILIKE . '?' .
                    'href=' . $link .
                    '&amp;layout=' . $w->style .
                    '&amp;show_faces=' . $showface .
                    '&amp;width=100%' .
                    '&amp;action=' . $w->action .
                    '&amp;font' .
                    '&amp;colorscheme=' . $w->colorscheme .
                    '&amp;height=' . $w->height . '"' .
                'style="border:none;overflow:hidden;width:100%;height:' . $w->height . 'px;"> ' .
            '</iframe>\';' .
            '$replace_me=$(\'#replace_widget_facebook_ilike_' . $counter . '\'); ' .
            '$replace_me.replaceWith($object_code);' .
        '});
        //]]></script>' .
        '
        </div>';
    }



    /**
     * Return Share widget code
     *
     * @param dcWidget $w
     * @return string
     */
    public static function facebookShareWidget($w)
    {
        if ( self::isHomeExcept($w) )
            return;

        if ( self::isHomeOnly($w) )
            return;

    	return '<div class="' . self::WIDGET_CSS_CLASSES . 'facebook_share" id="' . self::WIDGET_CSS_ID_PREFIX . 'WidgetFacebookShare' . self::getWidgetCounter($w, 'WidgetFacebookShare') . '">
        ' . self::getWidgetTitle($w) . '
        <a name="fb_share" type="' . $w->style . '">' . __('Share'). '</a>
        <script src="' . self::SCRIPT_URL_SHARE . '" type="text/javascript"></script>
        </div>';
    }

}

?>