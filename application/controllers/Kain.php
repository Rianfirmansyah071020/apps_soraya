<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Kain extends MY_Controller
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
        $data['content'] = $this->kain->orderBy('id', 'ASC')->get();
        $data['page'] = 'pages/kain/index';
        $data['title'] = 'Daftar Kain';
        $data['nav_title'] = 'kain';
        $data['title_detail'] = 'Daftar Kain';

        $this->view($data);
    }

    public function show_modal_import()
    {
        $this->output->set_output(show_my_modal('pages/kain/modal_import_kain', 'modal-import-kain', '', 'lg'));
    }

    public function import()
    {
        $upload_file = $_FILES['upload_file']['name'];
        $extension = pathinfo($upload_file, PATHINFO_EXTENSION);

        if ($extension == 'csv') {
            $reader = new Csv();
        } else if ($extension == 'xls') {
            $reader = new Xls();
        } else {
            $reader = new Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
        $sheetdata = $spreadsheet->getActiveSheet()->toArray();

        $sheetcount = count($sheetdata);

        if ($sheetcount > 1) {
            $get_kode = $this->kain->select(['id'])->orderBy('id', 'DESC')->first();

            if ($get_kode->id != '') {
                $kode = $get_kode->id;
            } else {
                $kode = 'K0000';
            }
            for ($i = 1; $i < $sheetcount; $i++) {
                $tmp_kode = substr($kode, 1);
                $conv_kode = (int) $tmp_kode;
                $conv_kode++;
                $new_kode = 'K' . sprintf("%04s", $conv_kode);

                $jenis = $sheetdata[$i][1];
                $vendor = $sheetdata[$i][2] == "" ? null : $sheetdata[$i][2];
                $nama = $sheetdata[$i][3];
                $stok = $sheetdata[$i][4];

                $data[] = array(
                    'id'        => $new_kode,
                    'jenis'     => $jenis,
                    'vendor'    => $vendor,
                    'nama'      => $nama,
                    'stok'      => $stok,
                );

                $kode = $new_kode;
            }

            $insertData = $this->kain->insert_batch($data);

            if ($insertData == true) {
                $this->session->set_flashdata('success', 'Berhasil menambahkan data kain');
                redirect(base_url("kain"));
            } else {
                $this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan');
                redirect(base_url("kain"));
            }
        }
    }

    public function generate_kode()
    {
        $get_kode = $this->kain->select(['id'])->orderBy('id', 'DESC')->first();

        if ($get_kode->id != '') {
            $kode = $get_kode->id;
            $tmp_kode = substr($kode, 1);
            $conv_kode = (int) $tmp_kode;
            $conv_kode++;
            $new_kode = 'K' . sprintf("%04s", $conv_kode);
        } else {
            $kode = 'K0000';
            $tmp_kode = substr($kode, 1);
            $conv_kode = (int) $tmp_kode;
            $conv_kode++;
            $new_kode = 'K' . sprintf("%04s", $conv_kode);
        }

        return $new_kode;
    }

    public function add()
    {
        if (!$_POST) {
            $input = (object) $this->kain->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->kain->validate()) {
            $data['title']              = 'Tambah Kain';
            $data['activity']           = 'add';
            $data['nav_title']          = 'kain';
            $data['input']              = $input;
            $data['kode']               = $this->generate_kode();
            $data['form_action']        = base_url('kain/add');
            $data['page']               = 'pages/kain/form';

            $this->view($data);
            return;
        }

        $data = [
            'id'        => $input->id,
            'jenis'     => strtoupper($input->jenis),
            'vendor'    => strtoupper($input->vendor),
            'nama'      => strtoupper($input->nama),
        ];

        if ($this->kain->add($data) == true) {
            $this->session->set_flashdata('success', 'Data has been saved!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url("kain"));
    }

    public function edit($id)
    {
        $data['getData'] = $this->kain->where('id', $id)->first();

        if (!$data['getData']) {
            $this->session->set_flashdata('warning', 'Data Tidak Ditemukan!');
        }

        if (!$_POST) {
            $data['input'] = $data['getData'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->kain->validate()) {
            $data['title']          = 'Edit Kain';
            $data['nav_title']      = 'kain';
            $data['activity']       = 'edit';
            $data['form_action']    = base_url('kain/edit/' . $id);
            $data['page']           = 'pages/kain/form';
            $data['kode']           = $id;

            $this->view($data);
            return;
        }

        if ($this->kain->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data has been updated!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('kain'));
    }

    public function delete($id)
    {
        if ($this->kain->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data has been deleted!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url("kain"));
    }

    public function show_modal_add_stock()
    {
        $data['kain']           = $this->kain->orderBy('created_at', 'DESC')->get();
        $this->output->set_output(show_my_modal('pages/kain/modal_add_stock', 'modal-add-stock', $data, 'lg'));
    }

    public function load_form_add_stock()
    {
        $id_kain = $this->input->get('id_kain', true);
        $data['get_kain']       = $this->kain->where('id', $id_kain)->first();

        $this->output->set_output($this->load->view('pages/kain/form_add_stock', $data, true));
    }

    public function add_stock()
    {
        $id_kain            = $this->input->post('id', true);
        $stok               = $this->input->post('stok', true);

        $data = [];
        $data_update = [];
        $i = 0;
        $digits = 5;
        foreach ($id_kain as $row) {
            if ($stok[$i] != '') {
                array_push($data, [
                    'id'        => date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1),
                    'id_kain'   => $row,
                    'stok'      => $stok[$i],
                ]);

                $get_old_stok = $this->kain->where('id', $row)->first();
                $get_new_stok = $get_old_stok->stok + $stok[$i];

                array_push($data_update, [
                    'id'            => $row,
                    'stok'          => $get_new_stok,
                ]);
            } else {
                array_push($data, [
                    'id'        => date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1),
                    'id_kain'   => $row,
                    'stok'      => 0,
                ]);

                $get_old_stok = $this->kain->where('id', $row)->first();
                $get_new_stok = $get_old_stok->stok + 0;

                array_push($data_update, [
                    'id'            => $row,
                    'stok'          => $get_new_stok,
                ]);
            }

            $i++;
        }

        if ($this->kain->insert_batch_add_stock($data) == true) {
            $this->kain->update_batch_add_stock($data_update, 'id');
            $this->session->set_flashdata('success', 'Berhasil menambahkan stok kain');

            redirect(base_url("kain"));
        }
    }
}
