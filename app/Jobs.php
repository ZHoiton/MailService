<?php

namespace MailService;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    /**
     * The table`s name.
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'queue', 'payload',
    ];
}
