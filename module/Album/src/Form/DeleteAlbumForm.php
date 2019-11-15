<?php
namespace Album\Form;

use Zend\Form\Form;

class DeleteAlbumForm extends Form
{
    public function __construct($name = null)
    {
        // name of the form
        parent::__construct('deleteAlbum');

        // for each field in the form, add an item
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'del',
            'type' => 'submit',
            'attributes' => [
                'value' => 'No',
                'id' => 'del',
            ],
        ]);
    }
}