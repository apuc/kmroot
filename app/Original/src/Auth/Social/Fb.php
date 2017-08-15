<?php
namespace Kinomania\Original\Auth\Social;

use Kinomania\System\Common\TError;

/**
 * Class Fb
 * @package Kinomania\Original\Auth\Social
 */
class Fb extends Social
{
    use TError;

    /**
     * Fb constructor.
     */
    public function __construct()
    {
        $this->clientId = 164790803722093;
        $this->clientSecret = '348d81a7224a519131da3433f1ac4c64';
        $this->redirectUri = 'http://kinomania.ru/social_login/facebook';
    }

    /**
     * @return string
     */
    public function getAuthLink()
    {
        return 'https://www.facebook.com/dialog/oauth' . '?' . urldecode(http_build_query([
            'client_id'     => $this->clientId,
            'redirect_uri'  => $this->redirectUri,
            'response_type' => 'code',
            'scope'         => 'email'
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
                'client_id'     => $this->clientId,
                'redirect_uri'  => $this->redirectUri,
                'client_secret' => $this->clientSecret,
                'code'          => $_GET['code']
            );
            parse_str($this->get('https://graph.facebook.com/oauth/access_token', $params, false), $tokenInfo);
            if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
                $params = array('access_token' => $tokenInfo['access_token']);
                $userInfo = $this->get('https://graph.facebook.com/me', $params);
                if (isset($userInfo['id'])) {
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