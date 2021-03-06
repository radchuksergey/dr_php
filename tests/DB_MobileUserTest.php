<?php
namespace ExchangeAndroidClasses;
require_once __DIR__.'..\..\ExchangeAndroidClasses\DB_MobileUser.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-08-13 at 16:16:00.
 */
class DB_MobileUserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DB_MobileUser
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new DB_MobileUser();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->object = NULL;
    }

    /**
     * @covers ExchangeAndroidClasses\DB_MobileUser::getUser_id
     * @todo   Implement testGetUser_id().
     */
    
    /**
     * @covers ExchangeAndroidClasses\DB_MobileUser::isPaswordCorrect
     * @todo   Implement testIsPaswordCorrect().
     */
    public function testIsPaswordCorrect()
    {
        $data = date(DB_MobileUser::DATE_FORMAT);
        $u["user_id"] = 50;
        $u["user_login"] = "sergo";
        $u["user_email"] = "sergo3030@mail.ru";
        $u["user_password"] = "password";
        $u["user_date_registration"] = $data;
        $user1 = new DB_MobileUser();
        $user2 = new DB_MobileUser();
        $user1->setAllFromArray($u);
        $user2->setAllFromArray($u);
        $user1->setUser_password($user1->createEncryptedPassword());
        $this->assertTrue($user1->isPaswordCorrect($user2->getUser_password()));
        
    }

    /**
     * @covers ExchangeAndroidClasses\DB_MobileUser::setUser_id
     * @todo   Implement testSetUser_id().
     */
   
    public function testGetCheckSum()
    {
        $data = date(DB_MobileUser::DATE_FORMAT);
        $user1 = new DB_MobileUser();
        $user2 = new DB_MobileUser();
        $data = time();
        $u["user_id"] = 50;
        $u["user_login"] = "sergo";
        $u["user_email"] = "sergo3030@mail.ru";
        $u["user_password"] = "password";
        $u["user_date_registration"] = $data;
        $user1 ->setAllFromArray($u);
        $user2->setAllFromArray($u);
        $this->assertTrue($user1->getCheckSum() == $user2->getCheckSum());
    }
    
    public function testCrateEncryptedPassword(){
        $data = date(DB_MobileUser::DATE_FORMAT);
        $user = new DB_MobileUser();
        $user->setUser_password("password");
        $user->setUser_date_registration(time());
        $this->assertTrue($user->createEncryptedPassword() != "");
    }
    
    /**
     * @covers ExchangeAndroidClasses\DB_MobileUser::setUser_id
     * @todo   Implement testCreateEmptyUser().
     */
    public function testCreateFromJson(){
        $data = date(DB_MobileUser::DATE_FORMAT);
        $u["user_id"] = 50;
        $u["user_login"] = "sergo";
        $u["user_email"] = "sergo3030@mail.ru";
        $u["user_password"] = "password";
        $u["user_date_registration"] =$data;
        $json_arr = json_encode($u);
        $user = new DB_MobileUser();
        $user->setObjectFieldsFromJson($json_arr);
        $this->assertEquals($user->getUser_id(), $u["user_id"]);
        $this->assertEquals($user->getUser_login(), $u["user_login"]);
        $this->assertEquals($user->getUser_email(), $u["user_email"]);
        $this->assertEquals($user->getUser_password(), $u["user_password"]);
        $this->assertEquals($user->getUser_date_registration_AsString(), $u["user_date_registration"]);
    }
    
    
    public function testCreateFromArray(){
        $data = date(DB_MobileUser::DATE_FORMAT);
        $u["user_id"] = 50;
        $u["user_login"] = "sergo";
        $u["user_email"] = "sergo3030@mail.ru";
        $u["user_password"] = "password";
        $u["user_date_registration"] = $data;
        $user = new DB_MobileUser();
        $user->setAllFromArray($u);
        $this->assertEquals($user->getUser_id(), $u["user_id"]);
        $this->assertEquals($user->getUser_login(), $u["user_login"]);
        $this->assertEquals($user->getUser_email(), $u["user_email"]);
        $this->assertEquals($user->getUser_password(), $u["user_password"]);
        $this->assertEquals($user->getUser_date_registration_AsString(), $u["user_date_registration"]);    
    }
    
    public function testCreateEmptyUser(){
        $emptyUser = new DB_MobileUser();
        $this->assertFalse($emptyUser->getUser_id());
        $this->assertFalse($emptyUser->getUser_email());
        $this->assertFalse($emptyUser->getUser_login());
        $this->assertFalse($emptyUser->getUser_password());
        $this->assertFalse($emptyUser->getUser_date_registration());    
    }
}
