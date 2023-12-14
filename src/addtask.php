<?php

/**
 * AddTask
 * 
 * This class extends the Endpoint class and is used to add a task to a database.
 * @author Noorullah Niamatullah
 */
class AddTask extends Endpoint
{
    /**
     * Constructor
     *
     * Calls the parent constructor with the database object.
     * @param Database $db - The database object.
     */
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    /**
     * Validate Request Method
     *
     * Overrides the parent method to set the request method to POST.
     * @param string $method - The request method.
     */
    protected function validateRequestMethod($method)
    {
        $method = "POST";
        parent::validateRequestMethod($method);
    }

    /**
     * Validate Params
     *
     * Validates the parameters for the POST request.
     * @param array $params - The parameters for the POST request.
     */
    protected function validateParams($params)
    {
        $params = ["title", "description", "completed", "createdAt"];
        parent::validateParams($params);
    }

    /**
     * Initialise SQL
     *
     * Sets the SQL query to insert a new task into the tasks table and sets the SQL parameters to the POST parameters.
     */
    protected function initialiseSQL()
    {
        $sql = "INSERT INTO tasks (title,description,completed,createdAt)
                VALUES (:title, :description, :completed, :createdAt)";
        $this->setSQL($sql);
        $this->setSQLParams(['title'=> $_POST['title'],'description'=> $_POST['description'],'completed'=> false,'createdAt'=> $_POST['createdAt']]);
    }
}
