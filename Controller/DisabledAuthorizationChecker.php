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

/**
 * This authorization checker always returns true. Useful if you don't want to have authorization checks at all.
 *
 * @author Paweł Jędrzejewski <pawel@miky.org>
 */
class DisabledAuthorizationChecker implements AuthorizationCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public function isGranted(RequestConfiguration $requestConfiguration, $permission)
    {
        return true;
    }
}
