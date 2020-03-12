# Documentation

This documentation covers how to use and configure the GDPR cookie consent module. 

In it, we cover:

- [Installation](#installation)
- [Configuration](#configuration)

## Installation

Initial installation is a two-step process. Once installed you will need then need to check for user-consent prior to setting any cookies, see the [Configuration](#configuration) section for that.

### Step One - Initial Installation

Initial installation instructions can be found on the [main repo page](https://github.com/torindul/botley-gdpr-cookies#installation-instructions).

### Step Two - Include the cookie consent modal

In order for this module to do its thing, you will need to place a SilverStripe template include snippet above the closing body tag of all page templates which require the cookie check. Note that for your average run of the mill SilverStripe website this will only apply to the Page.ss file at the top level of a theme. Consult your developer if you're unsure of which templates this applies to. 

The snippet is as follows:

```
<% include GDPR_Modal.ss %>
```

## Configuration

This module defines what are called *TemplateGlobalProviders* to the SilverStripe framework. This means that the module can operate in a somewhat scope-less fashion and can be called in .ss templates throughout your website / application. The methods are also static and so you can check for cookie consent within any custom controller too! Check the appropriate section below for more info.

### .ss Templates

The following template variables are available for use in if statements. Using these will then allow you to only include any cookie-setting code that has been given consent. A common example here will be Google Analytics which is considered Performance / Tracking by this module. 

| Template Variable           | Description |
|-----------------------------|-------------|
| Cookie_StrictlyNecessary    | Strictly necessary cookies for your website or application. |
| Cookie_PerformanceTracking  | Cookies commonly used by third-party services, like Google Analytics. |
| Cookie_TargetingAdvertising | Cookies that might be used by retargeting advert providers, or Google Adsense / Adwords etc. |

As an example, you might place this within the <head> tag of your site for the inclusion of Google Analytics as follows:

```
<head>

	<% if Cookie_PerformanceTracking %>
		<script type="text/javascript" src="https://www.google-analytics.com/analytics.js?ga=code"></script>	
	<% end_if %> 

</head>
```

The use cases of course can be bespoke to your own application. Not all websites or applications will use all cookie types either. 

### PHP Controllers

To check for cookie consent in a SilverStripe Controller you can call the static cookieStatus method on CookieController, passing it the type of consent to check.

The method parameters match the template variables in the [.ss templates section](#ss-templates) above.

Here's an example of checking for performance / tracking cookie consent within a Controller method.

```
<?php

	public function myMethod() {
	
		//Check for cookie consent
		if(CookieController::cookieStatus("Cookie_PerformanceTracking")) {
			//DO SOME MAGIC HERE
		}
		
	}

?>
```

The cookieStatus method returns a Boolean.