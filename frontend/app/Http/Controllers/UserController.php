<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redirect;

use GuzzleHttp\Client;

class UserController extends Controller
{

    protected $data = [
                'base_uri' => 'http://apiback.app/', 
                'headers'  => [
                    'api-key' => '$2y$10$8IIyWww8.9D823nKzn4TmOmPB'
                ]
            ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client($this->data);

        $response = $client->get('user');

        $body = $response->getBody();

        $users = json_decode($body);

        return view('user.list')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client($this->data);

        $response = $client->post('user', [
            'form_params' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]
        ]);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->created) == true)
        {
            return Redirect::to('user')->with('success', 'User created successfully!');
        }
        else 
        {
            return Redirect::back()->withInput()->with('alert', 'User create error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = new Client($this->data);

        $response = $client->get('user/'.$id);

        $body = $response->getBody();

        $user = json_decode($body);

        return view('user.show')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = new Client($this->data);

        $response = $client->get('user/'.$id);

        $body = $response->getBody();

        $user = json_decode($body);

        return view('user.edit')->with(compact('id', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = new Client($this->data);

        $response = $client->put('user/'.$id, [
            'form_params' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]
        ]);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->updated) == true)
        {
            return Redirect::to('user')->with('success', 'User updated successfully!');
        }
        else 
        {
            return Redirect::back()->withInput()->with('alert', 'User update error');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new Client($this->data);

        $response = $client->delete('user/'.$id);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->deleted) == true)
        {
            return Redirect::to('user')->with('success', 'User deleted successfully!');
        }
        else 
        {
            return Redirect::back()->withInput()->with('alert', 'User delete error');
        }
    }
}
