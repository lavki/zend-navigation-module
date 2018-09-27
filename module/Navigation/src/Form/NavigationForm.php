<?php

namespace Navigation\Form;

use Zend\Filter;
use Zend\Validator;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Navigation\Entity\Navigation;

class NavigationForm extends Form
{
    /**
     * NavigationForm constructor.
     * @param null $name
     * @param array $options
     */
    public function __construct()
    {
        parent::__construct( 'navigation-form' );

        $this->addElements();       // add all elements of needed
        $this->addInputFilter();    // filtering and validating data
    }

    private function addElements()
    {
        // Adding field 'title'
        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'title',
            'attributes' => [
                'id'          => 'title',
                'class'       => 'form-control',
                'placeholder' => 'Home',
            ],
            'options' => [
                'label' => 'Name:',
            ],
        ]);

        // Adding field 'link'
        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'link',
            'attributes' => [
                'id'          => 'link',
                'class'       => 'form-control',
                'placeholder' => 'link',
            ],
            'options' => [
                'label' => 'Link:',
            ],
        ]);

        /*
        // Adding field 'parentId'
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'parentId',
            'attributes' => [
                'id'          => 'parentId',
                'class'       => 'form-control',
                'placeholder' => 'link',
            ],
            'options' => [
                'label' => 'Parent item:',
            ],
        ]);

        // Adding field "orderId"
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'orderId',
            'attributes' => [
                'id'          => 'orderId',
                'class'       => 'form-control',
            ],
            'options' => [
                'label' => '-- порядок меню --',
            ],
        ]);
        */

        // Adding field 'status'
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'status',
            'attributes' => [
                'id'          => 'status',
                'class'       => 'form-control',
            ],
            'options' => [
                'label' => 'Status:',
                'value_options' => [
                    Navigation::VISIBLE   => 'Visible',
                    Navigation::INVISIBLE => 'Invisible'
                ],
            ],
        ]);

        // Adding 'submit' button
        $this->add([
            'type'  => Element\Submit::class,
            'name'  => 'submit',
            'attributes' => [
                'value' => 'Create',
                'id'    => 'submit',
            ],
        ]);
    }

    private function addInputFilter()
    {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        // filtering and validating field 'title'
        $inputFilter->add([
            'name'     => 'title',
            'required' => true,
            'filters'  => [
                ['name' => Filter\StringTrim::class],
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StripNewlines::class],
            ],
            'validators' => [
                [
                    'name'    => Validator\StringLength::class,
                    'options' => ['min' => 1, 'max' => 30],
                ],
            ],
        ]);

        // filtering and validating field 'title'
        $inputFilter->add([
            'name'     => 'link',
            'required' => true,
            'filters'  => [
                ['name' => Filter\StringTrim::class],
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StripNewlines::class],
            ],
            'validators' => [
                [
                    'name'    => Validator\StringLength::class,
                    'options' => ['min' => 1, 'max' => 30],
                ],
            ],
        ]);

        // filtering and validating field 'status'
        $inputFilter->add([
            'name'       => 'status',
            'required'   => true,
            'validators' => [
                [
                    'name'   => Validator\InArray::class,
                    'options'=> [
                        'haystack' => [Navigation::VISIBLE, Navigation::INVISIBLE],
                    ]
                ],
            ],
        ]);
    }
}