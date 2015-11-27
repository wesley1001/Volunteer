<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Unit
 * @package App\Model
 * @mixin \Eloquent
 */
class Unit extends Model
{
    protected $table = 'units';

    protected function volunteers()
    {
        return $this->hasMany('App\Model\Volunteer');
    }

    protected function activities()
    {
        return $this->hasMany('App\Model\Activity');
    }
}
