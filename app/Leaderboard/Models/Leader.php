<?php
namespace Leaderboard\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $hidden = [
        "created_by",
        "updated_by",
        "created_timestamp",
        "updated_timestamp"
    ];
}
