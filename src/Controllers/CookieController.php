<?php

use SilverStripe\Control\Cookie;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;

/**
 * CookieController class.
 * 
 * @author George Botley [<george@botley.eu>]
 * @extends PageController
 */
class CookieController extends PageController
{
	/**
	 * allowed_actions
	 * 
	 * The permitted actions on a URL or form submission.
	 *
	 * @var Array
	 * @access private
	 * @static
	 */
	private static $allowed_actions = [
		'index',
		'optin',
		'optout',
		'settings',
		'CookiePreferencesForm',
		'updateCookiePreferencesOptOut',
		'updateCookiePreferences'
	];
		
	/**
	 * optin function.
	 * 
	 * The user has opted into cookie use. Set all cookie types to Yes.
	 *
	 * @access public
	 * @return void
	 */
	public function optin() {
		Cookie::set("Cookie_StrictlyNecessary", "Yes", $expiry = 30);
		Cookie::set("Cookie_PerformanceTracking", "Yes", $expiry = 30);
		Cookie::set("Cookie_TargetingAdvertising", "Yes", $expiry = 30);
		return $this->redirect("/");
	}	
	
	/**
	 * optout function.
	 * 
	 * The user has opted out of cookie use. Unset all cookies and sessions stored.
	 *
	 * @access public
	 * @return void
	 */
	public function optout() {
		Cookie::force_expiry("Cookie_StrictlyNecessary");
		Cookie::force_expiry("Cookie_PerformanceTracking");
		Cookie::force_expiry("Cookie_TargetingAdvertising");
		$this->getRequest()->getSession()->clearAll();
		return $this->redirect("/?CookieOptOut=Yes");
	}
	
	/**
	 * settings function.
	 * 
	 * Allow user to specify their cooking preferences.
	 *
	 * @access public
	 * @return void
	 */
	public function settings() {
	    return $this->customise([
			'Title' => 'Cookie Preferences'
	    ])->renderwith([
	    	'CookiePreferences', 'Page'
	    ]);
	}

	/**
	 * cookieStatus function.
	 * 
	 * Return Boolean based on whether a selected cookie type was agreed to or not by the user.
	 *
	 * @access public
	 * @var String $type The cookie type to check status of. (Options: Cookie_StrictlyNecessary, Cookie_PerformanceTracking, Cookie_TargetingAdvertising).
	 * @return Boolean
	 */
	public static function cookieStatus($type=null) {
		
		//If type not set, default to Strictly Neccessary Cookies.
		if(!$type) {
			$type = "Cookie_StrictlyNecessary";
		}
		return (Cookie::get($type)) ? true : false;
	}	
	
	/**
	 * cookieStatus function.
	 * 
	 * Return if cookies were opted out of or not by the end user.
	 *
	 * @access public
	 * @return Boolean
	 */
    public static function CookiesOptedOut() {    
		//Get the SilverStripe HTTP Request & Sessions
	    return ($getVar==="Yes") ? true : false;  
    }
    
    
    /**
     * CookiePreferencesForm function.
     *
     * Return a form allowing users to specify their cookie preferences.
     * 
     * @access public
     * @return void
     */
    public function CookiePreferencesForm() {
    
		$form = Form::create(
			$this,
			"CookiePreferencesForm",
			$fields = FieldList::create(
				CheckboxField::create("Cookie_StrictlyNecessary", "Strictly Necessary")->setDisabled(true)->setValue(true),
				CheckboxField::create("Cookie_PerformanceTracking", "Performance / Tracking")->setValue($this->cookieStatus('Cookie_PerformanceTracking')),
				CheckboxField::create("Cookie_TargetingAdvertising", "Targeting / Advertising")->setValue($this->cookieStatus('Cookie_TargetingAdvertising'))
			),
			FieldList::create(
				FormAction::create(
					"updateCookiePreferencesOptOut",
					"Opt Out Completely"
				)
				->addExtraClass("btn-outline-info btn-right-margin btn-cookie-optout")
				->setUseButtonTag(true),
				FormAction::create(
					"updateCookiePreferences",
					"Save"
				)
				->addExtraClass("btn-success btn-cookie-save")
				->setUseButtonTag(true)
			),
			new RequiredFields([])
		);
		
		return $form;
	    
    }
    
    
    /**
     * updateCookiePreferences function.
	 * 
	 * Take the users preference and save/remove the respective preference cookie.
	 *
	 * @access public
	 * @param mixed $data Typically an Array / Object of submitted form field values. i.e. $data['fieldname']
	 * @param mixed $form The form object iself
	 * @return void
     */
    public function updateCookiePreferences($data, $form) {
		
		//Always set the Cookie_StrictlyNecessary as it's required.
		Cookie::set("Cookie_StrictlyNecessary", "Yes", $expiry = 30);
		
		//Set the Cookie_PerformanceTracking based on preference
		if(isset($data["Cookie_PerformanceTracking"])) {
			Cookie::set("Cookie_PerformanceTracking", "Yes", $expiry = 30);	
		} else {
			Cookie::force_expiry("Cookie_PerformanceTracking");
		}
		
		//Set the Cookie_PerformanceTracking based on preference
		if(isset($data["Cookie_TargetingAdvertising"])) {
			Cookie::set("Cookie_TargetingAdvertising", "Yes", $expiry = 30);	
		} else {
			Cookie::force_expiry("Cookie_TargetingAdvertising");
		}
		
		//Set success message on the form and redirect back to it
		$form->sessionMessage('Your preferences have been updated.', 'good');
		return $this->redirectBack();
	    
    }
    
    /**
     * updateCookiePreferencesOptOut function.
	 * 
	 * Redirect the user to the opt out method.
	 *
	 * @access public
	 * @param mixed $data Typically an Array / Object of submitted form field values. i.e. $data['fieldname']
	 * @param mixed $form The form object iself
	 * @return void
     */
    public function updateCookiePreferencesOptOut($data, $form) {
		$this->redirect("/cookies/optout");
    }
    
    public function URLSegment() {
	    return "cookie/settings";
    }
	
}