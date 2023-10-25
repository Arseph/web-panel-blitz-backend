<?php

namespace App\Traits\Validation;

trait EmailValidator {

    /**
     * Regex pattern that tests emails whether it
     * is a valid email or not
     * 
     * @var Regex
     */
    protected $validatorRegex = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";

    /**
     * Test email if valid
     * 
     * @param String $email
     * @return Boolean
     */
    public function testEmail($email)
    {
        return $this->checkValidity($email) === 1;
    }

    /**
     * Check the email against the regex pattern
     * Return 1 if pattern matched, 0 if not
     * 
     * @param String $email
     * @return Int
     */
    public function checkValidity($email)
    {
        return preg_match($this->validatorRegex, $email);
    }

}
