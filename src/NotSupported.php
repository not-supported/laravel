<?php


namespace NotSupported\Laravel;


use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Str;

class NotSupported
{
    public function isSupported()
    {
        [$browser, $version] = $this->getBrowserAndMajorVersion();

        $browser           = strtolower($browser);
        $supportedVersions = config('not-supported.browsers.' . $browser);

        if (Str::startsWith($supportedVersions, '>=')) {
            $configVersion = (int) Str::replaceFirst('>=', '', $supportedVersions);

            return $version >= $configVersion;
        } elseif (Str::startsWith($supportedVersions, '>')) {
            $configVersion = (int) Str::replaceFirst('>', '', $supportedVersions);

            return $version > $configVersion;
        } elseif (Str::contains($supportedVersions, ',')) {
            $supportedVersions = array_map('intval', explode(',', $supportedVersions));

            return in_array($version, $supportedVersions);
        } else {

        }

        return false;
    }

    public function url()
    {
        if (config('not-supported.referrer') === true) {
            return $this->baseUrl() . $this->referrerQueryString();
        }

        return $this->baseUrl();
    }

    public function referrerQueryString()
    {
        $url = config('not-supported.custom_referrer', $this->requestFullUrl());

        return '/?referrer=' . urlencode($url);
    }

    public function baseUrl()
    {
        return 'https://notsupported.app';
    }

    public function requestFullUrl()
    {
        return request()->fullUrl();
    }

    public function getBrowserAndMajorVersion()
    {
        $result = (new Browser)->detect();

        return [
            $result->browserFamily(),
            (int) $result->browserVersionMajor(),
        ];
    }
}