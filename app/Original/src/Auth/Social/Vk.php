<?php
namespace Kinomania\Original\Auth\Social;
use Kinomania\System\Common\TError;

/**
 * Class Vk
 * @package Kinomania\Original\Auth\Social
 */
class Vk extends Social
{
    use TError;

    /**
     * Vk constructor.
     */
    public function __construct()
    {
        $this->clientId = 2142664;
        $this->clientSecret = 'HNC35rJWv0HC4NFiqUgR';
        $this->redirectUri = 'http://kinomania.ru/social_login/vkontakte';
    }

    /**
     * @return string
     */
    public function getAuthLink()
    {
        return 'http://oauth.vk.com/authorize' . '?' . urldecode(http_build_query([   
            'client_id'     => $this->clientId,
            'scope'         => 'notify',
            'redirect_uri'  => $this->redirectUri,
            'response_type' => 'code'
        ]));
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        $this->error = true;
        $userInfo = [];

        if (isset($_GET['code'])) {
            $params = array(
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'code' => $_GET['code'],
                'redirect_uri' => $this->redirectUri
            );
            $tokenInfo = $this->get('https://oauth.vk.com/access_token', $params);
            if (isset($tokenInfo['access_token'])) {
                $params = array(
                    'uids'         => $tokenInfo['user_id'],
                    'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
                    'access_token' => $tokenInfo['access_token']
                );
                $userInfo = $this->get('https://api.vk.com/method/users.get', $params);
                if (isset($userInfo['response'][0]['uid'])) {
                    $userInfo = $userInfo['response'][0];
                    if (isset($userInfo['email']) && !empty($userInfo['email'])) {
                        $this->error = false;
                    }
                }
            }
        }
        
        return $userInfo;
    }

    private $clientId;
    private $clientSecret;
    private $redirectUri;
}