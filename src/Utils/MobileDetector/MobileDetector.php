<?php
declare(strict_types=1);

namespace Jednicky\Utils;

use Nette\Http\IRequest;
use Nette\InvalidArgumentException;
use Nette\SmartObject;
use Nette\Utils\Strings;

/**
 * Description of MobileDetector
 *
 * @author Tomas Grasl <grasl.t@centrum.cz>
 */
class MobileDetector
{
    use SmartObject;

    /**
     * @var IRequest
     */
    private $httpRequest;

    /**
     * @var array<string, string>
     */
    protected $mobileHeaders = array(
        "android"       => "android",
        "blackberry"    => "blackberry",
        "iphone"        => "(iphone|ipod)",
        "opera"         => "opera mini",
        "palm"          => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)",
        "windows"       => "windows ce; (iemobile|ppc|smartphone)",
        "generic"       => "(kindle|mobile|mmp|midp|o2|pda|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap)"
    );

    /**
     * @var array<string, string>
     */
    private $wapTypes = array(
        "text" => "text/vnd.wap.wml",
        "app" => "application/vnd.wap.xhtml+xml"
    );

    public function __construct(IRequest $httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    public function getRequest() : IRequest
    {
        return $this->httpRequest;
    }

    public function isMobile() : bool
    {
        $request = $this->getRequest();
        if ($request->getHeader("x-wap-profile") || $request->getHeader("profile")) {
            return true;
        }
        $accept = $request->getHeader("accept");
        if($accept) {
            foreach ($this->wapTypes as $type) {
                if (strpos($accept, $type) !== False) {
                    return true;
                }
            }
        }

        $header = (string)$this->getRequest()->getHeader("user-agent");

        foreach (array_keys($this->mobileHeaders) as $device) {
            if ($this->isMobileDevice($device, $header)) {
                return true;
            }
        }
        return false;
    }

    public function isMobileUserAgent(string $ua): bool
    {
        foreach (array_keys($this->mobileHeaders) as $device) {
            if ($this->isMobileDevice($device, $ua)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Is user agent given device (Android, iPhone, ...)?
     */
    public function isMobileDevice(?string $device, string $header) : bool
    {
        if (!isset($this->mobileHeaders[$device])) {
            throw new InvalidArgumentException("Device '$device' not supported.");
        } else {
            return (bool) Strings::match($header, "~{$this->mobileHeaders[$device]}~i");
        }
    }

    public function isRobot(string $ua): bool
    {
        return (bool)preg_match('/bot|crawl|slurp|spider|mediapartner|babbar|facebook|sogou|yandex|opensiteexplorer|seekport|semrush|BLEXBot|webmeup|Mb2345Browser|LieBaoFast|zh-CN|MicroMessenger|zh_CN|Kinza|MQQBrowser/i', $ua);
    }

    public function robotDetected() : bool
    {
        $header = $this->getRequest()->getHeader("user-agent");
        return isset($header) && $this->isRobot($header);
    }
}
