<?php

namespace App;

use App\Notifications\SomethingTweeted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tweet extends Model
{
    use Notifiable;

    protected $fillable = ['content'];

    public static function boot()
    {
        static::created(function ($model) {
            $model->notify(new SomethingTweeted());
        });
    }

    public function setContentAttribute($content)
    {
        $this->attributes['content'] = substr($content, 0, 139);
    }
}
