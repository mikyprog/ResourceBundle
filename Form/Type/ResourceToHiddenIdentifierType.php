<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Bundle\ResourceBundle\Form\Type;

/**
 * @author Joseph Bielawski <stloyd@gmail.com>
 * @author Anna Walasek <anna.walasek@lakion.com>
 */
class ResourceToHiddenIdentifierType extends ResourceToIdentifierType
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'hidden';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return sprintf('%s_%s_to_hidden_identifier', $this->metadata->getApplicationName(), $this->metadata->getName());
    }
}
