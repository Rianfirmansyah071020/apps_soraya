<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends MY_Controller
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
        $data['content'] = $this->toko->get();
        $data['page'] = 'pages/toko/index';
        $data['title'] = 'Daftar Toko';
        $data['nav_title'] = 'toko';
        $data['title_detail'] = 'Daftar Toko';

        $this->view($data);
    }

    public function add()
    {
        if (!$_POST) {
            $input = (object) $this->toko->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->toko->validate()) {
            $data['title']          = 'Tambah Toko';

            $data['nav_title']      = 'toko';
            $data['input']          = $input;
            $data['form_action']    = base_url('toko/add');
            $data['page']           = 'pages/toko/form';

            $this->view($data);
            return;
        }

        if ($this->toko->add($input) == true) {
            $this->session->set_flashdata('success', 'Data has been saved!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('toko'));
    }

    public function edit($id)
    {
        $data['getData'] = $this->toko->where('id', $id)->first();

        if (!$data['getData']) {
            $this->session->set_flashdata('warning', 'Data Tidak Ditemukan!');
        }

        if (!$_POST) {
            $data['input'] = $data['getData'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->toko->validate()) {
            $data['title']          = 'Edit Toko';
            $data['nav_title']      = 'toko';
            $data['form_action']    = base_url('toko/edit/' . $id);
            $data['page']           = 'pages/toko/form';

            // var_dump($data['input']);
            // die;

            $this->view($data);
            return;
        }

        if ($this->toko->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data has been updated!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('toko'));
    }

    public function delete($id)
    {
        if ($this->toko->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data has been deleted!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url("toko"));
    }
}

/* End of file Toko.php */
