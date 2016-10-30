<?php

namespace DCS\Role\CoreBundle\Tests\DependencyInjection\Compiler;

use DCS\Role\CoreBundle\DependencyInjection\Compiler\ProviderCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class ProviderCompilerPassTest extends \PHPUnit_Framework_TestCase
{
    public function testExceptionLoad()
    {
        $this->expectException(ServiceNotFoundException::class);

        $container = new ContainerBuilder();
        $container->setParameter('dcs_role.provider_name', 'acme_provider');

        $compilerPass = new ProviderCompilerPass();
        $compilerPass->process($container);
    }

    public function testAlias()
    {
        $container = new ContainerBuilder();
        $container->setParameter('dcs_role.provider_name', 'acme_provider');
        $container->set('acme_provider', 'i_am_a_provider');

        $compilerPass = new ProviderCompilerPass();
        $compilerPass->process($container);

        $this->assertTrue($container->hasAlias('dcs_role.provider'));
        $this->assertEquals('acme_provider', $container->getAlias('dcs_role.provider'));
    }
}
