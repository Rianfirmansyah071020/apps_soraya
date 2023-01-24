<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian_model extends MY_Model
{
    public $table = 'pembelian';

    public function getDefaultValues()
    {
        return [
            'kd_barang'       => '',
            'nama'            => '',
            'jumlah'          => '',
            'harga'           => '',
            'created_at'      => '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'kd_barang',
                'label' => 'Kode Barang',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'nama',
                'label' => 'Jenis Bantal',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'jumlah',
                'label' => 'Jumlah',
                'rules' => 'trim|required|numeric'
            ],
            [
                'field' => 'harga',
                'label' => 'Harga',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'created_at',
                'label' => 'Created At',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'updated_at',
                'label' => 'Updated At',
                'rules' => 'trim|required'
            ],

        ];
        return $validationRules;
    }
}



/* End of file Bantal_model.php */
