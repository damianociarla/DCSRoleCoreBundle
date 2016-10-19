<?php

namespace DCS\Role\CoreBundle\Tests;

use DCS\Role\CoreBundle\DCSRoleCoreBundle;

class DCSRoleCoreBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildAddsProviderCompilerPass()
    {
        $containerBuilder = $this->createMock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $containerBuilder->expects($this->atLeastOnce())
            ->method('addCompilerPass')
            ->with($this->isInstanceOf('DCS\Role\CoreBundle\DependencyInjection\Compiler\ProviderCompilerPass'));

        $bundle = new DCSRoleCoreBundle();
        $bundle->build($containerBuilder);
    }
}