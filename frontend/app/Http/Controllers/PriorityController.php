<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use GuzzleHttp\Client;

class PriorityController extends Controller
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

        $response = $client->get('priorities');

        $body = $response->getBody();

        $priorities = json_decode($body);

        return view('priorities.list')->with(compact('priorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('priorities.create');
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

        $response = $client->post('priorities', [
            'form_params' => [
                'name' => $request->name,
            ]
        ]);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->created) && $res->created === true)
        {
            return Redirect::to('priorities')->with('success', 'Priority created successfully!');
        }
        else 
        {
            return Redirect::back()->withInput()->with('alert', 'Priority create error');
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

        $response = $client->get('priorities/'.$id);

        $body = $response->getBody();

        $priority = json_decode($body);

        return view('priorities.show')->with(compact('priority'));
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

        $response = $client->get('priorities/'.$id);

        $body = $response->getBody();

        $priority = json_decode($body);

        return view('priorities.edit')->with(compact('id', 'priority'));
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

        $response = $client->put('priorities/'.$id, [
            'form_params' => [
                'name' => $request->name,
            ]
        ]);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->updated) && $res->updated === true)
        {
            return Redirect::to('priorities')->with('success', 'Priority updated successfully!');
        }
        else 
        {
            return Redirect::back()->withInput()->with('alert', 'Priority update error');
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

        $response = $client->delete('priorities/'.$id);

        $body = $response->getBody();

        $res = json_decode($body);

        if (isset($res->deleted) && $res->deleted === true)
        {
            return Redirect::to('priorities')->with('success', 'Priority deleted successfully!');
        }
        else 
        {
            return Redirect::back()->withInput()->with('alert', 'Priority delete error');
        }
    }
}
