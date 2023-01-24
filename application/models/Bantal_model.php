<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Bantal_model extends MY_Model {

    public $table = 'jenis_bantal';

    public function getDefaultValues()
    {
        return [
            'nama_jenis_bantal'       => '',
            'ket'                     => '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_jenis_bantal',
                'label' => 'Jenis Bantal',
                'rules' => 'trim|required'
            ],

           


        ];

        return $validationRules;
    }

}

/* End of file Bantal_model.php */
