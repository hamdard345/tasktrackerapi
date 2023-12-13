<?php
 
// Set the content type to JSON and allow access from any origin
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

// If the request method is OPTIONS, exit the script
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {    
    exit(0);
}

/**
 * Define a secret key for the application
 */
define('SECRET',"4PpgK/?h.Y<2G7lbnM'}t3QGbt&|e");

// Include the configuration file which registers the autoloader
include 'config/config.php';

// Create a new Database object
$db = new Database("db/tasktracker.sqlite");

// Create a new Request object
$request = new Request();

/**
 * Use a switch statement to match the request path and create the appropriate endpoint object.
 * If the path does not match any cases, create a ClientError object with a 404 error.
 */
try{
    switch($request->getPath()) {
        case '/gettasks/':
        case '/gettasks':
            $endpoint = new GetTasks($db);
            break;
        case '/addtask/':
        case '/addtask':
            $endpoint = new AddTask($db);
            break;
        default:
            $endpoint = new ClientError("Path not found: " . $path, 404);
    }
} catch (ClientException $e){
    $endpoint = new ClientError($e->getMessage(), $e->getCode());
}

// Get the data from the endpoint and encode it as a JSON string
$response = $endpoint->getData();
echo json_encode($response);
