<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Bundle\ResourceBundle\Provider;

use Miky\Component\Resource\Provider\AvailableLocalesProviderInterface;

/**
 * @author Anna Walasek <anna.walasek@lakion.com>
 */
class ArrayLocalesProvider implements AvailableLocalesProviderInterface
{
    /**
     * @var array
     */
    private $availableLocales;

    /**
     * @param array $availableLocales
     */
    public function __construct(array $availableLocales)
    {
        $this->availableLocales = $availableLocales;
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailableLocales()
    {
        return $this->availableLocales;
    }
}
