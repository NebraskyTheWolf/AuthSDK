<?php

namespace Fluffici\SDK;

use Fluffici\SDK\Auth\Authorize;

class AuthSDK
{
    private string $grantType = '';
    private string $clientId = '';
    private string $clientSecret = '';
    private string $redirectUri = '';
    private string $scope = '';
    private string $state = '';

    /**
     * Returns the grant type.
     *
     * @return string The grant type value.
     */
    public function getGrantType(): string
    {
        return $this->grantType;
    }

    /**
     * Returns the redirect URI.
     *
     * @return string The redirect URI value.
     */
    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    /**
     * Returns the client ID.
     *
     * @return string The client ID value.
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * Returns the client secret.
     *
     * @return string The client secret value.
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * Retrieves the current state.
     *
     * @return string The current state.
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * Sets the grant type.
     *
     * @param string $grantType The grant type to be set.
     *
     * @return AuthSDK The AuthSDK object.
     */
    public function setGrantType(string $grantType): AuthSDK
    {
        $this->grantType = $grantType;

        return $this;
    }

    /**
     * Set the client ID.
     *
     * @param string $clientId The client ID to be set.
     *
     * @return AuthSDK Returns the modified instance of AuthSDK.
     */
    public function setClientId(string $clientId): AuthSDK
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Sets the client secret for the authentication SDK.
     *
     * @param string $clientSecret The new client secret to be set.
     * @return AuthSDK The AuthSDK instance for method chaining.
     */
    public function setClientSecret(string $clientSecret): AuthSDK
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * Sets the redirect URI for authentication.
     *
     * @param string $redirectUri The redirect URI.
     * @return AuthSDK The updated AuthSDK object.
     * @throws \Exception
     */
    public function setRedirectUri(string $redirectUri): AuthSDK
    {
        if (str_starts_with('http://', $redirectUri))
            throw new \Exception("https protocol required, http is not allowed");

        $this->redirectUri = $redirectUri;

        return $this;
    }

    /**
     * Sets the scope.
     *
     * @param string $scope The scope value to be set.
     * @return AuthSDK The instance of the AuthSDK class.
     */
    public function setScope(string $scope): AuthSDK
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Sets the state of the authentication SDK.
     *
     * @param string $state The state value to set.
     *
     * @return AuthSDK The updated instance of the authentication SDK.
     */
    public function setState(string $state): AuthSDK
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Builds an Authorize object.
     *
     * @return Authorize The built Authorize object.
     */
    public function build(): Authorize
    {
        return new Authorize($this);
    }
}
