<?php
namespace ExchangeAndroidClasses;
require_once __DIR__.'..\..\ExchangeAndroidClasses\UserController.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\Controller.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_UserOperator.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_MobileUser.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_UserTask.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\TaskController.php';
require_once './Test_DB_Connector.php';
/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-08-17 at 14:11:12.
 */
class TaskControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TaskController
     */
    protected $taskController;
    protected $userOperator ;
    protected $testDbConnector;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->taskController = new TaskController();
        $this->userController = new UserController();
        $this->userOperator = new DB_UserOperator;
        $this->testDbConnector = new Test_DB_Connector();
        $this->testDbConnector->clearDataFromTables();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->testDbConnector->clearDataFromTables();
    }

    /**
     * @covers ExchangeAndroidClasses\TaskController::isUserValid
     * @todo   Implement testIsUserValid().
     */
    
    private function getUser(){
        $user = new DB_MobileUser();
        $user->setUser_login("sergo");
        $user->setUser_email("sergo3030@mail.ru");
        $user->setUser_password("amber2000");
        return $user;
    }
    
    private function getTask($user) {
        $data = date('Y-m-d H:i:s');
        $task_array['task_type'] = 'type1';
        $task_array['user_id'] = $user->getUser_id();
        $task_array['task_file_name'] = 'filename';
        $task_array['task_instruction'] = 'instruction';
        $task_array['task_image_small'] = 'task_image_small';
        $task_array['task_image_large'] = 'task_image_large';
        $task_array['task_date_create'] = $data;
        $task_array['task_date_last_modify'] = $data;
        $task_array['task_date_last_use'] = $data;
        $task_array['task_usage_count'] = 0;
        $task_array['task_is_favorite'] = 'no';
        $task = new DB_UserTask();
        $task->setAllFromArray($task_array);
        return $task;
    }
    
   

    /**
     * @covers ExchangeAndroidClasses\TaskController::executeRequest
     * @todo   Implement testExecuteRequest().
     */
    public function testExecuteRequest()
    {
        $user = $this->getUser();
        $db_error = FALSE;
        $this->userOperator->createUser($user, $db_error);
        $this->assertTrue($user->getUser_id() > 0);
        $this->assertFalse($db_error);
        $user->setUser_password($this->getUser()->getUser_password());
        $user_json = $user->getObjectAsJson();
        $request[Controller::USER] = $user_json;
        $userTask = $this->getTask($user);
        $request[Controller::TASK] = $userTask->getObjectAsJson();
        $request[Controller::ACTION] = Controller::CREATE_TASK;
        $result_json = $this->taskController->executeRequest($request);
        $result = json_decode($result_json,true);
        $this->assertTrue(isset($result[Controller::TASK]));
        $this->assertTrue(isset($result[Controller::ERRORS]));
        $taskFromDb = new DB_UserTask();
        $taskFromDb->setObjectFieldsFromJson($result[Controller::TASK]);
        $this->assertTrue($taskFromDb->getTask_id() > 0);
        
        
        $userTask->setTask_file_name("filename_rrr");
        $userTask->setTask_date_last_modify(date('Y-m-d H:i:s'));
        $userTask->setTask_usage_count(585);
        $request[Controller::TASK] = $userTask->getObjectAsJson();
        $request[Controller::ACTION] = Controller::UPDATE_TASK;
        $result_json = $this->taskController->executeRequest($request);
        $result = json_decode($result_json,TRUE);
        $this->assertTrue($result[Controller::UPDATED]);
        $request[Controller::ACTION] = Controller::TASK_LIST;
        $result_json = $this->taskController->executeRequest($request);
        $encoded_result = json_decode($result_json,TRUE);
        $this->assertTrue($encoded_result[Controller::TASK_LIST] != "");
        $result_arr = json_decode($encoded_result[Controller::TASK_LIST]);
        $this->assertTrue(count($result_arr) == 1);
        $request[Controller::ACTION] = Controller::DELETE_TASK;
        $result_json = $this->taskController->executeRequest($request);
        $result = json_decode($result_json,TRUE);
        $this->assertTrue($result[Controller::DELETED]);
        
    }
}
