<?php

namespace DCS\Role\CoreBundle\Tests\DependencyInjection;

use DCS\Role\CoreBundle\DependencyInjection\DCSRoleCoreExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DCSRoleCoreExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $container = new ContainerBuilder();

        $mock = $this->getMockBuilder(DCSRoleCoreExtension::class)
            ->setMethods(['processConfiguration'])
            ->getMock();

        $config = [
            'dcs_role_core' => [
                'provider' => 'acme_provider',
            ],
        ];

        $mock->load($config, $container);

        $this->assertTrue($container->hasParameter('dcs_role.provider_name'));
        $this->assertTrue($container->hasParameter('dcs_role.default_role'));

        $this->assertEquals('acme_provider', $container->getParameter('dcs_role.provider_name'));
        $this->assertEquals('ROLE_USER', $container->getParameter('dcs_role.default_role'));
    }
}
