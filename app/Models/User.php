<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, Sortable;

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
        'name', 'email', 'avatar', 'password', 'role',
    ];

    public $sortable = [
        'id',
        'name',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the message for the user.
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get the results with drawer
     */
    public function drawerResults()
    {
        return $this->hasMany(Result::class, 'drawer_id');
    }

    /**
     * Get the results with guesser
     */
    public function guesserResults()
    {
        return $this->hasMany(Result::class, 'guesser_id');
    }

    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Check if current user is admin.
     *
     * @param  void
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role === config('user.role.admin');
    }

    public function isCurrent()
    {
        return auth()->check() && auth()->id() === $this->id;
    }

    public function isMember()
    {
        return $this->role === config('user.role.member');
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? config('user.avatar.upload_path') . $this->id . '/' . $this->avatar : null;
    }

    public function delete()
    {
        $this->messages()->delete();

        return parent::delete();
    }
}
