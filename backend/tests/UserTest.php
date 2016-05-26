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
            'name'      => 'joe',
            'email'     => 'joe@doe.com',
            'password'  => '12345'
            ];

        $data = array_merge($data, $custom);
        
        return $data;
    }

    public function testUserValidationCRUD()
    {
        $data = $this->getData(['name' => '', 'email' => 'alex']);
        $this->post('/user', $data)
            ->seeJsonEquals(['created' => false, 'errors' => ["The email must be a valid email address.","The name field is required."]]);

        $data = $this->getData(['name' => '', 'email' => 'jose']);
        $this->put('/user/1', $data)
            ->seeJsonEquals(['updated' => false, 'errors' => ["The email must be a valid email address.","The name field is required."]]);

        $this->get('user/1')->seeJsonEquals(['error' => 'Model not found']);

        $this->delete('user/1')->seeJsonEquals(['error' => 'Model not found']);
    }
 
    public function testUserCRUD()
    {
        $data = $this->getData();
        $this->post('/user', $data)->seeJsonEquals(['created' => true]);

        $this->get('user/1')->seeJson(['name' => 'joe']);
 
        $data = $this->getData(['name' => 'jane']);
        $this->put('/user/1', $data)->seeJsonEquals(['updated' => true]);

        $this->get('user/1')->seeJson(['name' => 'jane']);

        $this->delete('user/1')->seeJsonEquals(['deleted' => true]);

        $this->get('user/1')->seeJsonEquals(['error' => 'Model not found']);
    }
 
}