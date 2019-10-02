<?php

namespace Tests\Unit\Libraries;

use App\Device_Detect;
use Mobile_Detect;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * Class Device_DetectTest
 *
 * @package Tests\Unit\Libraries
 */
class Device_DetectTest extends MockeryTestCase
{
    /**
     * @var Mobile_Detect|Mockery\LegacyMockInterface|Mockery\MockInterface
     */
    private $mockMobile_Detect;

    /**
     * @var Device_Detect
     */
    private $deviceDetect;

    /**
     * Set private vars
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->mockMobile_Detect = Mockery::mock(Mobile_Detect::class);
        $this->deviceDetect = new Device_Detect($this->mockMobile_Detect);
    }

    /**
     * @test
     *
     * @see Device_Detect::getUserAgent()
     */
    public function getUserAgentTest()
    {
        $this->deviceDetect->setUserAgent('this is a user agent string');

        $this->assertEquals('this is a user agent string', $this->deviceDetect->getUserAgent());
    }

    /**
     * @test
     * @see Device_Detect::isMobile()
     */
    public function isMobileWithArgsTest()
    {
        $this->mockMobile_Detect->shouldReceive('isMobile')
            ->withArgs(['this is a user agent string'])
            ->once()
            ->andReturn(true)
            ->getMock();
        $response = $this->deviceDetect->isMobile('this is a user agent string');
        $this->assertIsBool($response);
        $this->assertTrue($response);
    }

    /**
     * @test
     * @see Device_Detect::isMobile()
     */
    public function isMobileNoArgsTest()
    {
        $this->mockMobile_Detect->shouldReceive('isMobile')
            ->withArgs([$this->deviceDetect->getUserAgent()])
            ->once()
            ->andReturn(true)
            ->getMock();

        $response = $this->deviceDetect->isMobile();
        $this->assertIsBool($response);
        $this->assertTrue($response);
    }

    /**
     * @test
     * @see Device_Detect::getDeviceType()
     */
    public function getDeskTopDeviceTypeTest()
    {
        $userAgentDesktop = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0';

        $this->mockMobile_Detect->shouldReceive('isMobile')
            ->withArgs([$userAgentDesktop])
            ->once()
            ->andReturn(false)
            ->getMock()
            ->shouldReceive('isTablet')
            ->withArgs([$userAgentDesktop])
            ->once()
            ->andReturn(false)
            ->getMock();

        $response = $this->deviceDetect->getDeviceType($userAgentDesktop);
        $this->assertIsString($response);
        $this->assertEquals('desktop', $response);
    }

    /**
     * @test
     * @see Device_Detect::getDeviceType()
     */
    public function getMobileDeviceTypeTest()
    {
        $userAgentMobile = 'Mozilla/5.0 (Linux; Android 8.0.0; Nexus 5X Build/OPR4.170623.006) AppleWebKit/537.36 (KHTML, like Gecko) 
                            Chrome/67.0.3396.87 Mobile Safari/537.36';

        $this->mockMobile_Detect->shouldReceive('isMobile')
            ->withArgs([$userAgentMobile])
            ->once()
            ->andReturn(true)
            ->getMock()
            ->shouldReceive('isTablet')
            ->withArgs([$userAgentMobile])
            ->once()
            ->andReturn(false)
            ->getMock();
        $response = $this->deviceDetect->getDeviceType($userAgentMobile);
        $this->assertIsString($response);
        $this->assertEquals('mobile', $response);
    }

    /**
     * @test
     * @see Device_Detect::getDeviceType()
     */
    public function getTabletDeviceTypeTest()
    {
        $userAgentTablet = 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 10 Build/MOB31T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36';

        $this->mockMobile_Detect->shouldReceive('isMobile')
            ->withArgs([$userAgentTablet])
            ->once()
            ->andReturn(false)
            ->getMock()
            ->shouldReceive('isTablet')
            ->withArgs([$userAgentTablet])
            ->twice()
            ->andReturn(true)
            ->getMock();

        $response = $this->deviceDetect->getDeviceType($userAgentTablet);
        $this->assertIsString($response);
        $this->assertEquals('tablet', $response);
    }

