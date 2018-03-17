<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Question
 *
 * @property int $id
 * @property int $uid
 * @property string $title
 * @property string $body
 * @property int $views
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereViews($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $Categories
 * @property int $points
 * @property int|null $best_answer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Answer[] $Answers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereBestAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question wherePoints($value)
 */
class Question extends Model
{
    public function Categories()
    {
        return $this->belongsToMany('App\Category', 'category_question');
    }

    public function Answers()
    {
        return $this->hasMany('App\Answer', 'question_id');
    }

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'uid');
    }

    public function isUserFavourite()
    {
        if ($user = Auth::user()) {
            $fav = DB::table('users_fav_questions')
                ->where('uid', '=', $user->id)
                ->where('question_id', '=', $this->id)->first();
            return ($fav != null);
        }
        return false;
    }

    public function userVote($type)
    {
        if ($user = Auth::user()) {
            $vote = $this->getVote($user->id);
            //if has not voted yet do vote and update points
            if ($vote->first() == null) {
                DB::table('users_votes')->insert([
                    'uid' => $user->id,
                    'question_id' => $this->id,
                    'type' => $type,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                if ($type == 'up')
                    $this->points++;
                elseif ($type == 'down')
                    $this->points--;
                $this->save();
                return $type;
            } elseif ($vote->first()->type == $type) { //if has already voted same vote remove old one and update points
                $vote->delete();
                if ($type == 'up')
                    $this->points--;
                elseif ($type == 'down')
                    $this->points++;
                $this->save();
                return 'cancel_' . $type;
            } elseif ($vote->first()->type !== $type) { //if has already voted but different vote remove old one and update points
                $vote->delete();
                DB::table('users_votes')->insert([
                    'uid' => $user->id,
                    'question_id' => $this->id,
                    'type' => $type,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                if ($type == 'up')
                    $this->points++;
                elseif ($type == 'down')
                    $this->points--;
                $this->save();
                return $vote->first()->type;
            }
        }
        //and finally returns a response describe the action taken.
        return null;
    }

    public function getVote($user_id)
    {
        return DB::table('users_votes')
            ->where('uid', '=', $user_id)
            ->where('question_id', '=', $this->id);
    }

    public function getUrl()
    {
        return route('question.index', ['id' => $this->id, 'title' => urlencode(Str::slug($this->title))]);
    }
}
