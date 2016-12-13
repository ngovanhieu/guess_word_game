<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Room extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'status',
    ];

    /**
     * Get the message for the room.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the results for the room.
     */
    public function results()
    {
        return $this->hasMany(Result::class);
    }
    
    /**
     * Determine if the room can be joined.
     */
    public function canJoin()
    {
        return $this->status == config('room.status.empty') || $this->status == config('room.status.waiting');
    }

    /**
     * Get the info for the room.
     */
    public function info()
    {
        return $this->hasOne(Result::class);
    }

    public function resultsCountRelation()
    {
        return $this->results()
            ->selectRaw('room_id, count(*) as total')
            ->groupBy('room_id');
    }

    public function getResultsCountAttribute()
    {
        return $this->resultsCountRelation ? $this->resultsCountRelation->first()->total : 0;
    }

    public function correctResultsCountRelation()
    {
        return $this->results()
            ->selectRaw('room_id, count(*) as total')
            ->where('is_correct', config('result.is_correct.true'))
            ->groupBy('room_id');
    }

    public function getCorrectResultsCountAttribute()
    {
        if ( array_key_exists('results', $this->relations)) {
            return $this->results
            ->filter(function ($value, $key) {
                return is_null($value->is_correct) ? false : $value->is_correct;
            })->count();
        }

        return $this->correctResultsCountRelation ? $this->correctResultsCountRelation->first()->total : 0;
    }
}
