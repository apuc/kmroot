<?php
namespace Kinomania\Original\Auth\Social;

use Kinomania\System\Common\TError;

/**
 * Class GP
 * @package Kinomania\Original\Auth\Social
 */
class GP extends Social
{
    use TError;

    /**
     * Fb constructor.
     */
    public function __construct()
    {
        $this->clientId = 0;
        $this->clientSecret = '';
        $this->redirectUri = 'http://kinomania.ru/social_login/gp';
    }

    /**
     * @return string
     */
    public function getAuthLink()
    {
        return 'https://accounts.google.com/o/oauth2/auth' . '?' . urldecode(http_build_query([
            'redirect_uri'  => $this->redirectUri,
            'response_type' => 'code',
            'client_id'     => $this->clientId,
            'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
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
                'client_secret' => $this->clientSecret,
                'redirect_uri'  => $this->redirectUri,
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code']
            );
            $tokenInfo = $this->post('https://accounts.google.com/o/oauth2/token', $params);
            if (isset($tokenInfo['access_token'])) {
                $params['access_token'] = $tokenInfo['access_token'];
                $userInfo = $this->get('https://www.googleapis.com/oauth2/v1/userinfo', $params);
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