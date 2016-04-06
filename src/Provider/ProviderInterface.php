<?php

namespace DCS\Role\CoreBundle\Provider;

use Symfony\Component\Security\Core\Role\RoleInterface;

interface ProviderInterface
{
    /**
     * Get all roles
     *
     * @return array|RoleInterface[]
     */
    public function getRoles();

    /**
     * Find a role
     *
     * @param string $role
     * @return string|RoleInterface
     */
    public function getRole($role);

    /**
     * Check if role exists
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role);

    /**
     * Add role to provider if not exists
     *
     * @param string $role
     * @return void
     */
    public function addRole($role);
}