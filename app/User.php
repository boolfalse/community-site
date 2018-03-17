<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * App\User
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string|null $avatar
 * @property string|null $description
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getPoints()
    {
        $questions_pts = $this->Questions()->sum('points');
        $answers_pts = $this->Answers()->sum('points');
        return $questions_pts + $answers_pts;
    }

    public function Questions()
    {
        return $this->hasMany('App\Question', 'uid');
    }

    public function Answers()
    {
        return $this->hasMany('App\Answer', 'uid');
    }

    public function FavouriteQuestions()
    {
        return $this->belongsToMany('App\Question', 'users_fav_questions', 'uid');
    }

    public function getProfileUrl()
    {
        return route('user.index', ['id' => $this->id, 'username' => urlencode(Str::slug($this->username))]);
    }
}
