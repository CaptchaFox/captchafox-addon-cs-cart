<?php
namespace Tygh\Addons\CaptchaFox;

use Tygh\Http;
use Tygh\Web\Antibot\IAntibotDriver;
use Tygh\Web\Antibot\IErrorableAntibotDriver;

/**
 * CaptchaFoxDriver
 */
class CaptchaFoxDriver implements IAntibotDriver, IErrorableAntibotDriver
{
    const TOKEN_PARAM = 'cf-captcha-response';

    /**
     * @var array Addon settings
     */
    protected $settings;

    
    /**
     * __construct
     *
     * @param array $addon_settings
     * @return void
     */
    public function __construct(array $addon_settings)
    {
        $this->settings = $addon_settings;
    }
    
    /**
     * Check if isSetUp
     *
     * @return boolean
     */
    public function isSetUp()
    {
        return $this->checkSettings();
    }
    
    /**
     * validateHttpRequest
     *
     * @param  mixed $http_request_data
     * @return boolean
     */
    public function validateHttpRequest(array $http_request_data)
    {
        if (!isset($http_request_data[static::TOKEN_PARAM])) {
            return false;
        }

        if (isset($http_request_data[static::TOKEN_PARAM])) {
            $token = $http_request_data[static::TOKEN_PARAM];
            $response = Http::post('https://api.captchafox.com/siteverify', array(
                'secret' => $this->settings['secret_key'],
                'response' => $token,
            ));
            $response = @json_decode($response, true);
        
            if (!empty($response) && !empty($response['success'])) {
                return true;
            }
        }

        return false;
    }
    
    /**
     * getErrorMessage
     *
     * @param  mixed $scenario
     * @return string
     */
    public function getErrorMessage($scenario)
    {
        return __('captchafox.error_verification_failed');
    }
    
    /**
     * checkSettings
     *
     * @return boolean
     */
    private function checkSettings()
    {
        $required_settings = [
            'site_key',
            'secret_key',
        ];

        foreach ($required_settings as $setting) {
            if ($this->settings[$setting] === '') {
                return false;
            }
        }

        return true;
    }
}
