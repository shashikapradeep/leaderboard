<?php

namespace Leaderboard\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait User
 * @package CareHero\Traits
 */
trait User
{
    /**
     * @return mixed
     */
    public function getUser():Model
    {
        return Auth()->user()->first();
    }

    /**
     * @return mixed
     */
    public function getUserRole():Model
    {
        return $this->getUser()->role->first();
    }

    /**
     * @return mixed
     */
    public function getUserRoleName():string
    {
        return $this->getUserRole()->role;
    }

    /**
     * @return mixed
     */
    public function getUserRoleId():int
    {
        return Auth()->user()->logged_role()->role_id;
    }
}
