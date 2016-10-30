<?php
namespace DCS\Role\CoreBundle\Tests\DependencyInjection;

use DCS\Role\CoreBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;

    protected function setUp()
    {
        $this->configuration = new Configuration();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ConfigurationInterface::class, $this->configuration);
    }

    public function testGetConfigTreeBuilder()
    {
        $this->assertInstanceOf(TreeBuilder::class, $this->configuration->getConfigTreeBuilder());
    }

    public function testRootNodeNameBuilder()
    {
        $treeBuilder = $this->configuration->getConfigTreeBuilder();
        $this->assertEquals('dcs_role_core', $treeBuilder->buildTree()->getName());
    }
}