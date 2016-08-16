<?php
namespace ExchangeAndroidClasses;

require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_MobileUser.php';
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_UserTask.php';
require_once './Test_DB_Connector.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-08-16 at 14:28:48.
 */
class DB_UserTaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DB_UserTask
     */
    protected $db_Connector;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->db_Connector = new Test_DB_Connector();
        $this->db_Connector->clearDataFromTables();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers ExchangeAndroidClasses\DB_UserTask::getTask_type
     * @todo   Implement testGetTask_type().
     */
   
    
    public function testGetTaskHash()
    {
        $userTask1 = new DB_UserTask(); 
        $userTask2 = new DB_UserTask();
        $this->assertTrue($userTask1->getTaskHash() != '');
        $this->assertEquals($userTask2->getTaskHash(), $userTask1->getTaskHash());
    }
    
    public function testCreteTaskFromArray(){
       
        $task_array['task_id'] = 50;
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
        $userTask = new DB_UserTask();
        $userTask->setAllFromArray($task_array);
        $this->assertEquals($userTask->getTask_id(), $task_array['task_id'] );
        $this->assertEquals($userTask->getTask_type(), $task_array['task_type']);
        $this->assertEquals($userTask->getUser_id(), $task_array['user_id']);
        $this->assertEquals($userTask->getTask_file_name(), $task_array['task_file_name']);
        $this->assertEquals($userTask->getTask_instruction(), $task_array['task_instruction']);
        $this->assertEquals($userTask->getTask_image_small(), $task_array['task_image_small']);
        $this->assertEquals($userTask->getTask_image_large(), $task_array['task_image_large']);
        $this->assertEquals($userTask->getTask_date_create(), $task_array['task_date_create']);
        $this->assertEquals($userTask->getTask_date_last_modify(), $task_array['task_date_last_modify']);
        $this->assertEquals($userTask->getTask_date_last_use(), $task_array['task_date_last_use']);
        $this->assertEquals($userTask->getTask_usage_count(), $task_array['task_usage_count']);
        $this->assertEquals($userTask->getTask_is_favorite(), $task_array['task_is_favorite']);
        
    }
    
    public function testreateTaskFromJson(){
        $task_array['task_id'] = 50;
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
        $json = json_encode($task_array);
        $userTask = new DB_UserTask;
        $userTask->setObjectFieldsFromJson($json);
        $this->assertEquals($userTask->getTask_id(), $task_array['task_id'] );
        $this->assertEquals($userTask->getTask_type(), $task_array['task_type']);
        $this->assertEquals($userTask->getUser_id(), $task_array['user_id']);
        $this->assertEquals($userTask->getTask_file_name(), $task_array['task_file_name']);
        $this->assertEquals($userTask->getTask_instruction(), $task_array['task_instruction']);
        $this->assertEquals($userTask->getTask_image_small(), $task_array['task_image_small']);
        $this->assertEquals($userTask->getTask_image_large(), $task_array['task_image_large']);
        $this->assertEquals($userTask->getTask_date_create(), $task_array['task_date_create']);
        $this->assertEquals($userTask->getTask_date_last_modify(), $task_array['task_date_last_modify']);
        $this->assertEquals($userTask->getTask_date_last_use(), $task_array['task_date_last_use']);
        $this->assertEquals($userTask->getTask_usage_count(), $task_array['task_usage_count']);
        $this->assertEquals($userTask->getTask_is_favorite(), $task_array['task_is_favorite']);
    }
    
    public function testGetObjectAsJson(){
        $task_array['task_id'] = 50;
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
        $userTaskFromArray = new DB_UserTask();
        $userTaskFromArray->setAllFromArray($task_array);
        $userTaskFromJson = new DB_UserTask();
        $userTaskFromJson->setObjectFieldsFromJson($userTaskFromArray->getObjectAsJson());
        $this->assertEquals($userTaskFromJson->getTaskHash(), $userTaskFromArray->getTaskHash());
        $this->assertEquals($userTaskFromArray->getTask_id(), $userTaskFromJson->getTask_id() );
        $this->assertEquals($userTaskFromArray->getTask_type(), $userTaskFromJson->getTask_type());
        $this->assertEquals($userTaskFromArray->getUser_id(), $userTaskFromJson->getUser_id());
        $this->assertEquals($userTaskFromArray->getTask_file_name(), $userTaskFromJson->getTask_file_name());
        $this->assertEquals($userTaskFromArray->getTask_instruction(), $userTaskFromJson->getTask_instruction());
        $this->assertEquals($userTaskFromArray->getTask_image_small(), $userTaskFromJson->getTask_image_small());
        $this->assertEquals($userTaskFromArray->getTask_image_large(), $userTaskFromJson->getTask_image_large());
        $this->assertEquals($userTaskFromArray->getTask_date_create(), $userTaskFromJson->getTask_date_create());
        $this->assertEquals($userTaskFromArray->getTask_date_last_modify(), $userTaskFromJson->getTask_date_last_modify());
        $this->assertEquals($userTaskFromArray->getTask_date_last_use(), $userTaskFromJson->getTask_date_last_use());
        $this->assertEquals($userTaskFromArray->getTask_usage_count(), $userTaskFromJson->getTask_usage_count());
        $this->assertEquals($userTaskFromArray->getTask_is_favorite(), $userTaskFromJson->getTask_is_favorite());
    }
    
    
}
