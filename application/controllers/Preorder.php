<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends MY_Controller
{
    public function __construct()
    {
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
        $data['content'] = $this->pembelian->get();
        $data['page'] = 'pages/pembelian/index';
        $data['title'] = 'Daftar Pembelian Barang';
        $data['nav_title'] = 'pembelian';
        $data['title_detail'] = 'Daftar Pembelian Barang';
        $this->view($data);
    }
}
