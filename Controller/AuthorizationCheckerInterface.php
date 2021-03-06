<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Bundle\ResourceBundle\Controller;


interface AuthorizationCheckerInterface
{
    /**
     * Checks if user is authorized based on the current request configuration and specific permission.
     *
     * Sample permissions:
     *
     * - create
     * - show
     * - delete
     * - custom_action
     *
     * @param RequestConfiguration $configuration
     * @param $permission
     *
     * @return bool
     */
    public function isGranted(RequestConfiguration $configuration, $permission);
}
