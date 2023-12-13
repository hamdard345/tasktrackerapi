<?php

/**
 * Endpoint
 * 
 * This is an abstract class that serves as a parent for all endpoint classes (AddTask, UpdateTask, etc.). 
 * It provides common methods for these classes. Instances of this class cannot be created directly.
 * 
 * @author Noorullah Niamatullah
 */
abstract class Endpoint
{
    protected $db; // Database object
    protected $sql; // SQL query string
    protected $sqlParams; // Parameters for the SQL query
    private $data; // Data returned from the database

    /**
     * Constructor
     *
     * Initializes the SQL query, validates the parameters, executes the SQL query, and sets the data.
     * @param Database $db - The database object.
     * @throws ClientException
     */
    public function __construct(Database $db)
    {
        try {
            $this->db = $db;
            $this->initialiseSQL();
            $this->validateParams($this->endpointParams());
            $data = $this->db->executeSQL($this->sql, $this->sqlParams);
            $this->setData([
                "length" => count($data),
                "message" => "Success",
                "data" => $data
            ]);
        } catch (Exception $e) {
            // Handle the exception by throwing a ClientException with a specific message and status code
            throw new ClientException($e->getMessage(), 400);
        }
    }

    /**
     * Set SQL
     *
     * Sets the SQL query string.
     * @param string $sql - The SQL query string.
     */
    protected function setSQL($sql)
    {
        $this->sql = $sql;
    }

    /**
     * Get SQL
     *
     * Returns the SQL query string.
     */
    protected function getSQL()
    {
        return $this->sql;
    }

    /**
     * Set SQL Params
     *
     * Sets the parameters for the SQL query.
     * @param array $params - The parameters for the SQL query.
     */
    protected function setSQLParams($params)
    {
        $this->sqlParams = $params;
    }

    /**
     * Get SQL Params
     *
     * Returns the parameters for the SQL query.
     */
    protected function getSQLParams()
    {
        return $this->sqlParams;
    }

    /**
     * Initialise SQL
     *
     * Initializes the SQL query string and parameters.
     */
    protected function initialiseSQL()
    {
        $sql = "";
        $this->setSQL($sql);
        $this->setSQLParams([]);
    }

    /**
     * Set Data
     *
     * Sets the data returned from the database.
     * @param array $data - The data returned from the database.
     */
    protected function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Get Data
     *
     * Returns the data.
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Endpoint Params
     *
     * Returns an array of parameters for the endpoint. This method should be overridden by child classes.
     */
    protected function endpointParams()
    {
        return [];
    }

    /**
     * Validate Params
     *
     * Validates the parameters for the POST request. Throws an exception if a required parameter is missing.
     * @param array $params - The parameters for the POST request.
     */
    protected function validateParams($params)
    {
        foreach ($params as $param) {
            if (!isset($_POST[$param])) {
                throw new ClientException("Please supply required parameter: " . $param, 400);
            }
        }
    }

    /**
     * Validate Request Method
     *
     * Validates the request method. Throws an exception if the request method is not the expected method.
     * @param string $method - The expected request method.
     */
    protected function validateRequestMethod($method)
    {
        if ($_SERVER['REQUEST_METHOD'] != $method) {
            throw new ClientException("Invalid Request Method", 405);
        }
    }
}
