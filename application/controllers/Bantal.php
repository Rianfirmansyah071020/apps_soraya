<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Bantal extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role == 'admin') {
            return;
        } else {
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $data['content'] = $this->bantal->get();
        $data['page'] = 'pages/bantal/index';
        $data['title'] = 'Daftar Jenis Bantal';
        $data['nav_title'] = 'jenis_bantal';
        $data['title_detail'] = 'Daftar Jenis Bantal';

        $this->view($data);
    }

    public function add()
    {
        if (!$_POST) {
            $input = (object) $this->bantal->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->bantal->validate()) {
            $data['title']          = 'Tambah Jenis Bantal';

            $data['nav_title']      = 'jenis_bantal';
            $data['input']          = $input;
            $data['form_action']    = base_url('bantal/add');
            $data['page']           = 'pages/bantal/form';

            $this->view($data);
            return;
        }

        if ($this->bantal->add($input) == true) {
            $this->session->set_flashdata('success', 'Data has been saved!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('bantal'));
    }

    public function edit($id)
    {
        $data['getData'] = $this->bantal->where('id', $id)->first();

        if (!$data['getData']) {
            $this->session->set_flashdata('warning', 'Data Tidak Ditemukan!');
        }

        if (!$_POST) {
            $data['input'] = $data['getData'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->bantal->validate()) {
            $data['title']          = 'Edit Jenis Bantal';
            $data['nav_title']      = 'jenis_bantal';
            $data['form_action']    = base_url('bantal/edit/' . $id);
            $data['page']           = 'pages/bantal/form';

            $this->view($data);
            return;
        }

        if ($this->bantal->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data has been updated!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('bantal'));
    }

    public function delete($id)
    {
        if ($this->bantal->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data has been deleted!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url("bantal"));
    }
}

/* End of file Bantal.php */
