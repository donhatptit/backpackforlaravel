<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;


class Post extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'posts';
     protected $primaryKey = 'id';
     public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'subject_id', 'content'];
    // protected $hidden = [];
    // protected $dates = [];
    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }
    public function getSlugWithLink() {
            $id = $this->id;
            $url = route('post.manager', ['id' => $id]);

//        $link = "client/detail/$this->id";
        return "<a href='$url' target='_blank'>$this->name</a>";
    }
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
