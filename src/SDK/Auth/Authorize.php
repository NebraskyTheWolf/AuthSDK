<?php

namespace Fluffici\SDK\Auth;

use Exception;
use Httpful\Request;
use Fluffici\SDK\AuthSDK;

class Authorize
{
    private AuthSDK $client;

    public function __construct(AuthSDK $client)
    {
        $this->client = $client;
    }

    public function getAuthURL(): string
    {
        return $this->buildUrlWithQueryParams("https://auth.fluffici.eu", [
            'clientId' => $this->client->getClientId(),
            'redirectUri' => $this->client->getRedirectUri(),
            'state' => $this->client->getState(),
            'scope' => $this->client->getScope()
        ]);
    }

    /**
     * Authorize the user using the provided authorization code.
     *
     * @param string $code The authorization code.
     * @return TemporaryCredentials The temporary credentials obtained from the authorization.
     * @throws Exception If unable to request the authorization.
     */
    public function authorize(string $code): TemporaryCredentials
    {
        $response = Request::get($this->buildUrlWithQueryParams('https://auth.fluffici.eu/oauth/token', [
            'grant_type' => $this->client->getGrantType(),
            'clientId' => $this->client->getClientId(),
            'client_secret' => $this->client->getClientSecret(),
            'code' => $code
        ]))->expectsJson()->send();

        if ($response->code === 200) {
            $body = json_decode(json_encode($response->body), true);

            if (array_key_exists('user', $body)) {
                return new TemporaryCredentials($body['user'], $this->client->getGrantType());
            } else if (array_key_exists('bearer_token', $body)) {
                return new TemporaryCredentials($body['bearer_token'], $this->client->getGrantType());
            }
        }

        throw new Exception("Unable to request the authorization.");
    }

    /**
     * Build the URL from a string and add query parameters from an array.
     *
     * @param string $url The base URL.
     * @param array $queryParams An array of query parameters to add to the URL.
     *
     * @return string The resulting URL with query parameters added.
     */
    private function buildUrlWithQueryParams(string $url, array $queryParams): string
    {
        $queryString = http_build_query($queryParams);
        return $url . '?' . $queryString;
    }
}
