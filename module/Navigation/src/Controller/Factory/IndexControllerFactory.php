<?php

namespace Navigation\Controller\Factory;

use Navigation\Service\NavigationManager;
use Interop\Container\ContainerInterface;
use Navigation\Controller\IndexController;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke( ContainerInterface $container, $requestedName, array $options = null )
    {
        $entityManager     = $container->get('doctrine.entitymanager.orm_default');
        $navigationManager = $container->get(NavigationManager::class);

        return new IndexController( $entityManager, $navigationManager );
    }
}