# Device Detection Library

#### About

Device Detect is a lightweight PHP class for detecting devices. It is based on [mobiledetect](https://github.com/serbanghita/Mobile-Detect).
It uses the User-Agent string combined with specific HTTP headers to identify devices (browser,os etc).


#### Install

As a [composer package](https://packagist.org/packages/mobiledetect/mobiledetectlib)

```
composer require devicedetect/devicedetectlib
```
or include the dependency in the `composer.json` file:
```json
{
    "require": {
        "devicedetect/devicedetectlib": "1.0"
    }
}
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