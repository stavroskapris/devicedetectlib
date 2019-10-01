![Mobile Detect](http://demo.mobiledetect.net/logo-github.png)

> Motto: "Every business should have a detection script to detect mobile readers."

#### About

Mobile Detect is a lightweight PHP class for detecting mobile devices (including tablets).
It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.

*Why*

Your website's _content strategy_ is important! You need a complete toolkit to deliver an experience that is _optimized_, 
_fast_ and _relevant_ to your users. Mobile Detect class is a 
[server-side detection](http://www.w3.org/TR/mwabp/#bp-devcap-detection) tool that can help you with your RWD strategy, 
it is not a replacement for CSS3 media queries or other forms of client-side feature detection.

*How*

We're committed to make Mobile_Detect the best open-source mobile detection resource and this is why before 
each release we're running [unit tests](./tests) and research and update the detection rules on **monthly** basis.

*Who*

See [the history](./docs/HISTORY.md) of the project.

#### Announcements

* **JetBrains** is sponsoring the project by providing licenses for [PHPStorm](https://www.jetbrains.com/phpstorm/) and 
[DataGrip](https://www.jetbrains.com/datagrip/).
* **Mobile_Detect `2.x.x`** is only integrating new regexes, User-Agents and tests. We are focusing on **new tablets only**. 
The rest of the PRs about TVs, bots or optimizations will be closed and analyzed after `3.0.0-beta` is released.
* **Mobile_Detect `3.x.x`** is experimental and WIP.


#### Install

**Download and include manually**
> Use this to quickly test the demo.

* [Download latest release](../../tags)
* [Mobile_Detect.php](./Mobile_Detect.php)

```php
require_once "libs/Mobile_Detect.php";
```

**Install as a [composer package](https://packagist.org/packages/mobiledetect/mobiledetectlib)**
> Use this method to get continuous updates.

```
composer require mobiledetect/mobiledetectlib
```
or include the dependency in the `composer.json` file:
```json
{
    "require": {
        "mobiledetect/mobiledetectlib": "^2.8"
    }
}
```

#### Demo 

* [:iphone: Live demo!](http://demo.mobiledetect.net)
* [Code examples](../../wiki/Code-examples)

#### Contribute

*Submit a PR*
> Submit a pull request but before make sure you read [how to contribute](docs/CONTRIBUTING.md) guide.

*Donate*

|Paypal|
|------|
|[Donate :+1:](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mobiledetectlib%40gmail%2ecom&lc=US&item_name=Mobile%20Detect&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted)|


I'm currently paying for hosting and spend a lot of my family time to maintain the project and planning the future releases.
I would highly appreciate any money donations that will keep the research going.

Special thanks to the community :+1: for donations, JetBrains team for the continuous support and [Dragos Gavrila](https://twitter.com/grafician) who contributed with the logo.

#### Modules, plugins, ports
> [Submit new module, plugin, port](../../issues/new?title=New%203rd%20party%20module&body=Name,%20Link%20and%20Description%20of%20the%20module.)

:point_right: Keep `Mobile_Detect.php` class in a separate `module` and do NOT include it in your script core because of the high frequency of updates.
:point_right: When including the class into your `web application` or `module` always use `include_once '../path/to/Mobile_Detect.php` to prevent conflicts.

**JavaScript**

* mobile-detect.js - A [JavaScript port](https://github.com/hgoebl/mobile-detect.js) of Mobile-Detect class. Made by [Heinrich Goebl](https://github.com/hgoebl).

**Varnish Cache**

* [Varnish Mobile Detect](https://github.com/willemk/varnish-mobiletranslate) - Drop-in varnish solution to mobile user 
detection based on the Mobile-Detect library. Made by [willemk](https://github.com/willemk).
* [mobiledetect2vcl](https://github.com/carlosabalde/mobiledetect2vcl) - Python script to transform the Mobile 
Detect JSON database into an UA-based mobile detection VCL subroutine easily integrable in any Varnish Cache 
configuration. Made by [Carlos Abalde](https://github.com/carlosabalde).
