<?php

namespace DCS\Role\CoreBundle;

use DCS\Role\CoreBundle\DependencyInjection\Compiler\ProviderCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DCSRoleCoreBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ProviderCompilerPass());
    }
}