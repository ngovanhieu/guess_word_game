<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DateTimeTraits;
use Kyslik\ColumnSortable\Sortable;

class Word extends Model
{
    use SoftDeletes, DateTimeTraits, Sortable;

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

     public $sortable = [
        'id',
        'content',
        'updated_at',
    ];

    /**
     * Get the results for the word.
     */
    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
