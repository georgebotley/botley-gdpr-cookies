# [SilverStripe Module] Handle GDPR Cookie consent

A fairly simple module designed to enable the management of cookie consent within your SilverStripe driven application / website. 

## How It Works

Once installed the module provides a Bootstrap Modal on first page load asking the end-user to consent to the use of cookies for your website. The user can either say Yes, at which point they can access the site with no further hitch, click No at which point site access is refused or explicitly configure the specific cookies they wish to have set on their device. Specific cookies are broken down into three categories:

- Strictly Neccessary
- Performance / Tracking
- Targeting / Advertising

*N.B. The user simply clicking "Yes" permits the use of cookies falling within all 3 category types.*

SilverStripe template variables are made available for the purpose of checking user consent to each of these categories. It will be the responsibility of the developer to ensure that third-party services etc are only called upon where the user has consented. For example, they must have consented to tracking cookies in order for services such as Google Analytics to run their code.

Further detail is provided within the documentation.

## Requirements

- SilverStripe ^4.0
- Bootstrap Framework (see documentation for alternatives)

## Installation Instructions

### Option One - Composer (recommended)

```composer require botley/gdpr-cookies```

Follow the remainder of the implementation steps within the documentation.

### Option Two - Manual Install 

1. Upload the contents of this module within the following SilverStripe folder: vendor/botley/botley-gdpr-cookies
2. Run /dev/build?flush=1
3. Follow the remainder of the implementation steps within the documentation.


