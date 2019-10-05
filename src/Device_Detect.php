<?php

namespace App;

use Mobile_Detect;

/**
 * Class Device_Detect
 *
 * @package App
 */
class Device_Detect
{
    /**
     * The User-Agent HTTP header is stored in here.
     *
     * @var string
     */
    protected $userAgent = null;

    /**
     * @var Mobile_Detect
     */
    protected $mobileDetect;

    /**
     * @var boolean
     */
    protected $isMobile;

    /**
     * List of Operating Systems.
     *
     * @var array
     */
    protected static $operatingSystems = [
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/cros/i' => 'Chrome OS',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/BB/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    ];

    /**
     * List of Browsers
     *
     * @var array
     */
    protected static $browsers = [
        '/msie/i' => 'Internet Explorer',
        '/trident/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/opr/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/Skyfire/i' => 'Skyfire',
        //mobile browsers
        '/Version.*Mobile.*Safari|Safari.*Mobile|MobileSafari/i' => 'Safari',
        '/bCrMo|CriOS|Android.*Chrome|Mobile.*Chrome/i' => 'Chrome',
        '/Opera.*Mini|Opera.*Mobi|Android.*Opera|Mobile.*OPR/i' => 'Opera',
        '/Mobile SafariEdge/i' => 'Edge',
        '/IEMobile|MSIEMobile/i' => 'Internet Explorer',
        '/fennec|firefox.*maemo|(Mobile|Tablet).*Firefox|Firefox.*Mobile|FxiOS/i' => 'Firefox',
    ];

    /**
     * Device types
     *
     * @var array
     */
    protected static $deviceTypes = ['mobile', 'tablet', 'desktop'];

    /**
     * Device_Detect constructor.
     *
     * @param Mobile_Detect $mobileDetect
     * @param string $userAgent Inject the User-Agent header. If null, will use HTTP_USER_AGENT
     *                          from the $_SERVER array instead.
     */
    public function __construct(Mobile_Detect $mobileDetect, $userAgent = null)
    {
        $this->setUserAgent($userAgent);
        $this->mobileDetect = $mobileDetect;
    }

    /**
     * Set the User-Agent to be used.
     *
     * @param string $userAgent
     * @return void
     */
    public function setUserAgent($userAgent = null): void
    {
        if (!empty($userAgent)) {
            $this->userAgent = $this->prepareUserAgent($userAgent);
        } else {
            $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
            $this->userAgent = $this->prepareUserAgent($userAgent);
        }
    }

    /**
     * Retrieve the User-Agent.
     *
     * @return string|null The user agent if it's set.
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    /**
     * Prepare user agent string
     *
     * @param string $userAgent
     * @return string
     */
    private function prepareUserAgent($userAgent): string
    {
        $userAgent = trim($userAgent);
        $userAgent = substr($userAgent, 0, 500);

        return $userAgent;
    }

    /**
     * Retrieve the list of known browsers.
     *
     * @return array
     */
    public function getBrowsers(): array
    {
        return self::$browsers;
    }

    /**
     * Retrieve the list of operating systems.
     *
     * @return array
     */
    public function getOperatingSystems(): array
    {
        return self::$operatingSystems;
    }

    /**
     * Retrieve the list of device types.
     *
     * @return array
     */
    public function getDeviceTypes(): array
    {
        return self::$deviceTypes;
    }

    /**
     * Get device type
     *
     * @param null $userAgent
     * @return string
     */
    public function getDeviceType($userAgent = null): string
    {
        if ($this->isComputer($userAgent)) {
            return 'desktop';
        } elseif ($this->isTablet($userAgent)) {
            return 'tablet';
        } else {
            return 'mobile';
        }
    }

    /**
     * Get device browser
     *
     * @return string
     */
    public function getBrowser(): string
    {
        $browser = "Unknown Browser";
        $browser_array = $this->getBrowsers();
        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $this->userAgent)) {
                $browser = $value;
            }
        }

        return $browser;
    }

    /**
     * Get device OS Platform
     *
     * @return string
     */
    public function getOperatingSystem(): string
    {
        $os_platform = "Unknown OS Platform";
        $os_array = $this->getOperatingSystems();
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $this->userAgent)) {
                $os_platform = $value;
            }
        }

        return $os_platform;
    }

    /**
     * Mobile device detection
     *
     * @param null $userAgent
     * @return bool
     */
    public function isMobile($userAgent = null): bool
    {
        return $this->mobileDetect->isMobile($userAgent);
    }

    /**
     * Tablet detection
     *
     * @param null $userAgent
     * @return bool
     */
    public function isTablet($userAgent = null): bool
    {
        return $this->mobileDetect->isTablet($userAgent);
    }

    /**
     * Computer detection
     * Since it is not a mobile device, probably
     * it is safe to assume that the device is computer
     *
     * @param null $userAgent
     * @return bool
     */
    public function isComputer($userAgent = null): bool
    {
        return (!$this->mobileDetect->isMobile($userAgent) && !$this->mobileDetect->isTablet($userAgent));
    }

    /**
     * Ipad detection
     *
     * @return bool
     */
    public function isIpad(): bool
    {
        return $this->mobileDetect->is('Ipad');
    }

    /**
     * Iphone detection
     *
     * @return bool
     */
    public function isIphone(): bool
    {
        return $this->mobileDetect->is('iphone');
    }

    /**
     * Android Os detection
     *
     * @return bool
     */
    public function isAndroid(): bool
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->mobileDetect->isAndroidOS();
    }

    /**
     * Get version of os, browser etc
     *
     * @param string $key
     * @return float|string
     */
    public function getVersion(string $key)
    {
        return $this->mobileDetect->version($key);
    }
}
