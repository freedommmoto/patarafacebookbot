<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bots extends model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bots';

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'page_name',
        'page_key_id',
        'token',
        'greeting_text',
        'user_id'
    ];

}
