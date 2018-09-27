<?php

namespace Navigation\Controller;

use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Navigation\Entity\Navigation;
use Navigation\Service\NavigationManager;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var NavigationManager
     */
    private $navigationManager;

    public function __construct( EntityManager $entityManager, NavigationManager $navigation )
    {
        $this->entityManager     = $entityManager;
        $this->navigationManager = $navigation;
    }

    public function indexAction()
    {
        $navigations = $this->entityManager->getRepository(Navigation::class )
            ->findAll();

        return new ViewModel([
            'navigations' => $navigations,
        ]);
    }

    public function createAction()
    {

    }

    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }
}