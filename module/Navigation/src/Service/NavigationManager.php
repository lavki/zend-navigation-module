<?php

namespace Navigation\Service;

use Navigation\Entity\Navigation;

class NavigationManager
{
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * NavigationManager constructor.
     * @param $entityManager
     */
    public function __construct( $entityManager )
    {
        $this->entityManager = $entityManager;
    }

    public function createNavigation( $data )
    {
        $navigation = new Navigation();

        $navigation->setTitle($data['title']);
        $navigation->setLink($data['link']);
        $navigation->setParentId($data['parentId']);
        $navigation->setOrderId($data['orderId']);
        $navigation->setStatus($data['status']);

        $this->entityManager->persist($navigation);
        $this->entityManager->flush();
    }

    public function updateNavigation()
    {

    }

    public function deleteNavigation()
    {

    }
}