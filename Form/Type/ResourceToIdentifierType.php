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

use Miky\Bundle\ResourceBundle\Form\DataTransformer\ResourceToIdentifierTransformer;
use Miky\Component\Resource\Metadata\MetadataInterface;
use Miky\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Alexandre Bacco <alexandre.bacco@gmail.com>
 * @author Anna Walasek <anna.walasek@lakion.com>
 */
class ResourceToIdentifierType extends AbstractType
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var MetadataInterface
     */
    protected $metadata;

    /**
     * @param RepositoryInterface $repository
     * @param MetadataInterface $metadata
     */
    public function __construct(RepositoryInterface $repository, MetadataInterface $metadata)
    {
        $this->repository = $repository;
        $this->metadata = $metadata;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(
            new ResourceToIdentifierTransformer($this->repository, $options['identifier'])
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'identifier' => 'id',
            ])
            ->setAllowedTypes('identifier', 'string')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return sprintf('%s_%s_to_identifier', $this->metadata->getApplicationName(), $this->metadata->getName());
    }
}
