<?php

namespace CareHero\Traits;

/**
 * Trait User
 * @package CareHero\Traits
 */
trait User
{
    /**
     * @return mixed
     */
    public function getUser()
    {
        return Auth()->user()->first();
    }

    /**
     * @return mixed
     */
    public function getUserRole()
    {
        return $this->getUser()->role->first();
    }

    /**
     * @return mixed
     */
    public function getUserRoleName()
    {
        return $this->getUserRole()->role;
    }

    /**
     * @return mixed
     */
    public function getUserRoleId()
    {
        return Auth()->user()->logged_role()->role_id;
    }
}
