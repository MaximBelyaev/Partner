<?php
class UserTest extends DbTestCase
{
    /**
     * @var User
     */
    protected $user;

    protected function setUp()
    {
        parent::setUp();
        $this->user = new User();
    }

    public function testIdIsRequired()
    {
        $this->user->email = '';
        $this->assertFalse($this->user->validate(array('email')));
    }

    public function testCreateUser()
    {
        $this->user->attributes = array(
            'email'=>'lee',
            'password'=>'123',
            'password_2'=>'2123',
            'username'=>'alexandr gala',
            'sex'=>1,
        );
        $this->assertTrue($this->user->validate());
    }

}
