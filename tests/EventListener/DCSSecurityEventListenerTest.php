<?php

namespace DCS\Role\CoreBundle\Tests\EventListener;

use DCS\Role\CoreBundle\EventListener\DCSSecurityEventListener;
use DCS\Role\CoreBundle\Provider\ProviderInterface;
use DCS\Security\CoreBundle\DCSSecurityCoreEvents;
use DCS\Security\CoreBundle\Event\AuthenticatedTokenEvent;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Role\Role;

class DCSSecurityEventListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $roleProvider;

    protected function setUp()
    {
        $this->roleProvider = $this->createMock(ProviderInterface::class);
        $this->roleProvider->expects($this->any())
            ->method('getRole')->will($this->returnCallback([$this, 'getRole']));
    }

    public function testGetSubscribedEvents()
    {
        $listener = new DCSSecurityEventListener($this->roleProvider);
        $events = $listener->getSubscribedEvents();

        $this->assertCount(1, $events);
        $this->assertEquals(DCSSecurityCoreEvents::AUTHENTICATED_USER, array_keys($events)[0]);
        $this->assertEquals('setDefaultRole', $events[DCSSecurityCoreEvents::AUTHENTICATED_USER]);
    }

    public function testSetDefaultRoleWithDefaultRole()
    {
        $listener = new DCSSecurityEventListener($this->roleProvider, 'ROLE_USER');
        $this->roleProvider->expects($this->once())->method('getRole')->with('ROLE_USER')->willReturn($this->isInstanceOf(Role::class));

        $event = $this->createMock(AuthenticatedTokenEvent::class, [], [new UsernamePasswordToken('johndoe','passwd','default',[])]);
        $event->expects($this->once())->method('regenerateUsernamePasswordTokenWithRoles');

        $listener->setDefaultRole($event);
    }

    public function testSetDefaultRoleWithoutDefaultRole()
    {
        $listener = new DCSSecurityEventListener($this->roleProvider);
        $this->roleProvider->expects($this->exactly(0))->method('getRole');

        $event = $this->createMock(AuthenticatedTokenEvent::class, [], [new UsernamePasswordToken('johndoe','passwd','default',[])]);
        $event->expects($this->exactly(0))->method('regenerateUsernamePasswordTokenWithRoles');

        $listener->setDefaultRole($event);
    }

    public function getRole($role)
    {
        if ($role === 'ROLE_USER') {
            return new Role('ROLE_USER');
        }

        return null;
    }
}