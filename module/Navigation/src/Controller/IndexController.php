<?php

namespace Navigation\Controller;

use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Navigation\Entity\Navigation;
use Navigation\Form\NavigationForm;
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

    /**
     * IndexController constructor.
     * @param EntityManager $entityManager
     * @param NavigationManager $navigation
     */
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
        $form = new NavigationForm();

        if( $this->getRequest()->isPost() )
        {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if( $form->isValid() )
            {
                $data = $form->getData();

                $this->navigationManager->createNavigation($data);

                return $this->redirect()->toRoute('navigation' );
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function updateAction()
    {
        $form           = new NavigationForm();
        $navigationItem = $this->params()->fromRoute('id', null );
        $navigation     = $this->entityManager->getRepository(Navigation::class )
            ->findOneById($navigationItem);

        if( is_null($navigation) )
        {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        if( $this->getRequest()->isPost() )
        {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if( $form->isValid() )
            {
                $data = $form->getData();
                $this->navigationManager->updateNavigation($navigation, $data);

                return $this->redirect()->toRoute('navigation' );
            }
        }

        else
        {
            $data = [
                'title'  => $navigation->getTitle(),
                'link'   => $navigation->getLink(),
                'status' => $navigation->getStatus(),
            ];

            $form->setData($data);
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function deleteAction()
    {

    }
}