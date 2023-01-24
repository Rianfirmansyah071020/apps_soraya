<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Progress_model extends MY_Model
{

    public $table = 'progress';

    public function getDefaultValues()
    {
        return [

            'id'       => '',
            'motif'    => '',
            'id_toko' => '',
            'estimasi' => '',
            'is_preorder' => '',
            'keterangan' => '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'motif',
                'label' => 'Motif',
                'rules' => 'trim|required'
            ],
        ];

        return $validationRules;
    }
}

/* End of file Progress_model.php */
