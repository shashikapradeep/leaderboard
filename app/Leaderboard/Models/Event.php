<?php

namespace Leaderboard\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends AbstractModel
{
    use SoftDeletes;

    protected $with = ['leader'];

    public function leaders():BelongsToMany
    {
        return $this->belongsToMany(Leader::class, 'event_leader');
    }

}
