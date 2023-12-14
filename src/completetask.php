<?php

/**
 * AddTask
 * 
 * This class extends the Endpoint class and is used to complete a task in the database.
 * @author Noorullah Niamatullah
 */
class CompleteTask extends Endpoint{


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
        $params = ["id", "completed"];
        parent::validateParams($params);
    }
        /**
     * Initialise SQL
     *
     * Sets the SQL query to insert a new task into the tasks table and sets the SQL parameters to the POST parameters.
     */
    protected function initialiseSQL()
    {
        $sql = "UPDATE tasks SET completed = :completed WHERE id = :id
               ";
        $this->setSQL($sql);
        $this->setSQLParams(['id'=> $_POST['id'],'completed'=> $_POST['completed']]);
    }
}