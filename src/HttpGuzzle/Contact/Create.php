<?php

/*
 * This file is part of the Máximo Sojo - package.
 * 
 * (c) https://maximosojo.github.io/
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Maximosojo\GoHighLevelPHP\HttpGuzzle\Contact;

use Maximosojo\GoHighLevelPHP\HttpGuzzle\ClientGuzzle;
use Maximosojo\GoHighLevelPHP\Model\Contact;

class Create extends ClientGuzzle
{
    /**
     * @var string
     */
    private $uri = '/contacts/';

    public function request(Contact $contact)
    {
        $response = $this->onRequest([
            "method" => self::METHOD_POST,
            "uri" => $this->uri,
            "body" => json_decode(json_encode($contact), true)
        ]);

        return $response;
    }
}