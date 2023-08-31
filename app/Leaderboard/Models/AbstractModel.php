<?php
namespace Leaderboard\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package CareHero\Models
 */
abstract class AbstractModel extends Model
{
    protected $appends = ['created_timestamp', 'updated_timestamp'];
    protected $perPage = 100;

    public function getCreatedTimestampAttribute():int
    {
        return strtotime($this->created_at);
    }

    public function getUpdatedTimestampAttribute():int
    {
        return strtotime($this->updated_at);
    }
}
