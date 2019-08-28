<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    const STATUS_IS_IN_PLACE = 1; // на месте
    const STATUS_ISSUED = 2; // выдана

    protected $fillable = ['title', 'status', 'author_id'];

    protected $hidden = ['created_at', 'updated_at'];
}
