<?php
namespace ExchangeAndroidClasses;

require_once './Test_DB_Connector.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_MobileUser.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_UserTask.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_TaskOperator.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_UserOperator.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-08-16 at 15:23:44.
 */
class DB_TaskOperatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DB_TaskOperator
     */
    protected $object;
    protected $testDBConnector;
    

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new DB_TaskOperator;
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
     * @covers ExchangeAndroidClasses\DB_TaskOperator::getTaskById
     * @todo   Implement testGetTaskById().
     */
    public function testGetTaskById()
    {
       $db_error = FALSE;
       $data = date('Y-m-d H:i:s');
        $task_array['task_type'] = 'waypoint';
        $task_array['user_id'] = 666;
        $task_array['task_file_name'] = 'filename';
        $task_array['task_instruction'] = 'instruction';
        $task_array['task_image_small'] = 'task_image_small';
        $task_array['task_image_large'] = 'task_image_large';
        $task_array['task_date_create'] = $data;
        $task_array['task_date_last_modify'] = $data;
        $task_array['task_date_last_use'] = $data;
        $task_array['task_usage_count'] = 0;
        $task_array['task_is_favorite'] = 'no';
        $task_array['marked_as_delete'] = 0;
        $userTask = new DB_UserTask();
        $userTask->setAllFromArray($task_array);
        $this->object->insertTask($userTask, $db_error);
        $this->assertTrue($userTask->getUser_id() > 0);
        
        $taskFromDb = $this->object->getTaskById($userTask->getTask_id(), $db_error);
        $this->assertEquals($taskFromDb->getCheckSum(), $userTask->getCheckSum());
    }

    /**
     * @covers ExchangeAndroidClasses\DB_TaskOperator::getTaskByName
     * @todo   Implement testGetTaskByName().
     */
    public function testGetTaskByName(){
            $db_error = FALSE;
        $data = time();
        $u["user_login"] = "sergo";
        $u["user_email"] = "sergo3030@mail.ru";
        $u["user_password"] = "password";
        $u["user_date_registration"] = $data;
        $user = new DB_MobileUser();
        $user->setAllFromArray($u);
        $dbUSerOperator = new DB_UserOperator();
        $dbUSerOperator->createUser($user, $db_error);
        $this->assertTrue($user->getUser_id() > 0);
        $data = date('Y-m-d H:i:s');
        $task_array['task_type'] = 'waypoint';
        $task_array['user_id'] = $user->getUser_id();
        $task_array['task_file_name'] = 'myfilename';
        $task_array['task_instruction'] = 'instruction';
        $task_array['task_image_small'] = 'task_image_small';
        $task_array['task_image_large'] = 'task_image_large';
        $task_array['task_date_create'] = $data;
        $task_array['task_date_last_modify'] = $data;
        $task_array['task_date_last_use'] = $data;
        $task_array['task_usage_count'] = 0;
        $task_array['task_is_favorite'] = 'no';
        $task_array['marked_as_delete'] = 0;
        $userTask = new DB_UserTask();
        $userTask->setAllFromArray($task_array);
        $this->object->insertTask($userTask, $db_error);    
               
        $userTaskFromDB = $this->object->getTaskByName($userTask->getTask_file_name(), $user->getUser_id(), $db_error);
        $this->assertEquals($userTask->getCheckSum(), $userTaskFromDB->getCheckSum());
        
    }

    /**
     * @covers ExchangeAndroidClasses\DB_TaskOperator::getTaskListByUserID
     * @todo   Implement testGetTaskListByUserID().
     */
    public function testGetTaskListByUserID()
    {
        $db_error = FALSE;
        $data = time();
        $u["user_login"] = "sergo";
        $u["user_email"] = "sergo3030@mail.ru";
        $u["user_password"] = "password";
        $u["user_date_registration"] = $data;
        $user = new DB_MobileUser();
        $user->setAllFromArray($u);
        $dbUSerOperator = new DB_UserOperator();
        $dbUSerOperator->createUser($user, $db_error);
        $this->assertTrue($user->getUser_id() > 0);$db_error = FALSE;
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
            $task_array['marked_as_delete'] = 0;
            $userTask = new DB_UserTask();
            $userTask->setAllFromArray($task_array);
            $this->object->insertTask($userTask, $db_error);    
        }
        $routes = $this->object->getTaskListByUserID($user->getUser_id(), $db_error);
        $this->assertEquals(count($routes), 5);
        
    }

    /**
     * @covers ExchangeAndroidClasses\DB_TaskOperator::updateTask
     * @todo   Implement testUpdateTask().
     */
    public function testUpdateTask()
    {
        $db_error = FALSE;
        $data = date('Y-m-d H:i:s');
        $task_array['task_type'] = 'waypoint';
        $task_array['user_id'] = 666;
        $task_array['task_file_name'] = 'filename';
        $task_array['task_instruction'] = 'instruction';
        $task_array['task_image_small'] = 'task_image_small';
        $task_array['task_image_large'] = 'task_image_large';
        $task_array['task_date_create'] = $data;
        $task_array['task_date_last_modify'] = $data;
        $task_array['task_date_last_use'] = $data;
        $task_array['task_usage_count'] = 0;
        $task_array['task_is_favorite'] = 'no';
        $task_array['marked_as_delete'] = 0;
        $userTask = new DB_UserTask();
        $userTask->setAllFromArray($task_array);
        $this->object->insertTask($userTask, $db_error);
        $userTask->setTask_date_create(time());
        $userTask->setTask_date_last_modify(time());
        $userTask->setTask_date_last_use(time());
        $userTask->setTask_image_large("new large image");
        $userTask->setTask_image_small("new small image");
        $userTask->setTask_instruction("new instruction");
        $userTask->setTask_usage_count(666);
        $userTask->setTask_is_favorite("yes");
        $updateResult = $this->object->updateTask($userTask, $db_error);
        $this->assertEquals($updateResult, TRUE);
        $userFromDB = $this->object->getTaskById($userTask->getTask_id(), $db_error);
        $this->assertEquals($userFromDB->getCheckSum(), $userTask->getCheckSum());
    }

    /**
     * @covers ExchangeAndroidClasses\DB_TaskOperator::insertTask
     * @todo   Implement testInsertTask().
     */
    public function testInsertTask()
    {
        $db_error = FALSE;
        $task_array['task_type'] = 'type1';
        $task_array['user_id'] = 666;
        $task_array['task_file_name'] = 'filename';
        $task_array['task_instruction'] = 'instruction';
        $task_array['task_image_small'] = 'task_image_small';
        $task_array['task_image_large'] = 'task_image_large';
        $task_array['task_date_create'] = 'task_date_create';
        $task_array['task_date_last_modify'] = '$task_date_last_modify';
        $task_array['task_date_last_use'] = 'task_date_last_use';
        $task_array['task_usage_count'] = 'task_usage_count';
        $task_array['task_is_favorite'] = '$task_is_favorite';
        $task_array['marked_as_delete'] = 0;
        $userTask = new DB_UserTask();
        $userTask->setAllFromArray($task_array);
        $this->object->insertTask($userTask, $db_error);
        $this->assertTrue($userTask->getUser_id() > 0);
    }

    /**
     * @covers ExchangeAndroidClasses\DB_TaskOperator::deleteTask
     * @todo   Implement testDeleteTask().
     */
    public function testDeleteTask()
    {
        $db_error = FALSE;
        $task_array['task_type'] = 'type1';
        $task_array['user_id'] = 666;
        $task_array['task_file_name'] = 'filename';
        $task_array['task_instruction'] = 'instruction';
        $task_array['task_image_small'] = 'task_image_small';
        $task_array['task_image_large'] = 'task_image_large';
        $task_array['task_date_create'] = 'task_date_create';
        $task_array['task_date_last_modify'] = '$task_date_last_modify';
        $task_array['task_date_last_use'] = 'task_date_last_use';
        $task_array['task_usage_count'] = 'task_usage_count';
        $task_array['task_is_favorite'] = '$task_is_favorite';
        $task_array['marked_as_delete'] = 0;
        $userTask = new DB_UserTask();
        $userTask->setAllFromArray($task_array);
        $this->object->insertTask($userTask, $db_error);
        $this->assertTrue($userTask->getTask_id() > 0);
        $deleteResult = $this->object->deleteTask($userTask->getTask_id(), $db_error);
        $this->assertTrue($deleteResult);
    }
}
