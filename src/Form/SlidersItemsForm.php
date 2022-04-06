<?php
namespace Sliders\Form;

class SlidersItemsForm extends \Franky\Form\Form
{
    public function __construct($name)
    {

        parent::__construct();

       $this->setAtributos(array(
            'name' => $name,
            'action' =>  "/admin/sliders/items/submit.php",
            'method' => 'post',
            'enctype' => "multipart/form-data"
        ));

        $this->add(array(
                'name' => 'id',
                'type'  => 'hidden',
            )
        );

        $this->add(array(
                'name' => 'id_slider',
                'type'  => 'hidden',
            )
        );

        $this->add(array(
                    'name' => 'callback',
                    'type'  => 'hidden',
                )
        );


        $this->add(array(
                'name' => 'titulo',
                'label' => _sliders('Titulo'),
                'type'  => 'text',
                'required'  => false,
                'atributos' => array(
                    'class'       => '',
                    'maxlength' => 255
                 ),
                'label_atributos' => array(
                    'class'       => 'desc_form_no_obligatorio'
                 )
            )
        );

        $this->add(array(
            'name' => 'descripcion',
            'label' => _sliders('Descripcion'),
            'type'  => 'textarea',
            'required'  => false,
            'atributos' => array(
                'class'       => '',
                'maxlength' => 500
            ),
            'label_atributos' => array(
                'class'       => 'desc_form_obligatorio'
            )
            )
        );
      
        $this->add(array(
            'name' => 'url',
            'label' => _sliders('Url'),
            'type'  => 'text',
            'required'  => false,
            'atributos' => array(
                'class'       => '',
                'maxlength' => 255
             ),
            'label_atributos' => array(
                'class'       => 'desc_form_no_obligatorio'
             )
            )
        );
        
        $this->add(array(
            'name' => 'tipo',
            'label' => _sliders('Tipo'),
            'type'  => 'select',
            'required'  => true,
            'atributos' => array(
                'class'       => 'required'
             ),
            'options' => array(
                'video' => 'Video local',
                'video-embebed' => _sliders('Código embebido'),
                'imagen' => 'imagen'
            ),
            'label_atributos' => array(
                'class'       => 'desc_form_obligatorio'
             )
            )
        );

        $this->add(array(
            'name' => 'file',
            'label' => _sliders('Archivo Slider'),
            'type'  => 'file',
            'atributos' => array(
                'id' => "file"
                )
            )
        );

        $this->add(array(
            'name' => 'file_responsive',
            'label' => _sliders('Archivo Slider mobile'),
            'type'  => 'file',
            'atributos' => array(
                'id' => "file_responsive"
                )
            )
        );

        $this->add(array(
            'name' => 'code',
            'label' =>_sliders( 'Codigo embebido'),
            'type'  => 'textarea',
            'required'  => false,
            'atributos' => array(
                'class'       => '',
                'maxlength' => 255
            ),
            'label_atributos' => array(
                'class'       => 'desc_form_no_obligatorio'
            )
            )
        );
        $this->add(array(
            'name' => 'boton_link',
            'type'  => 'checkbox',
            'atributos' => array(
                'class' => ''
            ),
            'options' =>  array("1" => _sliders("Mostrar boton ver mas")),


            )
        );
        $this->add(array(
                'name' => 'fecha_inicio',
                'label' => _sliders('Fecha de inicio'),
                'type'  => 'date',
                'required'  => false,
                'atributos' => array(
                    'type_mobile' => 'date',
                    'min_year' => date('Y'),
                    'max_year' => date('Y') + 5
                ),
                'label_atributos' => array(
                    'class'       => 'desc_form_no_obligatorio'
                )
            )
        );
    
        $this->add(array(
                'name' => 'fecha_fin',
                'label' => _sliders('Fecha de fin'),
                'type'  => 'date',
                'required'  => false,
                'atributos' => array(
                    'type_mobile' => 'date',
                    'min_year' => date('Y'),
                    'max_year' => date('Y') + 5

                ),
                'label_atributos' => array(
                    'class'       => 'desc_form_no_obligatorio'
                )
            )
        );

         $this->add(array(
                'name' => 'guardar',
                'type'  => 'submit',
                'atributos' => array(
                    'class'       => 'btn btn-primary btn-big float_right',
                    'value' => _sliders("Guardar")
                 )

            )
        );

    }

}
?>
