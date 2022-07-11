<?php

namespace MrGabriCavi\LaravelGoogleTokenGuard\Security\Guard;


use Google_Client;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class LaravelGoogleTokenGuard implements Guard
{
    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var UserProvider $provider
     */
    protected $provider;

    /**
     * @var Request $request
     */
    protected $request;

    /**
     * @var null|Authenticatable
     */
    protected $user;

    /**
     * Create a new authentication guard for Google Token.
     *
     * @param UserProvider $provider
     * @param string $name
     * @param Request $request
     * @return void
     */
    public function __construct(UserProvider $provider, string $name, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
        $this->name = $name;
    }

    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    public function check()
    {
        return ! is_null($this->user());
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return UserProvider
     */
    public function getProvider(): UserProvider
    {
        return $this->provider;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return Authenticatable|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Check if user is guest (not trusted).
     *
     * @return bool
     */
    public function guest()
    {
        return ! $this->check();
    }

    /**
     * @return Authenticatable|void|null
     */
    public function user()
    {
        if (is_null($this->getUser())) {
            $client = new Google_Client();
            $client->setClientId("356181642750-4vml7pmn7rk0qmlcjk646fss5c8t3uif.apps.googleusercontent.com");
            $payload = $client->verifyIdToken($this->getRequest()->bearerToken());
            if ($payload) {
                dd($payload);
                $userid = $payload['sub'];
                // If request specified a G Suite domain:
                //$domain = $payload['hd'];
            } else {
                // Invalid ID token
            }
        }
        if (!is_null($this->getUser())) {
            return $this->getUser();
        }
    }

    /**
     * Return the identifier
     *
     * @return int|mixed|string|null
     */
    public function id()
    {

        if (!empty($this->user())) {
            return $this->user()->getAuthIdentifier();
        }
    }

    /**
     * This kind of guard cannot validate user, must receive a
     * valid Google token from Authorization header.
     *
     * @param array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        return false;
    }

    /**
     * @return bool
     */
    public function hasUser()
    {
        return ! is_null($this->user);
    }

    /**
     * @param Authenticatable $user
     * @return $this|void
     */
    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
        return $this;
    }
}
