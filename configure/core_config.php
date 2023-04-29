<?php
return array(
  'sliders' => array(
          'menu' => "SLIDERS",
          'title' => "Configuración de sliders",
          'config' =>  array(
                    
                
                  array('path' => 'sliders/slider/showdelete',
                        'type' => 'select',
                        'label' => '¿Mostrar sliders eliminados?',
                        'validation' => array('required' => false),
                        'data' => ['0' => 'No', '1' => 'Si'],
                        'value' => '0'
                      ),
                      array('path' => 'sliders/slideritem/showdelete',
                      'type' => 'select',
                      'label' => '¿Mostrar items eliminados en sliders?',
                      'validation' => array('required' => false),
                      'data' => ['0' => 'No', '1' => 'Si'],
                      'value' => '0'
                    ),
                   
          )
  )
);

?>
