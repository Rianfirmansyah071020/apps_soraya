<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Kain_model extends MY_Model
{

    public $table = 'kain';

    public function getDefaultValues()
    {
        return [
            'jenis'       => '',
            'vendor'      => '',
            'nama'        => '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'jenis',
                'label' => 'Jenis Kain',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'nama',
                'label' => 'Nama Motif',
                'rules' => 'trim|required'
            ],




        ];

        return $validationRules;
    }

    public function insert_batch($data)
    {
        $this->db->insert_batch($this->table, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_batch_add_stock($data)
    {
        $this->db->insert_batch('stok_kain', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_batch_add_stock($data, $key)
    {
        $this->db->update_batch($this->table, $data, $key);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file Kain_model.php */
