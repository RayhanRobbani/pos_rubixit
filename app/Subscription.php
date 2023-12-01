<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the package details
     */
    public function package()
    {
        return $this->hasOne(\App\Package::class, 'id', 'package_id');
    }
}
