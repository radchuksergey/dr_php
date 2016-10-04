<?php
namespace ExchangeAndroidClasses;
require_once __DIR__.'..\..\ExchangeAndroidClasses\AndroidController.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_MobileUser.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_UserOperator.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_UserTask.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_TaskOperator.php';
require_once './Test_DB_Connector.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-10-04 at 11:51:30.
 */
class AndroidControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AndroidController
     */
    protected $object;
    protected $db_UserOperator;
    protected $db_TaskOperator;
    protected $testDBConnector;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new AndroidController;
        $this->db_UserOperator = new DB_UserOperator();
        $this->db_TaskOperator = new DB_TaskOperator();
        $this->testDBConnector = new Test_DB_Connector();
        $this->testDBConnector->clearDataFromTables();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
         $this->testDBConnector->clearDataFromTables();
    }

    /**
     * @covers ExchangeAndroidClasses\AndroidController::executeRequest
     * @todo   Implement testExecuteRequest().
     */
    public function testExecuteRequest()
    {
        $user = new DB_MobileUser();
        $db_error = FALSE;
        $user->setUser_login("aaa");
        $user->setUser_email("sergo3030@mail.ru");
        $user->setUser_password("amber2000");
        $db_UserOperator = new DB_UserOperator();
        $db_UserOperator->createUser($user, $db_error);
        $user->setUser_password("amber2000");
        $this->assertNotNull($user);
        for ($i = 0; $i < 5; $i++){
            $data = date('Y-m-d H:i:s');
            $task_array['task_type'] = 'type1';
            $task_array['user_id'] = $user->getUser_id();
            $task_array['task_file_name'] = 'filename'.$i;
            $task_array['task_instruction'] = 'instruction'.$i;
            $task_array['task_image_small'] = 'task_image_small.$i';
            $task_array['task_image_large'] = 'task_image_large'.$i;
            $task_array['task_date_create'] = $data;
            $task_array['task_date_last_modify'] = $data;
            $task_array['task_date_last_use'] = $data;
            $task_array['task_usage_count'] = 0;
            $task_array['task_is_favorite'] = 'no';
            $userTask = new DB_UserTask();
            $userTask->setAllFromArray($task_array);
            $this->db_TaskOperator->insertTask($userTask, $db_error);    
        }
        $this->assertNotNull($this->object);
        $request["android_request"] = TRUE;
        $request["action"] = "task_list";
        $request["user"] = $user->getObjectAsJson();
        $this->object->executeRequest($request);
    }
}
