<?php

/*
 * This file is part of the Máximo Sojo - package.
 * 
 * (c) https://maximosojo.github.io/
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Maximosojo\GoHighLevelPHP\Model;

class Contact
{
    public $firstName;

    public $lastName;

    public $name;

    public $email;

    public $phone;

    public $tags = [];

    public $customField = [];    

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function setTags(array $tags)
    {
        $this->tags = $tags;

        return $this;
    }

    public function setCustomField(array $customField)
    {
        $this->customField = $customField;

        return $this;
    }    
}