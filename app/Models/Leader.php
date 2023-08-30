<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Leaderboard\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leader extends AbstractModel
{
    use SoftDeletes;

    protected $with = ['event'];
    protected $appends = ['points_text'];


    public function getPointsTextAttribute():string
    {
        return $this->attributes['points'].' Points';
    }

    public function events():BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_leader');
    }

}
