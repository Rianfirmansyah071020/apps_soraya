<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Work extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');
        $nama = $this->session->userdata('nama');
        if ($role == 'admin' || $role == 'admin_distribusi') {
            return;
        } else {
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $data['content'] = $this->work->get();
        $data['page'] = 'pages/work/index';
        $data['title'] = 'Daftar Jenis Pekerjaan Realisasi Perencanaan';
        $data['nav_title'] = 'jenis_pekerjaan';
        $data['title_detail'] = 'Daftar Jenis Pekerjaan Realisasi Perencanaan';

        $this->view($data);
    }

    public function add()
    {
        if (!$_POST) {
            $input = (object) $this->work->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->work->validate()) {
            $data['title']          = 'Tambah Jenis Pekerjaan Realisasi';

            $data['nav_title']      = 'jenis_pekerjaan';
            $data['input']          = $input;
            $data['form_action']    = base_url('work/add');
            $data['page']           = 'pages/work/form';

            $this->view($data);
            return;
        }

        if ($this->work->add($input) == true) {
            $this->session->set_flashdata('success', 'Data has been saved!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('work'));
    }

    public function edit($id)
    {
        $data['getData'] = $this->work->where('id', $id)->first();

        if (!$data['getData']) {
            $this->session->set_flashdata('warning', 'Data Tidak Ditemukan!');
        }

        if (!$_POST) {
            $data['input'] = $data['getData'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->work->validate()) {
            $data['title']          = 'Edit Jenis Pekerjaan Realisasi';
            $data['nav_title']      = 'jenis_pekerjaan';
            $data['form_action']    = base_url('work/edit/' . $id);
            $data['page']           = 'pages/work/form';

            $this->view($data);
            return;
        }

        if ($this->work->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data has been updated!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('work'));
    }

    public function delete($id)
    {
        if ($this->work->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data has been deleted!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url("work"));
    }
}
