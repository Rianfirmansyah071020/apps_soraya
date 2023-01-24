<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Mitra_model extends MY_Model
{

    public $table = 'mitra';
    public $perPage = 12;
    public function getDefaultValues()
    {
        return [
            'nama'    => '',
            'tgl_lahir'  => '',
            'tgl_mulai_kerja' => '',
            'nohp' => '',
            'alamat' => '',
            'jenis_kelamin'  => 'perempuan',
            'tempat'  => '',
            'status_nikah' => '',

        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'email',
                'label' => 'Alamat Email',
                'rules' => 'trim|required|valid_email'
            ],

            [
                'field' => 'tgl_mulai_kerja',
                'label' => 'Tanggal Mulai Kerja',
                'rules' => 'required'
            ],

            [
                'field' => 'tgl_lahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'required'
            ],

            [
                'field' => 'nohp',
                'label' => 'No HP',
                'rules' => 'trim|required|numeric'
            ],

            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'jenis_kelamin',
                'label' => 'Jenis Kelamin',
                'rules' => 'required'
            ],

            [
                'field' => 'tempat',
                'label' => 'Tempat',
                'rules' => 'required'
            ],

            [
                'field' => 'status_nikah',
                'label' => 'Status',
                'rules' => 'required'
            ],


        ];

        return $validationRules;
    }

    public function deleteImage($fileName)
    {
        if (file_exists("./images/mitra/$fileName")) {
            unlink("./images/mitra/$fileName");
        }
    }
}

/* End of file Mitra_model.php */
