<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Mitrawork_model extends MY_Model
{

    public function getDefaultValues()
    {
        return [
            'nama_mitrawork'   => '',
            'ket'              => '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_mitrawork',
                'label' => 'Nama Pekerjaan Mitra',
                'rules' => 'trim|required'
            ],




        ];

        return $validationRules;
    }
}

/* End of file Mitrawork_model.php */
