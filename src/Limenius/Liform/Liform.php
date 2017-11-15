<?php

namespace Limenius\Liform;

use Limenius\Liform\Transformer\ExtensionInterface;
use Symfony\Component\Form\FormInterface;

class Liform implements LiformInterface
{
    /**
     * @var ResolverInterface
     */
    private $resolver;

    /**
     * @var ExtensionInterface[]
     */
    private $extensions = [];

    /**
     * @param ResolverInterface $resolver
     */
    public function __construct(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * @inheritdoc
     */
    public function transform(FormInterface $form)
    {
        $transformerData = $this->resolver->resolve($form);

        return $transformerData['transformer']->transform($form, $this->extensions, $transformerData['widget']);
    }

    /**
     * @inheritdoc
     */
    public function addExtension(ExtensionInterface $extension)
    {
        $this->extensions[] = $extension;

        return $this;
    }
}
