<?php

/*
 * This file is part of the Máximo Sojo - package.
 * 
 * (c) https://maximosojo.github.io/
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Maximosojo\GoHighLevelPHP\Tests\HttpGuzzle\Contact;

use Maximosojo\GoHighLevelPHP\Tests\BaseTestCase;
use Maximosojo\GoHighLevelPHP\HttpGuzzle\Contact\Create;
use Maximosojo\GoHighLevelPHP\Model\Contact;

class CreateTest extends BaseTestCase
{
    public function testRequest()
	{
        // Model
        $contact = new Contact();
        $contact->setFirstName("Firstname");
        $contact->setLastName("Lastname");
        $contact->setName("Firstname Lastname");
        $contact->setEmail("firstnamelastname@example.com");
        $contact->setPhone("+180012345678");
        $contact->setTags([
            "createtest"
        ]);

        // Unauthorized test
        $client = new Create();
        $response = $client->request($contact);

        $statusCode = $response->getStatusCode();
        $body = (string)$response->getBody();

        $this->assertTrue($statusCode == 401);

        // Authorized test
        $client = new Create([
            "access_token" => "yourAccessKey"
        ]);
        $response = $client->request($contact);

        $statusCode = $response->getStatusCode();
        $body = (string)$response->getBody();

        $this->assertTrue($statusCode == 200);
    }
}