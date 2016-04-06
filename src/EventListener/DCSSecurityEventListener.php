<?php

namespace DCS\Role\CoreBundle\EventListener;

use DCS\Role\CoreBundle\Provider\ProviderInterface;
use DCS\Security\CoreBundle\DCSSecurityCoreEvents;
use DCS\Security\CoreBundle\Event\AuthenticatedTokenEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DCSSecurityEventListener implements EventSubscriberInterface
{
    /**
     * @var ProviderInterface
     */
    private $roleProvider;

    /**
     * @var string|null
     */
    private $defaultRole;

    /**
     * DCSSecurityEventSubscriber constructor.
     * 
     * @param ProviderInterface $roleProvider
     * @param string|null $defaultRole
     */
    public function __construct(ProviderInterface $roleProvider, $defaultRole = null)
    {
        $this->roleProvider = $roleProvider;
        $this->defaultRole = $defaultRole;
    }

    public static function getSubscribedEvents()
    {
        return [
            DCSSecurityCoreEvents::AUTHENTICATED_USER => 'setDefaultRole',
        ];
    }

    public function setDefaultRole(AuthenticatedTokenEvent $event)
    {
        if (null === $this->defaultRole) {
            return;
        }

        $role = $this->roleProvider->getRole($this->defaultRole);

        if (null === $role) {
            return;
        }

        $event->regenerateUsernamePasswordTokenWithRoles([$role]);
    }
}