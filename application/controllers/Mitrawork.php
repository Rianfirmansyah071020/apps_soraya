<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mitrawork extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role == 'admin') {
            // redirect(base_url());
            return;
        } else {
            $this->session->set_flashdata('warning', 'Tidak Mempunyai Akses ke Menu Tersebut');
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $data['content'] = $this->mitrawork->get();
        $data['page'] = 'pages/mitrawork/index';
        $data['title'] = 'Daftar Jenis Pekerjaan Mitra';
        $data['nav_title'] = 'mitrawork';
        $data['title_detail'] = 'Daftar Jenis Pekerjaan Mitra';

        $this->view($data);
    }

    public function add()
    {
        if (!$_POST) {
            $input = (object) $this->mitrawork->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->mitrawork->validate()) {
            $data['title']          = 'Tambah Jenis Pekerjaan Mitra';
            $data['nav_title']      = 'mitrawork';
            $data['input']          = $input;
            $data['form_action']    = base_url('mitrawork/add');
            $data['page']           = 'pages/mitrawork/form';

            $this->view($data);
            return;
        }

        if ($this->mitrawork->add($input) == true) {
            $this->session->set_flashdata('success', 'Data has been saved!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('mitrawork'));
    }

    public function edit($id)
    {
        $data['getData'] = $this->mitrawork->where('id', $id)->first();

        if (!$data['getData']) {
            $this->session->set_flashdata('warning', 'Data Tidak Ditemukan!');
        }

        if (!$_POST) {
            $data['input'] = $data['getData'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->mitrawork->validate()) {
            $data['title']          = 'Edit Jenis Pekerjaan Realisasi';
            $data['nav_title']      = 'jenis_pekerjaan';
            $data['form_action']    = base_url('mitrawork/edit/' . $id);
            $data['page']           = 'pages/mitrawork/form';

            $this->view($data);
            return;
        }

        if ($this->mitrawork->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data has been updated!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('mitrawork'));
    }

    public function delete($id)
    {
        if ($this->mitrawork->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data has been deleted!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }
        redirect(base_url("mitrawork"));
    }
}
