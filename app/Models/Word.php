<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DateTimeTraits;

class Word extends Model
{
    use SoftDeletes, DateTimeTraits;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'status',
    ];

    /**
     * Get the results for the word.
     */
    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
