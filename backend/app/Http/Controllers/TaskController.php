<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task;

class TaskController extends Controller
{
    protected $rules = [
                'id_user'     => 'required|exists:users,id',
                'id_priority' => 'required|exists:priorities,id',
                'title'       => 'required',
                'description' => 'required',
                'due_date'    => 'required|date',
            ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Task::with('user', 'priority')->orderBy('id', 'asc')->get();

        if ($task->isEmpty()) return null;

        return $task;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!is_array($request->all())) 
        {
            return ['error' => 'Request must be an array'];
        }
 
        try 
        {
            $validator = \Validator::make($request->all(), $this->rules);

            if ($validator->fails()) 
            {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            else
            {
                if (Task::create($request->all()))
                {
                    return ['created' => true];
                }

                return ['created' => false];
            }

        } 
        catch (Exception $e) 
        {
            \Log::info('Error creating user: '.$e);

            return \Response::json(['created' => false], 500);
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
        $task = Task::where('id', '=', $id)->with('user', 'priority')->orderBy('id', 'asc')->first();

        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if (!is_array($request->all())) 
        {
            return ['error' => 'Request must be an array'];
        }
 
        try 
        {
            $validator = \Validator::make($request->all(), $this->rules);

            if ($validator->fails()) 
            {
                return [
                    'updated' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            else
            {
                $task = Task::find($id);
                
                if ($task->update($request->all()))
                {
                    return ['updated' => true];
                }

                return ['updated' => false];
            }

        } 
        catch (Exception $e) 
        {
            \Log::info('Error updating user: '.$e);

            return \Response::json(['updated' => false], 500);
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
        $task = Task::findOrFail($id);

        $task = Task::destroy($id);

        return ['deleted' => true];
    }
}
