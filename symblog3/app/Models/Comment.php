<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model{
    protected $table = 'comment';

    protected $fillable = ['user', 'comment', 'approved'];

    public function blog(){
        return $this->belongsTo('App\Models\Blog');
    }

}