# Documentation

## Installation

### Step One - Initial Installation

Initial installation instructions can be found on the [main repo page](https://github.com/torindul/botley-gdpr-cookies#installation-instructions).

### Step Two - Configure Cookie Consent Modal

In order for this module to do its thing, you will need to place a SilverStripe template include snippet above the closing body tag of all page templates which require the cookie check. Note that for your average run of the mill SilverStripe website this will only apply to the Page.ss file at the top level of a theme. Consult your developer if you're unsure of which templates this applies to. 

The snippet is as follows:

```
<% include GDPR_Modal.ss %>
```