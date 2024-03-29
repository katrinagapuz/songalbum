<?php
namespace Album\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Date;

class Album implements InputFilterAwareInterface
{
    public $id;
    public $artist;
    public $title;
    public $date;

    private $inputFilter;

    // album setter
    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->artist = !empty($data['artist']) ? $data['artist'] : null;
        $this->title = !empty($data['title']) ? $data['title'] : null;
        $this->date = !empty($data['date']) ? $data['date'] : null;
    }

    // album getter
    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'artist' => $this->artist,
            'title' => $this->title,
            'date' => $this->date,
        ];
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf('$s does not allow injection of an alternate input filter', __CLASS__));
    }

    public function getInputFilter()
    {
        // if it's already instantiated, just return filter
        if($this->inputFilter) {
            return $this->inputFilter;
        }

        // otherwise, create new
        $inputFilter = new InputFilter();

        // for each form element we want to validate, create an input
        $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'artist',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'title',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'date',
            'required' => true,
            'validators' => [
                [
                    'name' => Date::class,
                ],
            ],
        ]);

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}