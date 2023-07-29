<?php

/*
 * This file is part of the Máximo Sojo - package.
 * 
 * (c) https://maximosojo.github.io/
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Maximosojo\GoHighLevelPHP\HttpGuzzle;

use Symfony\Component\OptionsResolver\OptionsResolver;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Client;

abstract class ClientGuzzle
{
    // Version
    public const VERSION_V1 = 'v1';

    public const VERSION_V2 = 'v2';

    // Base path
    public const BASE_URL_V1 = 'https://rest.gohighlevel.com/v1';

    public const BASE_URL_V2 = 'https://services.leadconnectorhq.com';

    // Methods
    public const METHOD_POST = "POST";

    public const METHOD_GET = "GET";

    public const METHOD_PUT = "PUT";

    public const METHOD_DELETE = "DELETE";

    protected $headers;

    protected $version = self::VERSION_V1;

    public function __construct(array $options = array())
    {
        // Options
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'accept' => 'application/json',
            'access_token' => "<token>",
            'content_type' => 'application/json'
        ]);
        $options = $resolver->resolve($options);

        // Headers
        $this->headers = [
            'Accept' => $options["accept"],
            'Authorization' => sprintf('Bearer %s',$options["access_token"]),
            'Content-Type' => $options["content_type"]
        ];
    }

    protected function onRequest(array $options = array())
    {
        // Options
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'timeout' => 10.00,
            'connect_timeout' => 10.00,
            "body" => []
        ]);
        $resolver->setRequired(["method","uri"]);
        $options = $resolver->resolve($options);

        $client = new Client();

        try {            
            $response = $client->request($options["method"], $this->compileEndpointUrl($options["uri"]), [
                'body' => json_encode($options["body"]),
                'timeout' => $options["timeout"],
                'connect_timeout' => $options["connect_timeout"],
                "headers" => $this->headers
            ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
            }
        } catch (BadResponseException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
            }
        }

        return $response;
    }

    /**
     * Compiles the final endpoint URL for the request.
     *
     * @param string $uri The URL uri to build in to the endpoint
     *
     * @return string
     */
    protected function compileEndpointUrl($uri)
    {
        $base = $this->version == self::VERSION_V1? self::BASE_URL_V1 : self::BASE_URL_V2;

        return $base.$uri;
    }
}