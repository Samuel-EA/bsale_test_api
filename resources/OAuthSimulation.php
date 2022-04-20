<?php
class OAuthSimulation{
 
    // database connection and table name
    private $AUTH_KEY;
    private $ALLOWED_AUTH_KEY = "bd1cf60a-d96e-417e-8a66-ceade5d684b9";
 
    // constructor with $AUTH KEY
    public function __construct($AUTH_KEY){
        $this->AUTH_KEY = $AUTH_KEY;
    }

    // simulates AUTH_KEY validation
    function validateAuthKey(){
        if($this->AUTH_KEY == $this->ALLOWED_AUTH_KEY){
            return true;
        }
        return false;      
    }
}