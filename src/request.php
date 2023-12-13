<?php 
/**
 * Request
 * 
 * This class is used to handle the request method and path.
 * @author Noorullah Niamatullah w18002720
 */
class request
{
    private $method; // The request method
    private $path; // The request path

    /**
     * Constructor
     *
     * Sets the request method and path.
     */
    public function __construct(){
        $this->setMethod();
        $this->setPath();
    }

    /**
     * Set Method
     *
     * Sets the request method.
     */
    private function setMethod(){
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Validate Request Method
     *
     * Validates the request method. If the method is not valid, it outputs an error message and terminates the script.
     * @param array $validMethods - The valid request methods.
     */
    public function validateRequestMehtod($validMehtods){
        if(!in_array($this->method, $validMehtods)) {
            $output['message'] = "Invalid request method: ".$this->method;
        }
        die(json_encode($output));
    }

    /**
     * Set Path
     *
     * Sets the request path by parsing the request URI and removing the base path.
     */
    private function setPath(){
        $this->path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $this->path = str_replace("/tasktracker/tasktrackerapi","",$this->path);
    }

    /**
     * Get Path
     *
     * Returns the request path.
     */
    public function getPath(){
        return $this->path;
    }
}
