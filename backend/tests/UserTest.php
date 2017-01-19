<?php
 
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
 
class UserTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function getData($custom = array())
    {
        $data = [
            'firstname' => 'joe',
            'lastname'  => 'doe',
            'email'     => 'joe@doe.com',
            'role'      => 'user',
            'user'      => 'joe',
            'password'  => '123456',
            'password_confirmation'  => '123456'
            ];

        $data = array_merge($data, $custom);
        
        return $data;
    }

    public function testUserValidationCRUD()
    {
        $this->get('users/1')->seeJsonEquals(['error' => 'Not found']);

        $data = $this->getData(['firstname' => '', 'lastname' => '', 'email' => 'alex', 'password_confirmation' => '654321']);
        $this->post('/users', $data)
            ->seeJsonEquals(['created' => false, 'errors' => ["The email must be a valid email address.","The firstname field is required.","The lastname field is required.","The password confirmation does not match."]]);

        $data = $this->getData(['firstname' => '', 'lastname' => '', 'email' => 'jose']);
        $this->put('/users/1', $data)
            ->seeJsonEquals(['updated' => false, 'errors' => ["The email must be a valid email address.","The firstname field is required.","The lastname field is required."]]);

        $this->delete('users/1')->seeJsonEquals(['error' => 'Not found']);
    }
 
    public function testUserCRUD()
    {
        $data = $this->getData();
        $this->post('/users', $data)->seeJsonEquals(['created' => true]);

        $this->get('users/1')->seeJson(['firstname' => 'joe']);
 
        $data = $this->getData(['firstname' => 'jane']);
        $this->put('/users/1', $data)->seeJsonEquals(['updated' => true]);

        $this->get('users/1')->seeJson(['firstname' => 'jane']);

        $this->delete('users/1')->seeJsonEquals(['deleted' => true]);

        $this->get('users/1')->seeJsonEquals(['error' => 'Not found']);
    }
 
}