<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'id_user', 'id_priority', 'title', 'description', 'due_date',
    ];

    /**
    * Get the user record associated with the task.
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

    /**
    * Get the priority record associated with the task.
    */
    public function priority()
    {
        return $this->hasOne('App\Priority', 'id', 'id_priority');
    }
}
