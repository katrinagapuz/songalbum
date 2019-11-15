<?php
namespace Album\Controller;

use Zend\Db\Sql\Delete;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\AlbumTable;
use Album\Form\AlbumForm;
use Album\Model\Album;
use Zend\Http\Response;

class AlbumController extends AbstractActionController
{
    private $table;

    public function __construct(AlbumTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel([
            'albums' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if(!$request->isPost()) {
            return ['form' => $form];
        }

        $album = new Album();
        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if(!$form->isValid()) {
            return ['form' => $form];
        }

        $album->exchangeArray($form->getData());
        $this->table->saveAlbum($album);
        return $this->redirect()->toRoute('album');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if(0 === $id) {
            return $this->redirect()->toRoute('album', ['action' => 'add']);
        }

        try {
            $album = $this->table->getAlbum($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('album', ['action' => 'index']);
        }

        $form = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setValue('Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if(!$request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if(!$form->isValid()) {
            return $viewData;
        }

        $this->table->saveAlbum($album);
        return $this->redirect()->toRoute('album');
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        $response = $this->getResponse();

        if(!$id) {
            $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
        }

        try {
            $album = $this->table->getAlbum($id);
        } catch (\Exception $e) {
            $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
        }

        $this->table->deleteAlbum($id);
        $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
        return $response;
    }
}