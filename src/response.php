<?php
 /**
  * Response
  * 
  * This class is used to set the response headers to ensure that the responses are machine-readable JSON.
  * The header() function is used to set the content-type as JSON, which lets the client (e.g., web browser) know that it is a JSON document.
  * @author Noorullah Niamatullah w18002720
  */
class Response
{
    /**
     * Constructor
     *
     * Sets the response headers to application/json and allows access from any origin.
     */
    public function __construct() {
        // Set the content type to JSON
        header("Content-Type: application/json; charset=UTF-8");
        
        // Allow access from any origin
        header("Access-Control-Allow-Origin: *"); 
    }
}
