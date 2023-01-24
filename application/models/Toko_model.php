<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko_model extends MY_Model
{
    public $table = 'toko';

    public function getDefaultValues()
    {
        return [
            'nama_toko'       => '',
            'keterangan'      => '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_toko',
                'label' => 'Nama Toko',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'keterangan',
                'label' => 'Keterangan',
            ],
        ];
        return $validationRules;
    }
}



/* End of file Bantal_model.php */
