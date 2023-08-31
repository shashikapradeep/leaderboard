<?php

namespace Leaderboard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Database\Factories;

class Leader extends AbstractModel
{
    use SoftDeletes, HasFactory;

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
