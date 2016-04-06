<?php

namespace DCS\Role\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class ProviderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $providerName = $container->getParameter('dcs_role.provider_name');

        if (!$container->has($providerName)) {
            throw new ServiceNotFoundException($providerName);
        }

        $container->setAlias('dcs_role.provider', $providerName);
    }
}
