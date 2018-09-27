<?php

namespace Navigation\Service\Factory;

use Interop\Container\ContainerInterface;
use Navigation\Service\NavigationManager;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke( ContainerInterface $container, $requestedName, array $options = null )
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new NavigationManager( $entityManager );
    }
}