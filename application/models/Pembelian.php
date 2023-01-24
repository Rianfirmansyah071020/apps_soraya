<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pembelian extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');
        if ($role == 'admin') {
            // redirect(base_url());
            return;
        } else {
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $data['content'] = $this->pembelian->get();
        $data['page'] = 'pages/pembelian/index';
        $data['title'] = 'Daftar Pembelian Barang';
        $data['nav_title'] = 'pembelian';
        $data['title_detail'] = 'Daftar Pembelian Barang';
        //$this->show_table($data);
        $this->view($data);
    }

    public function add()
    {
        if (!$_POST) {
            $input = (object) $this->pembelian->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }
        if (!$this->pembelian->validate()) {
            $data['title']          = 'Tambah Data Pembelian';
            $data['nav_title']      = 'pembelian';
            $data['input']          = $input;
            $data['form_action']    = base_url('pembelian/add');
            $data['page']           = 'pages/pembelian/form';
            $this->view($data);
            return;
        }

        //proses penambahan product dan memasukkannya ke dalam db
        if ($this->pembelian->add($input,) == true) {
            $this->session->set_flashdata('success', 'Data has been saved!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }
        redirect(base_url('pembelian'));
    }



    public function edit($id)
    {
        $data['getData'] = $this->pembelian->where('id', $id)->first();
        if (!$data['getData']) {
            $this->session->set_flashdata('warning', 'Data Tidak Ditemukan!');
        }

        if (!$_POST) {
            $data['input'] = $data['getData'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->pembelian->validate()) {
            $data['title']          = 'Edit Data Pembelian';
            $data['nav_title']      = 'pembelian';
            $data['form_action']    = base_url('pembelian/edit/' . $id);
            $data['page']           = 'pages/pembelian/form';
            $this->view($data);
            return;
        }

        if ($this->pembelian->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data has been updated!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('pembelian'));
    }

    public function delete($id)
    {
        if ($this->pembelian->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data has been deleted!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url("pembelian"));
    }
}


/* End of file Bantal.php */
