<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Topic;

class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];

    public static function boot()
    {
        parent::boot();

        Subject::observe(new \App\Observers\UserActionsObserver);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, 'subject_id')->withTrashed();
    }
}
