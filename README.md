# Device Detection Library

#### About

Device Detect is a lightweight PHP class for detecting devices.It based on [mobiledetect](https://github.com/serbanghita/Mobile-Detect).
It uses the User-Agent string combined with specific HTTP headers to identify devices(browser,os etc).


#### Install

**Download and include manually**


* [Download latest release](../../tags)
* [Mobile_Detect.php](./Mobile_Detect.php)

```php
require_once "libs/Mobile_Detect.php";
```

**Install as a [composer package](https://packagist.org/packages/mobiledetect/mobiledetectlib)**
> Use this method to get continuous updates.

```
composer require devicedetect/devicedetectlib
```
or include the dependency in the `composer.json` file:
```json
{
    "require": {
        "devicedetect/devicedetectlib": "^2.8"
    }
}
```

#### Code example
>  Inject library into your code.Use as needed.
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