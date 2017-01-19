<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Priority;

class PriorityController extends Controller
{
    protected $rules = [
                'name'     => 'required',
            ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priorities = Priority::orderBy('id', 'asc')->get();

        if ($priorities->isEmpty()) return null;

        return $priorities;
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
				Priority::create($request->all());

                return ['created' => true];
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
        return Priority::findOrFail($id);
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
                $priority = Priority::find($id);
                
                if ($priority->update($request->all()))
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
        $priority = Priority::findOrFail($id);

        $priority = Priority::destroy($id);

        return ['deleted' => true];
    }

    /**
     * Display a listing of the priorities ids.
     *
     * @return \Illuminate\Http\Response
     */
    public function ids()
    {
        $priority = Priority::select('id', 'name')->get();

        return $priority;
    }
}
