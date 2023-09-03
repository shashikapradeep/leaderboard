<?php

namespace Leaderboard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leader extends AbstractModel
{
    use SoftDeletes, HasFactory;

    protected $appends = ['points_text'];

    public function getPointsTextAttribute():string
    {
        return $this->attributes['points'].' Points';
    }

}
