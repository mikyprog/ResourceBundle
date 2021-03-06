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

use Miky\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Miky\Component\Resource\Model\ResourceInterface;


interface FlashHelperInterface
{
    /**
     * @param RequestConfiguration $requestConfiguration
     * @param string $actionName
     * @param ResourceInterface|null $resource
     */
    public function addSuccessFlash(RequestConfiguration $requestConfiguration, $actionName, ResourceInterface $resource = null);

    /**
     * @param RequestConfiguration $requestConfiguration
     * @param ResourceControllerEvent $event
     */
    public function addFlashFromEvent(RequestConfiguration $requestConfiguration, ResourceControllerEvent $event);
}
