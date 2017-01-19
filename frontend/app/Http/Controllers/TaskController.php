<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use GuzzleHttp\Client;

class TaskController extends Controller
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

        $response = $client->get('tasks');

        $body = $response->getBody();

        $tasks = json_decode($body);

        return view('tasks.list')->with(compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$client = new Client($this->data);
        $response = $client->get('users/ids');
        $body = $response->getBody();
        $users = json_decode($body);

        $client2 = new Client($this->data);
        $response2 = $client2->get('priorities/ids');
        $body2 = $response2->getBody();
        $priorities = json_decode($body2);

        return view('tasks.create')->with(compact('users', 'priorities'));
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

        $response = $client->post('tasks', [
            'form_params' => [
                'id_user' => $request->id_user,
                'id_priority' => $request->id_priority,
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date
            ]
        ]);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->created) && $res->created === true)
        {
            return Redirect::to('tasks')->with('success', 'Task created successfully!');
        }
        else 
        {
            return Redirect::back()->withInput()->with('alert', 'Task create error');
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

        $response = $client->get('tasks/'.$id);

        $body = $response->getBody();

        $task = json_decode($body);

        return view('tasks.show')->with(compact('task'));
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
        $response = $client->get('tasks/'.$id);
        $body = $response->getBody();
        $task = json_decode($body);

        $client2 = new Client($this->data);
        $response2 = $client2->get('users/ids');
        $body2 = $response2->getBody();
        $users = json_decode($body2);

        $client3 = new Client($this->data);
        $response3 = $client3->get('priorities/ids');
        $body3 = $response3->getBody();
        $priorities = json_decode($body3);

        return view('tasks.edit')->with(compact('id', 'task', 'users', 'priorities'));
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

        $response = $client->put('tasks/'.$id, [
            'form_params' => [
                'id_user' => $request->id_user,
                'id_priority' => $request->id_priority,
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date
            ]
        ]);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->updated) && $res->updated === true)
        {
            return Redirect::to('tasks')->with('success', 'Task updated successfully!');
        }
        else 
        {
            return Redirect::back()->withInput()->with('alert', 'Task update error');
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

        $response = $client->delete('tasks/'.$id);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->deleted) && $res->deleted === true)
        {
            return Redirect::to('tasks')->with('success', 'Task deleted successfully!');
        }
        else 
        {
            return Redirect::back()->withInput()->with('alert', 'Task delete error');
        }
    }
}
