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
                    'api-key' => 'base64:5IqWYSPEpS26vkD5inLd5xCW275uuucjBr5KdAF1ALY='
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

        $response = $client->get('users');

        $body = $response->getBody();

        $users = json_decode($body);

        return view('users.list')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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

        $response = $client->post('users', [
            'form_params' => [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'role' => $request->role,
                'user' => $request->user,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation
            ]
        ]);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->created) && $res->created === true)
        {
            return Redirect::to('users')->with('success', 'User created successfully!');
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

        $response = $client->get('users/'.$id);

        $body = $response->getBody();

        $user = json_decode($body);

        return view('users.show')->with(compact('user'));
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

        $response = $client->get('users/'.$id);

        $body = $response->getBody();

        $user = json_decode($body);

        return view('users.edit')->with(compact('id', 'user'));
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

        $response = $client->put('users/'.$id, [
            'form_params' => [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'role' => $request->role,
            ]
        ]);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->updated) && $res->updated === true)
        {
            return Redirect::to('users')->with('success', 'User updated successfully!');
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

        $response = $client->delete('users/'.$id);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->deleted) && $res->deleted === true)
        {
            return Redirect::to('users')->with('success', 'User deleted successfully!');
        }
        else 
        {
            return Redirect::back()->withInput()->with('alert', 'User delete error');
        }
    }
}
