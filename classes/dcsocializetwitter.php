<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of dcSocialize.
#
# Copyright (c) 2010 Guillaume Kulakowski and contributors
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK ------------------------------------
if (!defined('DC_RC_PATH')) { return; }

class dcSocializeTwitter extends dcSocialize
{

    /**
     * Init widgets Twitter
     *
     * @param dcWidgets $w
     */
    public static function initWidgets($w)
    {
        // Twitter/Identi.ca feed
        $w->create('dcSocializeTwitter', __('Socialize: Twitter'),
            array('dcSocializeTwitter','twitterWidget'));

        $w->dcSocializeTwitter->setting('title',__('Title (optional):'), 'Twitter','text');

        $w->dcSocializeTwitter->setting('url',__('Service:'), 'http://twitter.com', 'combo', array(
                'Twitter' => 'http://twitter.com',
                'Identi.ca' => 'http://identi.ca/api' ) );

        $w->dcSocializeTwitter->setting('account',__('Twitter/Identi.ca identifier:'), '','text');
        $w->dcSocializeTwitter->setting('count',__("Number of tweets to display:"), '5','text');
        $w->dcSocializeTwitter->setting('noreplies',__("Exclude replies"), 0,'check');
        $w->dcSocializeTwitter->setting('homeonly',__('Home page only'), 0,'check');


        /* TweetMeme Widget */
        $w->create('dcSocializeTweetMemeButton', __('Socialize: TweetMeme'),
            array('dcSocializeTwitter','tweetMemeButtonWidget'));

        $w->dcSocializeTweetMemeButton->setting('title',__('Title (optional):'), '','text');

        $w->dcSocializeTweetMemeButton->setting('style',__('Style:'), 'normal', 'combo', array(
                'Normal' => 'normal',
                'Compact' => 'compact' ) );

        $w->dcSocializeTweetMemeButton->setting('homeonly',__('Home page only'), 0,'check');
        $w->dcSocializeTweetMemeButton->setting('homeexcept',__('Not in homepage:'), 0,'check');
    }



	/**
     * Get widget
     *
     * @param dcWidget $w
     * @return string
     */
    public static function twitterWidget($w)
    {
        if ( self::isHomeOnly($w) )
            return;

        $counter = self::getWidgetCounter($w, 'WidgetTwitter');

    	return '<div class="' . self::WIDGET_CSS_CLASSES . 'twitter" id="' . self::WIDGET_CSS_ID_PREFIX . 'WidgetTwitter' . $counter . '">
        ' . self::getWidgetTitle($w) .
        '    <ul class="user_timeline"><li class="loading">&nbsp;</li></ul>
		</div>
		<script type="text/javascript">//<![CDATA[
		$(document).ready(function(){' .
    	   '$.getJSON(' .
    	       '"' .$w->url . '/statuses/user_timeline/' . $w->account . '" +".json?&count=' . $w->count . '&callback=?",' .
    	       'function(data){' .
    	           '$ul=$(\'#' . self::WIDGET_CSS_ID_PREFIX . 'WidgetTwitter' . $counter . ' .user_timeline\');' .
    	           '$ul.empty();' .
    	           '$.each(data,function(i,post){' .
    	               ( $w->noreplies ? "if(post.in_reply_to_screen_name){return;}" : "" ) .
    	               '$ul.append("\<li>"+post.text+"\<\/li>");' .
                    '});' .
                '});' .
            '});
		//]]></script>';
    }



    /**
     * Add TweetMeme button
     *
     * @see http://help.tweetmeme.com/2009/04/06/tweetmeme-button/
     * @param dcWidget $w
     * @return string
     */
    public static function tweetMemeButtonWidget($w)
    {
        global $core;

        if ( self::isHomeExcept($w) )
            return;

        if ( self::isHomeOnly($w) )
            return;

        $counter = self::getWidgetCounter($w, 'WidgetTweetMemeButton');

        // Width & height
        switch ( $w->style )
        {
	    	case 'normal':
	           	$height = 61;
	        	$width = 50;
	        break;

            case 'compact':
                $height = 20;
                $width = 90;
            break;
        }

        return '<div class="' . self::WIDGET_CSS_CLASSES . 'tweetmeme" id="' . self::WIDGET_CSS_ID_PREFIX . 'WidgetTweetMemeButton' . $counter . '">
        ' . self::getWidgetTitle($w) .
        '<div id="replace_widget_tweetmeme_' . $counter . '"></div>' .
        '<script type="text/javascript">//<![CDATA[
        $(document).ready(function(){' .
            '$object_code=\'<iframe src="http://api.tweetmeme.com/button.js?' .
                    'url=\' + document.URL + \'' .
                    '&amp;style=' .  $w->style .
                    '&amp;source=seo' .
                    '&amp;width=' . $width .
                    '&amp;height=' . $height . '"'.
                'style="border:none;overflow:hidden;width:' . $width . 'px;height:' . $height . 'px"> ' .
            '</iframe>\';' .
            '$replace_me=$(\'#replace_widget_tweetmeme_' . $counter . '\'); ' .
            '$replace_me.replaceWith($object_code);' .
        '});
        //]]></script>' .
        '</div>';
    }
}

?>
