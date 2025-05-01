<?php  

namespace App\Exceptions;  

use Exception;  

class MyCustomException extends Exception  
{  
    protected $message = "A custom error has occurred.";  

    public function __construct($message = null, $code = 0, Exception $previous = null)  
    {  
        if ($message) {  
            
            $this->message = $message;  
        }  
        parent::__construct($this->message, $code, $previous);  
    }  
}  