    /**
     * @test
     * @see Device_Detect::getDeviceType()
     */
    public function getDeviceTypeNoArgsTest()
    {
        $this->mockMobile_Detect->shouldReceive('isMobile')
            ->withArgs([$this->deviceDetect->getUserAgent()])
            ->once()
            ->andReturn(false)
            ->getMock()
            ->shouldReceive('isTablet')
            ->withArgs([$this->deviceDetect->getUserAgent()])
            ->twice()
            ->andReturn(true)
            ->getMock();

        $response = $this->deviceDetect->getDeviceType();
        $this->assertIsString($response);
        $this->assertEquals('tablet', $response);
    }

    /**
     * @test
     * @see Device_Detect::isMobile()
     */
    public function isTabletWithArgsTest()
    {
        $this->mockMobile_Detect->shouldReceive('isTablet')
            ->withArgs(['this is a user agent string'])
            ->once()
            ->andReturn(true)
            ->getMock();
        $response = $this->deviceDetect->isTablet('this is a user agent string');
        $this->assertIsBool($response);
        $this->assertTrue($response);
    }

    /**
     * @test
     * @see Device_Detect::isTablet()
     */
    public function isTabletNoArgsTest()
    {
        $this->mockMobile_Detect->shouldReceive('isTablet')
            ->withArgs([$this->deviceDetect->getUserAgent()])
            ->once()
            ->andReturn(true)
            ->getMock();
        $response = $this->deviceDetect->isTablet();
        $this->assertIsBool($response);
        $this->assertTrue($response);
    }

    /**
     * @test
     * @see Device_Detect::isComputer()
     */
    public function isComputerWithArgsTest()
    {
        $this->mockMobile_Detect->shouldReceive('isMobile')
            ->withArgs(['this is a user agent string'])
            ->once()
            ->andReturn(false)
            ->getMock()
            ->shouldReceive('isTablet')
            ->withArgs(['this is a user agent string'])
            ->once()
            ->andReturn(false)
            ->getMock();
        $response = $this->deviceDetect->isComputer('this is a user agent string');
        $this->assertIsBool($response);
        $this->assertTrue($response);
    }

    /**
     * @test
     * @see Device_Detect::isComputer()
     */
    public function isComputerNoArgsTest()
    {
        $this->mockMobile_Detect->shouldReceive('isMobile')
            ->withArgs([$this->deviceDetect->getUserAgent()])
            ->once()
            ->andReturn(false)
            ->getMock()
            ->shouldReceive('isTablet')
            ->withArgs([$this->deviceDetect->getUserAgent()])
            ->once()
            ->andReturn(false)
            ->getMock();

        $response = $this->deviceDetect->isComputer();
        $this->assertIsBool($response);
        $this->assertTrue($response);
    }

    /**
     * @test
     * @see Device_Detect::isIpad()
     */
    public function isIpadTest()
    {
        $this->mockMobile_Detect->shouldReceive('is')
            ->withArgs(['Ipad'])
            ->once()
            ->andReturn(true)
            ->getMock();
        $response = $this->deviceDetect->isIpad();
        $this->assertIsBool($response);
        $this->assertTrue($response);
    }

    /**
     * @test
     * @see Device_Detect::isIphone()
     */
    public function isIphoneTest()
    {
        $this->mockMobile_Detect->shouldReceive('is')
            ->withArgs(['iphone'])
            ->once()
            ->andReturn(true)
            ->getMock();
        $response = $this->deviceDetect->isIphone();
        $this->assertIsBool($response);
        $this->assertTrue($response);
    }

    /**
     * @test
     * @see Device_Detect::isAndroid()
     */
    public function isAndroidTest()
    {
        $this->mockMobile_Detect->shouldReceive('isAndroidOS')
            ->withNoArgs()
            ->once()
            ->andReturn(true)
            ->getMock();

        $response = $this->deviceDetect->isAndroid();
        $this->assertIsBool($response);
        $this->assertTrue($response);
    }
}
