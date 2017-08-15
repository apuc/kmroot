<?php
namespace Kinomania\Original\Auth\Social;

use Kinomania\System\Common\TError;

/**
 * Class Ok
 * @package Kinomania\Original\Auth\Social
 */
class Ok extends Social
{
    use TError;

    /**
     * Fb constructor.
     */
    public function __construct()
    {
        $this->clientId = 0;
        $this->clientSecret = '';
        $this->redirectUri = 'http://kinomania.ru/social_login/ok';
    }

    /**
     * @return string
     */
    public function getAuthLink()
    {
        return 'http://www.odnoklassniki.ru/oauth/authorize' . '?' . urldecode(http_build_query([
            'client_id'     => $this->clientId,
            'response_type' => 'code',
            'redirect_uri'  => $this->redirectUri
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
                'code' => $_GET['code'],
                'redirect_uri' => $this->redirectUri,
                'grant_type' => 'authorization_code',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret
            );
            $tokenInfo = $this->post('http://api.odnoklassniki.ru/oauth/token.do', $params);
            if (isset($tokenInfo['access_token']) && isset($this->publicKey)) {
                $sign = md5("application_key={$this->publicKey}format=jsonmethod=users.getCurrentUser" . md5("{$tokenInfo['access_token']}{$this->clientSecret}"));
                $params = array(
                    'method'          => 'users.getCurrentUser',
                    'access_token'    => $tokenInfo['access_token'],
                    'application_key' => $this->publicKey,
                    'format'          => 'json',
                    'sig'             => $sign
                );
                $userInfo = $this->get('http://api.odnoklassniki.ru/fb.do', $params);
                if (isset($userInfo['uid'])) {
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