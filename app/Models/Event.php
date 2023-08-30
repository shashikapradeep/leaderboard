<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Leaderboard\Models\AbstractModel;
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
