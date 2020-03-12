<?php

use SilverStripe\View\SSViewer;
use SilverStripe\View\TemplateGlobalProvider;
use SilverStripe\View\ThemeResourceLoader;

class GDPR_Global_Provider implements TemplateGlobalProvider
{
    /**
     * Define provided functions
     *
     * @return array
     */
    public static function get_template_global_variables()
    {
        return [
            'AllowedCookies',
        ];
    }


    /**
     * Establish if Cookies are 
     *
     * @return string
     */
    public static function AllowedCookies()
    {
        return CookieController::cookieStatus();
    }
}