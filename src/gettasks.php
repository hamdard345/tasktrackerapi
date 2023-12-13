<?php

/**
 * GetTasks
 * 
 * This class extends the Endpoint class and is used to get tasks from a database.
 * @author Noorullah Niamatullah
 */
class GetTasks extends Endpoint
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
     * Overrides the parent method to set the request method to GET.
     * @param string $method - The request method.
     */
    protected function validateRequestMethod($method)
    {
        $method = "GET";
        parent::validateRequestMethod($method);
    }

    /**
     * Initialise SQL
     *
     * Sets the SQL query to select all tasks and sets the SQL parameters to an empty array.
     */
    protected function initialiseSQL()
    {
        $sql = "SELECT * from tasks";

        $this->setSQL($sql);
        $this->setSQLParams([]);
    }
}
