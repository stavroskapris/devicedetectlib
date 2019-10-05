# Device Detection Library

#### About

Device Detect is a lightweight PHP class for detecting devices. It is based on [mobiledetect](https://github.com/serbanghita/Mobile-Detect)
library. It uses the User-Agent string combined with specific HTTP headers to identify devices (browser, os etc).


#### Install

As a [composer package](https://packagist.org/packages/devicedetect/devicedetectionlib)

```
composer require devicedetect/devicedetectionlib
```
or include the dependency in the `composer.json` file:
```json
{
    "require": {
        "devicedetect/devicedetectionlib": "1.0.*"
    }
}
```
#### Usage
```php
<?php
/**
  * Retrieve the User-Agent.
  * @method getUserAgent()
  * @return string|null The user agent if it's set.
 */

/**
  * Retrieve the list of known browsers.
  * @method getBrowsers()
  * @return array
 */

/**
  * Retrieve the list of operating systems.
  * @method getOperatingSystems()
  * @return array
 */

/**
  * Retrieve the list of device types.
  * @method getDeviceTypes()
  * @return array
 */

/**
  * Get device type.
  * @method getDeviceType($userAgent = null)
  * @param null $userAgent
  * @return string
 */

/**
  * Get device browser.
  * @method getBrowser()
  * @return string
 */

/**
  * Retrieve the User-Agent.
  * @method getOperatingSystem()
  * @return string
 */

/**
  * Mobile device detection.
  * @method isMobile($userAgent = null)
  * @param null $userAgent
  * @return bool
 */

/**
  * Tablet detection.
  * @method isTablet($userAgent = null)
  * @param null $userAgent
  * @return bool
 */

/**
  * Computer detection
  * @method isComputer($userAgent = null)
  * @param null $userAgent
  * @return bool
 */

/**
  * Ipad detection
  * @method isIpad()
  * @return bool
 */

/**
  * Iphone detection
  * @method isIphone()
  * @return bool
 */

/**
  * Android Os detection
  * @method isAndroid()
  * @return bool
 */

/**
  * Get version of os, browser etc
  * @method getVersion(string $key)
  * @param string $key
  * @return float|string
 */


```
#### Code example
>  Inject library into your code. Use as needed.
```php
<?php

namespace App\Http\Controllers;

use App\Device_Detect;

/**
 * Class DeviceDetectionController
 *
 * @package App\Http\Controllers
 */
class DeviceDetectionController extends Controller
{
    /**
     * @var Device_Detect
     */
    private $deviceDetect;

    /**
     * DeviceDetectionController constructor.
     *
     * @param $deviceDetect
     */
    public function __construct(Device_Detect $deviceDetect)
    {
        $this->deviceDetect = $deviceDetect;
    }
    
    /**
     * Device Detection
     */
    public function detect()
    {
        print_r($this->deviceDetect->getBrowser());
        echo "\n";
        print_r($this->deviceDetect->getOperatingSystem());
        echo "\n";
        print_r($this->deviceDetect->getDeviceType());
     }
}
```
