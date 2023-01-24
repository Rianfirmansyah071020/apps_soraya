<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Work_model extends MY_Model {

    
    public $table = 'jenis_pekerjaan';

    public function getDefaultValues()
    {
        return [
            'nama_pekerjaan'          => '',
            'keterangan'              => '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_pekerjaan',
                'label' => 'Nama Pekerjaan',
                'rules' => 'trim|required'
            ],

           


        ];

        return $validationRules;
    }
}

/* End of file Work_model.php */
