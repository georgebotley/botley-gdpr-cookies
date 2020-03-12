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
            'Cookie_StrictlyNecessary',
            'Cookie_PerformanceTracking',
            'Cookie_TargetingAdvertising',
        ];
    }

    /**
     * Establish if Cookies are permitted
     *
     * @return boolean
     */
    public static function AllowedCookies()
    {
        return CookieController::cookieStatus();
    }
    
    /**
     * Check if permission for StrictlyNeccessary cookies are provided.
     *
     * @return Boolean
     */
    public static function Cookie_StrictlyNecessary() {
	    return CookieController::cookieStatus("Cookie_StrictlyNecessary");
    }
    
    /**
     * Check if permission for PerformanceTracking cookies are provided.
     *
     * @return Boolean
     */
    public static function Cookie_PerformanceTracking() {
	    return CookieController::cookieStatus("Cookie_PerformanceTracking");
    }
    
    /**
     * Check if permission for TargetingAdvertising cookies are provided.
     *
     * @return Boolean
     */
    public static function Cookie_TargetingAdvertising() {
	    return CookieController::cookieStatus("Cookie_TargetingAdvertising");
    }
    
}