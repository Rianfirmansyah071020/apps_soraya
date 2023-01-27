<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Progress extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('mypdf');
        $role = $this->session->userdata('role');
        if ($role == 'admin' || $role == 'admin_gunting' || $role == 'admin_operator') {
            return;
        } else {
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $data['content'] = $this->progress
            ->select([
                'progress.id',
                'progress.motif',
                'progress.estimasi',
                'progress.tanggal',
                'progress.tanggal_rencana',
                'progress.is_preorder',
                'progress.id_toko',
                'progress.keterangan',
                'toko.nama_toko',
            ])
            ->join('toko')

            ->where('YEAR(tanggal)', date("Y"))
            ->where('MONTH(tanggal)', date("m"))
            ->orderBy('tanggal', 'DESC')->get();
        $data['page'] = 'pages/progress/index';
        $data['title'] = 'Daftar Progress';
        $data['nav_title'] = 'progress';
        $data['title_detail'] = 'Daftar Progress';

        $this->view($data);
    }

    public function filter($month, $year, $po)
    {
        $data['content'] = $this->progress
            ->select([
                'progress.id',
                'progress.motif',
                'progress.estimasi',
                'progress.tanggal',
                'progress.tanggal_rencana',
                'progress.is_preorder',
                'progress.id_toko',
                'progress.keterangan',
                'toko.nama_toko',
            ])
            ->join('toko')
            ->where('MONTH(tanggal)', $month)
            ->where('YEAR(tanggal)', $year)
            ->where('is_preorder', $po)
            ->orderBy('tanggal', 'DESC')
            ->get();

        $data['title'] = 'Daftar Progress';
        $data['nav_title'] = 'progress';
        $data['title_detail'] = 'Daftar Progress';

        $this->load->view('pages/progress/table', $data);
    }

    public function filterRealisasi($month, $year)
    {
        $data['content'] = $this->progress
            ->select([
                'progress.id',
                'progress.motif',
                'progress.estimasi',
                'progress.tanggal',
                'progress.tanggal_rencana',
                'progress.is_preorder',
                'progress.id_toko',
                'progress.keterangan',
                'toko.nama_toko',
            ])
            ->join('toko')
            ->where('MONTH(tanggal)', $month)->where('YEAR(tanggal)', $year)->orderBy('tanggal', 'DESC')->get();
        $data['title'] = 'Daftar Progress';
        $data['nav_title'] = 'progress';
        $data['title_detail'] = 'Daftar Progress';

        $this->load->view('pages/progress/table_realisasi', $data);
    }

    public function filterRealisasiBasedOnJenisPekerjaan($id_jenis_pekerjaan = '')
    {
        $month = $this->input->post('month', true);
        $year = $this->input->post('year', true);

        if ($id_jenis_pekerjaan != '') {
            if ($month == "" && $year == "") {
                $sql = "SELECT DISTINCT perencanaan.id_progress AS id, progress.motif, progress.tanggal, progress.is_preorder, progress.estimasi, progress.id_toko, progress.keterangan FROM `perencanaan`, progress, jenis_pekerjaan WHERE progress.id = perencanaan.id_progress AND perencanaan.id_jenis_pekerjaan = jenis_pekerjaan.id AND id_jenis_pekerjaan = '$id_jenis_pekerjaan'  ORDER BY tanggal DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else if ($month != "" && $year == "") {
                $sql = "SELECT DISTINCT perencanaan.id_progress AS id, progress.motif, progress.tanggal, progress.is_preorder, progress.estimasi, progress.id_toko, progress.keterangan FROM `perencanaan`, progress, jenis_pekerjaan WHERE progress.id = perencanaan.id_progress AND perencanaan.id_jenis_pekerjaan = jenis_pekerjaan.id AND id_jenis_pekerjaan = '$id_jenis_pekerjaan' AND MONTH(tanggal) = '$month'  ORDER BY tanggal DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else if ($month == "" && $year != "") {
                $sql = "SELECT DISTINCT perencanaan.id_progress AS id, progress.motif, progress.tanggal, progress.is_preorder, progress.estimasi, progress.id_toko, progress.keterangan FROM `perencanaan`, progress, jenis_pekerjaan WHERE progress.id = perencanaan.id_progress AND perencanaan.id_jenis_pekerjaan = jenis_pekerjaan.id AND id_jenis_pekerjaan = '$id_jenis_pekerjaan' AND YEAR(tanggal) = '$year' ORDER BY tanggal DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else {
                $sql = "SELECT DISTINCT perencanaan.id_progress AS id, progress.motif, progress.tanggal, progress.is_preorder, progress.estimasi, progress.id_toko, progress.keterangan FROM `perencanaan`, progress, jenis_pekerjaan WHERE progress.id = perencanaan.id_progress AND perencanaan.id_jenis_pekerjaan = jenis_pekerjaan.id AND id_jenis_pekerjaan = '$id_jenis_pekerjaan' AND MONTH(tanggal) = '$month' AND YEAR(tanggal) = '$year' ORDER BY tanggal DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            }
        } else {
            if ($month == "" && $year == "") {
                $month = date('m');
                $year = date('Y');
                $sql = "SELECT DISTINCT perencanaan.id_progress AS id, progress.motif, progress.tanggal, progress.is_preorder, progress.estimasi, progress.id_toko, progress.keterangan FROM `perencanaan`, progress, jenis_pekerjaan WHERE progress.id = perencanaan.id_progress AND perencanaan.id_jenis_pekerjaan = jenis_pekerjaan.id AND MONTH(tanggal) = '$month' AND YEAR(tanggal) = '$year'  ORDER BY tanggal DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else if ($month != "" && $year == "") {
                $sql = "SELECT DISTINCT perencanaan.id_progress AS id, progress.motif, progress.tanggal, progress.is_preorder, progress.estimasi, progress.id_toko, progress.keterangan FROM `perencanaan`, progress, jenis_pekerjaan WHERE progress.id = perencanaan.id_progress AND perencanaan.id_jenis_pekerjaan = jenis_pekerjaan.id AND MONTH(tanggal) = '$month' ORDER BY tanggal DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else if ($month == "" && $year != "") {
                $sql = "SELECT DISTINCT perencanaan.id_progress AS id, progress.motif, progress.tanggal, progress.is_preorder, progress.estimasi, progress.id_toko, progress.keterangan FROM `perencanaan`, progress, jenis_pekerjaan WHERE progress.id = perencanaan.id_progress AND perencanaan.id_jenis_pekerjaan = jenis_pekerjaan.id AND YEAR(tanggal) = '$year' ORDER BY tanggal DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else {
                $sql = "SELECT DISTINCT perencanaan.id_progress AS id, progress.motif, progress.tanggal, progress.is_preorder, progress.estimasi, progress.id_toko, progress.keterangan FROM `perencanaan`, progress, jenis_pekerjaan WHERE progress.id = perencanaan.id_progress AND perencanaan.id_jenis_pekerjaan = jenis_pekerjaan.id AND MONTH(tanggal) = '$month' AND YEAR(tanggal) = '$year' ORDER BY tanggal DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            }
        }

        $data['list_progress'] = [];
        foreach ($data['content'] as $row) {
            if (checkRealisasi($row->id) > 0) {
                array_push($data['list_progress'], $row->id);
            }
        }

        $data['title'] = 'Daftar Progress';
        $data['nav_title'] = 'progress';
        $data['title_detail'] = 'Daftar Progress';
        $this->load->view('pages/progress/table_realisasi', $data);
    }

    public function add()
    {
        //echo $this->codeGenerator();
        if (!$_POST) {
            $input = (object) $this->progress->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        //proses validasi form
        if (!$this->progress->validate()) {
            $data['title']          = 'Tambah Progress';
            $data['id']             = $this->codeGenerator();
            $data['nav_title']      = 'progress';
            $data['input']          = $input;
            $data['form_action']    = base_url('progress/add');
            $data['page']           = 'pages/progress/form';
            $data['toko']           = $this->toko->get();


            $this->view($data);
            return;
        }

        if ($input->estimasi != "") {
            $input->estimasi = date('Y-m-d', strtotime($input->estimasi));
            // cek jika input estimasi atau input id toko tidak kosong, maka is_preorder = 1
            if ($input->estimasi != "" || $input->id_toko != "") {
                $input->is_preorder = 1;
            } else {
                $input->is_preorder = 0;
            }
        } else {
            $input->estimasi = null;
            $input->is_preorder = 0;
        }

        // var_dump($input);
        // die;

        //proses penambahan product dan memasukkannya ke dalam db
        if ($this->progress->add($input) == true) {

            $this->session->set_flashdata('success', 'Data has been saved!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('progress'));
    }

    public function edit($id = null)
    {
        $data['content'] = $this->progress->where('id', $id)->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Sorry, data not found');
            redirect(base_url('progress'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->progress->validate()) {
            $data['title']          = 'Tambah Progress';
            $data['id']             = $id;
            $data['nav_title']      = 'progress';
            $data['form_action']    = base_url("progress/edit/$id");
            $data['page']           = 'pages/progress/form';
            $data['toko']           = $this->toko->get();
            $this->view($data);
            return;
        }
        if ($data['input']->estimasi != "") {
            $data['input']->estimasi = date('Y-m-d', strtotime($data['input']->estimasi));
            // cek jika input estimasi atau input id toko tidak kosong, maka is_preorder = 1
            if ($data['input']->estimasi != "" || $data['input']->id_toko != "") {
                $data['input']->is_preorder = 1;
            } else {
                $data['input']->is_preorder = 0;
            }
        } else if ($data['input']->estimasi == "" && $data['input']->id_toko != "") {
            $data['input']->estimasi = date('Y-m-d', strtotime($data['input']->estimasi));
            // hapus value estimasi
            $data['input']->estimasi = null;
            $data['input']->is_preorder = 1;
        } else {
            $data['input']->estimasi = null;
            $data['input']->is_preorder = 0;
        }

        if ($this->progress->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data has been updated!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('progress'));
    }

    public function delete($id)
    {
        if ($this->progress->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data has been deleted!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }
        redirect(base_url("progress"));
    }

    public function add_plan($id = null)
    {
        $data['content'] = $this->progress->where('id', $id)->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Sorry, data not found');
            redirect(base_url('progress'));
        }

        $this->progress->table = 'jenis_pekerjaan';
        $data['jenis_pekerjaan'] = $this->progress->get();
        $data['title'] = 'Tambah Perencanaan';
        $data['nav_title'] = 'progress';
        $data['page'] = 'pages/progress/form_plan';
        $this->view($data);
    }

    public function insert_plan()
    {
        $idProgress = $this->input->post('id_progress', true);
        $idPekerjaan = $this->input->post('id_jenis_pekerjaan', true);
        $idMitra = $this->input->post('id_mitra', true);
        $idBantal = $this->input->post('id_jenis_bantal', true);
        $kuantitas = $this->input->post('qty', true);
        $data = array();
        $i = 0;

        foreach ($idProgress as $row) {
            $this->progress->table = 'perencanaan';
            $ambilPerencanaan =  $this->progress->where('perencanaan.id_progress', $row)
                ->where('perencanaan.id_jenis_pekerjaan', $idPekerjaan[$i])
                ->where('perencanaan.id_jenis_bantal', $idBantal[$i])
                ->count();

            if ($ambilPerencanaan > 0) {
                $data_update = array(
                    'qty' => $kuantitas[$i]
                );

                $this->progress->where('perencanaan.id_progress', $row)
                    ->where('perencanaan.id_jenis_pekerjaan', $idPekerjaan[$i])
                    ->where('perencanaan.id_jenis_bantal', $idBantal[$i])
                    ->update($data_update);
            } else {
                array_push($data, array(
                    'id_progress' => $row,
                    'id_jenis_pekerjaan' => $idPekerjaan[$i],
                    'id_jenis_bantal' => $idBantal[$i],
                    'qty'   => $kuantitas[$i],
                    'nama_admin' => $this->session->userdata('name')
                ));
            }

            $i++;
        }

        $digits = 4;
        $id_penggunting = date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $data_penggunting = array(
            'id'            => $id_penggunting,
            'id_progress'   => $this->input->post('idProgress', true),
            'id_mitra'      => $idMitra,
        );

        $this->db->insert('penggunting', $data_penggunting);
        if (count($data) > 0) {
            if ($this->db->insert_batch('perencanaan', $data)) {
                $this->session->set_flashdata('success', 'Data has been saved!');
                redirect('progress');
            }
        } else {
            $this->session->set_flashdata('success', 'Data has been saved!');
            redirect('progress');
        }
    }

    public function edit_plan($id_progress)
    {
        $this->progress->table = 'perencanaan';
        $data['getPerencanaan'] = $this->progress->select([
            'perencanaan.id AS id_perencanaan', 'perencanaan.id_progress', 'perencanaan.id_jenis_pekerjaan', 'perencanaan.id_jenis_bantal',
            'perencanaan.qty', 'perencanaan.nama_admin', 'perencanaan.id_satuan',
            'jenis_pekerjaan.nama_pekerjaan', 'jenis_bantal.nama_jenis_bantal', 'satuan.nama_satuan'
        ])
            ->join('jenis_pekerjaan')
            ->join('jenis_bantal')
            ->join('satuan')
            ->where('id_progress', $id_progress)
            ->get();

        $this->progress->table = 'mitra';
        $data['getMitra'] = $this->progress->get();

        $this->progress->table = 'satuan';
        $data['getSatuan'] = $this->progress->get();

        $this->progress->table = 'penggunting';
        $data['getPenggunting'] = $this->progress->where('id_progress', $id_progress)->first();
        $data['id']        = $id_progress;

        $data['page']      = 'pages/progress/form_edit_plan';
        $data['title']     = 'Form Edit Perencanaan';
        $data['nav_title'] = 'progress';

        $this->view($data);
    }

    public function update_plan()
    {
        $idProgress = $this->input->post('id_progress', true);
        $idPerencanaan = $this->input->post('id_perencanaan', true);
        $idSatuan = $this->input->post('id_satuan', true);
        $idJenisPekerjaan = $this->input->post('id_jenis_pekerjaan', true);
        $idJenisBantal = $this->input->post('id_jenis_bantal', true);
        $kuantitas = $this->input->post('qty', true);
        $data_update = array();

        $i = 0;
        foreach ($idProgress as $row) {
            $data_update[] = array(
                'id'            => $idPerencanaan[$i],
                'id_progress'   => $row,
                'id_jenis_pekerjaan' => $idJenisPekerjaan[$i],
                'id_jenis_bantal' => $idJenisBantal[$i],
                'qty'   => $kuantitas[$i],
                'id_satuan' => $idSatuan[$i],
                'nama_admin' => $this->session->userdata('name')
            );
            $i++;
        }

        if (count($data_update) > 0) {
            $data_penggunting  = array(
                'id_mitra' => $this->input->post('id_mitra', true)
            );
            $this->progress->table = 'penggunting';

            if ($this->db->update_batch('perencanaan', $data_update, 'id') && $this->progress->where('id_progress', $this->input->post('idProgress', true))->update($data_penggunting)) {
                $this->session->set_flashdata('success', 'Data has been updated!');
            } else {
                if ($this->progress->where('id_progress', $this->input->post('idProgress', true))->update($data_penggunting)) {
                    $this->session->set_flashdata('success', 'Data has been updated!');
                } else {
                    $this->session->set_flashdata('error', 'Oops! Something went wrong');
                }
            }
        } else {
            $this->session->set_flashdata('warning', 'Data has not found!');
        }
        redirect(base_url('progress'));
    }

    public function show_delete($id_progress)
    {
        $this->progress->table = 'perencanaan';
        $data['getPerencanaan'] = $this->progress->select([
            'perencanaan.id AS id_perencanaan', 'perencanaan.id_progress', 'perencanaan.id_jenis_pekerjaan', 'perencanaan.id_jenis_bantal',
            'perencanaan.qty', 'perencanaan.nama_admin',
            'jenis_pekerjaan.nama_pekerjaan', 'jenis_bantal.nama_jenis_bantal'
        ])
            ->join('jenis_pekerjaan')
            ->join('jenis_bantal')
            ->where('id_progress', $id_progress)
            ->get();

        $this->progress->table = 'mitra';
        $data['getMitra'] = $this->progress->get();

        $this->progress->table = 'penggunting';
        $data['getPenggunting'] = $this->progress->where('id_progress', $id_progress)->first();

        $data['id']        = $id_progress;
        $data['page']      = 'pages/progress/form_delete_plan';
        $data['title']     = 'Form Hapus Perencanaan';

        $data['nav_title'] = 'progress';
        $this->view($data);
    }

    public function delete_plan()
    {
        $id = $_POST['id'];
        $this->progress->table = 'perencanaan';
        $plan = $this->progress->whereIn('id', $id)->get();

        if (isset($id)) {
            foreach ($plan as $row) {
                if ($this->progress->where('id', $row->id)->delete()) {
                    $this->session->set_flashdata('success', 'Data Planning Telah Berhasil dihapus');
                } else {
                    $this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan');
                }
            }
        } else {
            $this->session->set_flashdata('warning', 'Belum Memilih Data');
        }
        redirect(base_url('progress'));
    }

    public function cetakPdf($data, $id_progress)
    {
        $this->mypdf->generate('pages/progress/cetak_plan', $data, 'kartu_order_bal_' . $id_progress, 'A4', 'landscape');
    }

    public function loadCetak($id_progress)
    {
        $this->progress->table = 'perencanaan';
        $data['id_progress'] = $id_progress;
        $data['perencanaan'] = $this->progress->select([
            'jenis_pekerjaan.nama_pekerjaan', 'perencanaan.id_progress', 'perencanaan.qty', 'perencanaan.id_jenis_bantal', 'perencanaan.id_jenis_pekerjaan'
        ])
            ->join('jenis_pekerjaan')
            ->where('perencanaan.id_progress', $id_progress)
            ->get();

        $data['nama_admin'] = $this->progress->select([
            'perencanaan.nama_admin'
        ])
            ->where('perencanaan.id_progress', $id_progress)
            ->first();
        $this->progress->table = 'progress';
        $data['tanggal_progress'] = $this->progress->where('id', $id_progress)->first();

        $this->progress->table = 'jenis_bantal';
        $data['jenis_bantal'] = $this->progress->get();

        $data['jumlahBantal'] = $this->progress->count();

        foreach ($data['jenis_bantal'] as $row) {
            $this->progress->table = 'perencanaan';
            $data['total']['bt' . $row->id] =
                $this->progress->where('perencanaan.id_jenis_bantal', $row->id)
                ->where('perencanaan.id_progress', $id_progress)
                ->get();
        }

        $this->progress->table = 'penggunting';
        $data['penggunting'] = $this->progress->select([
            'mitra.nama'
        ])
            ->join('mitra')
            ->where('penggunting.id_progress', $id_progress)
            ->first();

        $this->progress->table = 'jenis_pekerjaan';
        $data['jenis_pekerjaan'] = $this->progress->get();

        // $data['total_love'] = $this->progress->where('perencanaan.id_jenis_bantal', 1)->where('perencanaan.id_progress', $id_progress)->get();
        // $data['total_bt'] = $this->progress->where('perencanaan.id_jenis_bantal', 2)->where('perencanaan.id_progress', $id_progress)->get();
        // $data['total_bis'] = $this->progress->where('perencanaan.id_jenis_bantal', 3)->where('perencanaan.id_progress', $id_progress)->get();
        // $data['total_rc'] = $this->progress->where('perencanaan.id_jenis_bantal', 4)->where('perencanaan.id_progress', $id_progress)->get();
        // $data['total_dsc'] = $this->progress->where('perencanaan.id_jenis_bantal', 5)->where('perencanaan.id_progress', $id_progress)->get();
        // $this->cetakPdf($data, $id_progress);
        //print_r($data['total']['bt1']);

        $this->load->view('pages/progress/cetak_plan', $data);
    }

    public function excel($id_progress)
    {
        $this->progress->table = 'perencanaan';
        $data['id_progress'] = $id_progress;
        $data['perencanaan'] = $this->progress->select([
            'jenis_pekerjaan.nama_pekerjaan', 'perencanaan.id_progress', 'perencanaan.qty', 'perencanaan.id_jenis_bantal', 'perencanaan.id_jenis_pekerjaan'
        ])
            ->join('jenis_pekerjaan')
            ->where('perencanaan.id_progress', $id_progress)
            ->get();

        $data['nama_admin'] = $this->progress->select([
            'perencanaan.nama_admin'
        ])
            ->where('perencanaan.id_progress', $id_progress)
            ->first();
        $this->progress->table = 'progress';
        $data['tanggal_progress'] = $this->progress->where('id', $id_progress)->first();
        $this->progress->table = 'jenis_bantal';
        $data['jenis_bantal'] = $this->progress->get();
        $data['jumlahBantal'] = $this->progress->count();

        foreach ($data['jenis_bantal'] as $row) {
            $this->progress->table = 'perencanaan';
            $data['total']['bt' . $row->id] =
                $this->progress->where('perencanaan.id_jenis_bantal', $row->id)
                ->where('perencanaan.id_progress', $id_progress)
                ->get();
        }
        $this->progress->table = 'penggunting';
        $data['penggunting'] = $this->progress->select([
            'mitra.nama'
        ])
            ->join('mitra')
            ->where('penggunting.id_progress', $id_progress)
            ->first();

        $this->progress->table = 'jenis_pekerjaan';
        $data['jenis_pekerjaan'] = $this->progress->get();
        // $data['total_love'] = $this->progress->where('perencanaan.id_jenis_bantal', 1)->where('perencanaan.id_progress', $id_progress)->get();
        // $data['total_bt'] = $this->progress->where('perencanaan.id_jenis_bantal', 2)->where('perencanaan.id_progress', $id_progress)->get();
        // $data['total_bis'] = $this->progress->where('perencanaan.id_jenis_bantal', 3)->where('perencanaan.id_progress', $id_progress)->get();
        // $data['total_rc'] = $this->progress->where('perencanaan.id_jenis_bantal', 4)->where('perencanaan.id_progress', $id_progress)->get();
        // $data['total_dsc'] = $this->progress->where('perencanaan.id_jenis_bantal', 5)->where('perencanaan.id_progress', $id_progress)->get();
        // $this->cetakPdf($data, $id_progress);
        //print_r($data['total']['bt1']);
        $this->load->view('pages/progress/table_cetak_plan', $data);
    }

    // public function codeGenerator()
    // {
    //     $noOd                   = getKodeMax();
    //     $kode = $noOd->NoODMax;
    //     $blnFromDB = substr($kode, 0, 3);
    //     $blnNow    = strtoupper(konversiBln(date("M")));
    //     if ($blnFromDB == $blnNow) {
    //         if ($kode == '') {
    //             echo 'kosong';
    //         } else {
    //             $urutan = (int) substr($kode, 3, 3);
    //             $urutan++;
    //             $bln = strtoupper(konversiBln(date("M")));
    //             $thn = date("Y");
    //             $kodeBaru = $bln . sprintf("%03s", $urutan);
    //         }
    //     } else {
    //         $bln = strtoupper(konversiBln(date("M")));
    //         $thn = date("Y");
    //         $kodeBaru =
    //             $bln . '001';
    //     }
    //     return $kodeBaru;
    // }

    public function codeGenerator()
    {
        $noOd                   = getKodeMax();
        $kode = isset($noOd->NoODMax) ? $noOd->NoODMax : "";
        $blnFromDB = substr($kode, 0, 3);
        $blnNow    = strtoupper(konversiBln(date("M")));
        if ($kode  != "") {
            $urutan = (int) substr($kode, 7);
            $urutan++;
            $bln = strtoupper(konversiBln(date("M")));
            $thn = date("Y");
            $kodeBaru = $thn . $bln . sprintf("%03s", $urutan);
        } else {
            $bln = strtoupper(konversiBln(date("M")));
            $thn = date("Y");
            $kodeBaru = $thn .  $bln . '001';
        }

        return $kodeBaru;
    }

    public function realisasi()
    {
        $data['content'] = $this->progress
            ->select([
                'progress.id',
                'progress.motif',
                'progress.estimasi',
                'progress.tanggal',
                'progress.tanggal_rencana',
                'progress.is_preorder',
                'progress.id_toko',
                'progress.keterangan',
                'toko.nama_toko',
            ])
            ->join('toko')
            ->where('MONTH(tanggal)', date("m"))
            ->where('YEAR(tanggal)', date('Y'))
            ->orderBy('id', 'DESC')->get();
        $this->progress->table = 'jenis_pekerjaan';
        $data['jenis_pekerjaan'] = $this->progress->get();
        $data['list_progress'] = [];
        foreach ($data['content'] as $row) {
            if (checkRealisasi($row->id) > 0) {
                array_push($data['list_progress'], $row->id);
            }
        }

        $data['page'] = 'pages/progress/realisasi';
        $data['title'] = 'Daftar Progress';
        $data['nav_title'] = 'realisasi';
        $data['title_detail'] = 'Daftar Progress';
        //$this->show_table($data);
        $this->view($data);
    }

    public function tes()
    {
        $count_progress = $this->input->get('count', true);
        $arr_id_progress = [];
        for ($i = 0; $i < $count_progress; $i++) {
            array_push($arr_id_progress, $this->input->get($i, true));
        }
        //$id_progress = $this->input->get(0);
        foreach ($arr_id_progress as $row) {
            echo $row . "<br>";
        }
    }

    public function add_realisasi($id_progress)
    {
        $this->progress->table = 'perencanaan';
        $data['getPerencanaan'] = $this->progress->select([
            'perencanaan.id AS id_perencanaan', 'perencanaan.id_progress',
            'perencanaan.id_jenis_pekerjaan', 'perencanaan.id_jenis_bantal',
            'perencanaan.qty AS kuantitas_rencana', 'perencanaan.id_progress',
            'jenis_pekerjaan.nama_pekerjaan', 'jenis_bantal.nama_jenis_bantal',
            'realisasi.qty AS jumlah_realisasi',
        ])
            ->join('jenis_pekerjaan')
            ->join('jenis_bantal')
            ->xjoin('realisasi')
            ->where('id_progress', $id_progress)
            ->get();
        $data['id'] = $id_progress;
        //print_r($data['getPerencanaan']);
        $data['page']  = 'pages/progress/form_realisasi';
        $data['title'] = 'Form Realisasi Rencana Gunting';
        $data['nav_title'] = 'realisasi';
        $this->view($data);
    }

    public function insert_realisasi($id)
    {
        $id_perencanaan      = $this->input->post('id_perencanaan', true);
        $id_progress         = $this->input->post('id_progress', true);
        $qty                 = $this->input->post('qty', true);
        $kuantitas_rencana   = $this->input->post('kuantitas_rencana', true);
        $data  = array();
        $i = 0;

        foreach ($id_progress as $row) {
            $this->progress->table = 'realisasi';
            $getRealisasi = $this->progress->where('perencanaan.id_progress', $id)
                ->join('perencanaan')
                ->count();
            if ($getRealisasi != 0) {
                if ($getRealisasi == 0) {
                    $data_update = array(
                        'qty'    => $qty[$i]
                    );
                    //$this->progress->table = 'realisasi'
                    $this->progress->where('id_perencanaan', $id_perencanaan[$i])
                        ->update($data_update);
                } else {
                    $id2 = date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1);
                    array_push($data, array(
                        'id'             => $id2,
                        'id_perencanaan' => $id_perencanaan[$i],
                        'qty'            => $qty[$i],
                        'nama_admin'     => $this->session->userdata('name'),
                    ));
                }
            } else {
                $id2 = date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1);
                array_push($data, array(
                    'id'             => $id2,
                    'id_perencanaan' => $id_perencanaan[$i],
                    'qty'            => $qty[$i],
                    'nama_admin'     => $this->session->userdata('name'),
                ));
            }
            $i++;
        }
        //print_r($data);
        if (count($data) > 0) {
            if ($this->db->insert_batch('realisasi', $data)) {
                $this->session->set_flashdata('success', 'Data has been saved!');
                redirect('progress/realisasi');
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                redirect('progress/realisasi');
            }
        } else {
            $this->session->set_flashdata('success', 'Data has been saved!');
            redirect('progress/realisasi');
        }
    }

    public function edit_realisasi($id_progress)
    {
        $this->progress->table = 'perencanaan';
        $data['getPerencanaan'] = $this->progress->select([
            'perencanaan.id AS id_perencanaan', 'perencanaan.id_progress', 'perencanaan.id_jenis_pekerjaan', 'perencanaan.id_jenis_bantal',
            'perencanaan.qty', 'perencanaan.nama_admin',
            'jenis_pekerjaan.nama_pekerjaan', 'jenis_bantal.nama_jenis_bantal', 'realisasi.qty AS qty_realisasi', 'realisasi.id AS id_realisasi',
        ])
            ->join('jenis_pekerjaan')
            ->join('jenis_bantal')
            ->xjoin('realisasi')
            ->where('id_progress', $id_progress)
            ->get();

        //print_r($data['getPerencanaan']);
        $data['id']        = $id_progress;
        $data['page']      = 'pages/progress/form_edit_realisasi';
        $data['title']     = 'Form Edit Realisasi Perencanaan';
        $data['nav_title'] = 'progress';
        $this->view($data);
    }

    public function update_realisasi()
    {
        $idProgress  = $this->input->post('id_progress', true);
        $idRealisasi = $this->input->post('id_realisasi', true);
        $kuantitas   = $this->input->post('kuantitas_realisasi', true);
        $data_update = array();
        $i = 0;
        foreach ($idProgress as $row) {
            $data_update[] = array(
                'id'            => $idRealisasi[$i],
                'qty'   => $kuantitas[$i],
                'nama_admin' => $this->session->userdata('name'),
            );
            $i++;
        }
        if (count($data_update) > 0) {
            if ($this->db->update_batch('realisasi', $data_update, 'id')) {
                $this->session->set_flashdata('success', 'Data has been updated!');
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong');
            }
        } else {
            $this->session->set_flashdata('warning', 'Data has not found!');
        }
        redirect(base_url('progress/realisasi'));
    }

    public function exportMultiplePreview()
    {
        //$id_progress = ["2022MAR301", "2022MAR299"];
        $count_progress = $this->input->get('count', true);
        $id_progress = [];
        for ($i = 0; $i < $count_progress; $i++) {
            array_push($id_progress, $this->input->get($i, true));
        }
        $start_row = 2;
        $index = 0;
        $spreadsheet        = new Spreadsheet();

        foreach ($id_progress as $row) {
            $this->progress->table = 'perencanaan';
            $data['content'] = $this->progress->select([
                'jenis_pekerjaan.nama_pekerjaan', 'perencanaan.id_progress', 'perencanaan.qty', 'perencanaan.id_jenis_bantal',
                'realisasi.qty AS jumlah_realisasi'
            ])
                ->join('jenis_pekerjaan')
                ->xjoin('realisasi')
                ->where('perencanaan.id_progress', $row)
                ->get();
            $data['nama_admin'] = $this->progress->select([
                'realisasi.nama_admin'
            ])
                ->xjoin('realisasi')
                ->where('perencanaan.id_progress', $row)
                ->first();

            $this->progress->table = 'progress';
            $data['data_progress'] = $this->progress->where('id', $row)->first();

            $this->progress->table = 'jenis_bantal';
            $data['jenis_bantal'] = $this->progress->get();

            $data['jumlah_bantal'] = $this->progress->count();
            $jumlah_bantal = $data['jumlah_bantal'];

            $sheet[$index]              = $spreadsheet->getActiveSheet();
            $row3 = $start_row + 1;
            $row4 = $start_row + 2;
            $row6 = $start_row + 4;
            $row7 = $start_row + 5;
            //data header kartu bal
            $sheet[$index]->setCellValue('A' . $start_row, $row);
            $sheet[$index]->setCellValue('A' . $row3, 'Hari/Tgl:');
            $sheet[$index]->setCellValue('A' . $row4, 'Tgl Realisasi:');
            $sheet[$index]->setCellValue('C' . $row3, date_format(new DateTime($data['data_progress']->tanggal), "D / d M Y"));
            $sheet[$index]->setCellValue('C' . $row4, date_format(new DateTime($data['data_progress']->tanggal_rencana), "D / d M Y"));
            $sheet[$index]->setCellValue('G' . $row3, 'Motif Kain:');
            $sheet[$index]->setCellValue('G' . $row4, 'Ditambahkan Oleh:');
            $sheet[$index]->setCellValue('J' . $row3, $data['data_progress']->motif);
            $sheet[$index]->setCellValue('J' . $row4, $data['nama_admin']->nama_admin);

            //style for id progress
            $styleIdProgress = [
                'font'      => [
                    'size'  => 48,
                ],
            ];

            //set width column
            //style border
            $styleBorder = [
                'borders'   => [
                    'allBorders'    => [
                        'borderStyle'       => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color'             => ['argb'      => '000'],
                    ],
                ],
            ];

            $styleCenter = [
                'font'      => [
                    'size'  => 14,
                    'bold'  => true,
                ],
                'alignment' => [
                    'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ];

            $styleVerticalCenter = [
                'alignment' => [
                    'vertical'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ];

            //apply style center
            $sheet[$index]->getStyle('C' . $row6)->applyFromArray($styleCenter);

            //apply style id progress
            $sheet[$index]->getStyle('A' . $start_row)->applyFromArray($styleIdProgress);

            //merge cells
            $sheet[$index]->mergeCells('A' . $row6 . ':' . 'A' . $row7);
            $sheet[$index]->mergeCells('B' . $row6 . ':' . 'B' . $row7);
            $start_alpha = 'C';
            $alpha = 'C';

            for ($i = 1; $i <= count($data['jenis_bantal']) - 1; $i++) {
                $alpha++;
            }

            $sheet[$index]->mergeCells($start_alpha . $row6 . ':' . $alpha . $row6);
            //value header perencanaan

            $sheet[$index]->setCellValue('A' . $row6, 'No');
            $sheet[$index]->setCellValue('B' . $row6, 'Ukuran');
            $sheet[$index]->getStyle('A' . $row6 . ':' . 'B' . $row6)->applyFromArray($styleVerticalCenter);
            $sheet[$index]->setCellValue($start_alpha . $row6, 'Jenis Bantal');

            foreach ($data['jenis_bantal'] as $jenis_bantal) {
                $sheet[$index]->setCellValue($start_alpha . $row7, $jenis_bantal->nama_jenis_bantal);
                $start_alpha++;
            }

            //content perencanaan
            $jumlah_content = count($data['content']);
            $start = $start_row + 6;
            $col = $start_row + 6;
            $col_subrange = $start_row + 6;
            $no = 1;
            $sumrange = array();

            foreach ($data['content'] as $row) {
                $sheet[$index]->setCellValue('A' . $col, $no);
                $sheet[$index]->setCellValue('B' . $col, $row->nama_pekerjaan);
                $col_bantal = 'C';

                foreach ($data['jenis_bantal'] as $row2) {
                    if ($row2->id == $row->id_jenis_bantal) {
                        $sheet[$index]->setCellValue($col_bantal . $col, $row->qty);
                    }
                    $col_bantal++;
                }
                $col++;
                $no++;
            }
            $alpha_sum = 'C';

            foreach ($data['jenis_bantal'] as $bantal) {
                array_push(
                    $sumrange,
                    $alpha_sum . $col_subrange . ':' . $alpha_sum . ($col_subrange + ($jumlah_content - 1))
                );
                $alpha_sum++;
            }

            $batas_data_perencanaan = $jumlah_content + $start;

            //total_perencanaan
            $sheet[$index]->setCellValue('B' . $batas_data_perencanaan, 'TOTAL');

            //border perencanaan
            $sheet[$index]->getStyle('A' . $row6 . ':' . $alpha . $batas_data_perencanaan)->applyFromArray($styleBorder);
            $alpha_sum = 'C';

            for ($j = 0; $j <= $jumlah_bantal - 1; $j++) {
                //echo $sumrange[$j];
                $sheet[$index]->setCellValue($alpha_sum . $batas_data_perencanaan, "=SUM($sumrange[$j])");
                $alpha_sum++;
            }

            //next section
            $next_section = $start_alpha;

            //value header realisasi
            $next_section++;
            $start_content = $next_section;
            $border_start = $next_section;
            $sheet[$index]->setCellValue($next_section . $row6, 'No');
            $sheet[$index]->mergeCells($next_section . $row6 . ':' . $next_section . $row7);
            $sheet[$index]->getStyle($next_section . $row6)->applyFromArray($styleVerticalCenter);
            $next_section++;
            $sheet[$index]->getColumnDimension($next_section)->setAutoSize(true);
            $sheet[$index]->setCellValue($next_section . $row6, 'Ukuran');
            $sheet[$index]->mergeCells($next_section . $row6 . ':' . $next_section . $row7);
            $sheet[$index]->getStyle($next_section . $row6)->applyFromArray($styleVerticalCenter);
            $tempat_total_realisasi = $next_section;
            $next_section++;
            $sheet[$index]->setCellValue($next_section . $row6, 'REALISASI');
            $sheet[$index]->getStyle($next_section . $row6)->applyFromArray($styleCenter);
            $alpha_sum_realisasi2 = $next_section;
            $alpha_sum_realisasi = $next_section;
            $start_alpha_realisasi = $next_section;
            $alpha_realisasi = $next_section;

            for ($a = 1; $a <= count($data['jenis_bantal']) - 1; $a++) {
                $alpha_realisasi++;
            }

            $sheet[$index]->mergeCells($start_alpha_realisasi . $row6 . ':' . $alpha_realisasi . $row6);
            $start_realisasi = $next_section;

            foreach ($data['jenis_bantal'] as $data_jenis_bantal) {
                $sheet[$index]->setCellValue($start_realisasi . $row7, $data_jenis_bantal->nama_jenis_bantal);
                $start_realisasi++;
            }

            //content realisasi
            $start_realisasi = $start_row + 6;
            $col_realisasi = $start_row + 6;
            $col_subrange_realisasi = $start_row + 6;
            $no_realisasi = 1;
            $sumrange_realisasi = array();
            $content_no = $start_content;
            $start_content++;
            $content_ukuran = $start_content;
            $start_content++;
            $content_jenis_bantal = $start_content;

            foreach ($data['content'] as $content) {
                $sheet[$index]->setCellValue($content_no . $col_realisasi, $no_realisasi);
                $sheet[$index]->setCellValue($content_ukuran . $col_realisasi, $content->nama_pekerjaan);
                $col_bantal_realisasi = $content_jenis_bantal;

                foreach ($data['jenis_bantal'] as $content2) {
                    if ($content2->id == $content->id_jenis_bantal) {
                        $sheet[$index]->setCellValue($col_bantal_realisasi . $col_realisasi, $content->jumlah_realisasi);
                    }

                    $col_bantal_realisasi++;
                }

                $col_realisasi++;
                $no_realisasi++;
            }

            foreach ($data['jenis_bantal'] as $bantal2) {
                array_push(
                    $sumrange_realisasi,
                    $alpha_sum_realisasi . $col_subrange_realisasi . ':' . $alpha_sum_realisasi . ($col_subrange_realisasi + ($jumlah_content - 1))
                );

                $alpha_sum_realisasi++;
            }

            $batas_data_realisasi = $jumlah_content + $start_realisasi;
            $sheet[$index]->setCellValue($tempat_total_realisasi . $batas_data_realisasi, 'TOTAL');

            for ($b = 0; $b <= $jumlah_bantal - 1; $b++) {
                $sheet[$index]->setCellValue($alpha_sum_realisasi2 . $batas_data_realisasi, "=SUM($sumrange_realisasi[$b])");
                $alpha_sum_realisasi2++;
            }

            $sheet[$index]->getStyle($border_start . $row6 . ':' . $alpha_realisasi . $batas_data_realisasi)->applyFromArray($styleBorder);
            $start_row = $batas_data_perencanaan + 2;
        }







        $writer = new Xlsx($spreadsheet);



        $fileName = 'kartu-bal-multiple';



        header('Content-Type: application/vnd.ms-excel');



        header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');



        header('Cache-Control: max-age=0');







        $writer->save('php://output');
    }

    public function exportPreview($id_progress)
    {
        $this->progress->table = 'perencanaan';
        $data['content'] = $this->progress->select([
            'jenis_pekerjaan.nama_pekerjaan', 'perencanaan.id_progress', 'perencanaan.qty', 'perencanaan.id_jenis_bantal',
            'realisasi.qty AS jumlah_realisasi'
        ])
            ->join('jenis_pekerjaan')
            ->xjoin('realisasi')
            ->where('perencanaan.id_progress', $id_progress)
            ->get();

        //$this->progress->table = 'realisasi';
        $data['nama_admin'] = $this->progress->select([
            'realisasi.nama_admin'
        ])
            ->xjoin('realisasi')
            ->where('perencanaan.id_progress', $id_progress)
            ->first();

        $this->progress->table = 'progress';
        $data['data_progress'] = $this->progress->where('id', $id_progress)->first();
        $this->progress->table = 'jenis_bantal';
        $data['jenis_bantal'] = $this->progress->get();
        $data['jumlah_bantal'] = $this->progress->count();
        $jumlah_bantal = $data['jumlah_bantal'];

        $spreadsheet        = new Spreadsheet();
        $sheet              = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A3', 'Hari/Tgl:');
        $sheet->setCellValue('A4', 'Tgl Realisasi:');
        $sheet->setCellValue('C3', date_format(new DateTime($data['data_progress']->tanggal), "D / d M Y"));
        $sheet->setCellValue('C4', date_format(new DateTime($data['data_progress']->tanggal_rencana), "D / d M Y"));
        $sheet->setCellValue('G3', 'Motif Kain:');
        $sheet->setCellValue('G4', 'Ditambahkan Oleh:');
        $sheet->setCellValue('J3', $data['data_progress']->motif);
        $sheet->setCellValue('J4', $data['nama_admin']->nama_admin);
        $sheet->setCellValue('A2', $id_progress);

        //style for id progress
        $styleIdProgress = [
            'font'      => [
                'size'  => 48,
            ],
        ];

        //set width column
        $sheet->getColumnDimension('B')->setAutoSize(true);

        //style border
        $styleBorder = [
            'borders'   => [
                'allBorders'    => [
                    'borderStyle'       => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color'             => ['argb'      => '000'],
                ],
            ],
        ];

        $styleCenter = [
            'font'      => [
                'size'  => 14,
                'bold'  => true,
            ],
            'alignment' => [
                'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];

        $styleVerticalCenter = [
            'alignment' => [
                'vertical'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        //apply style center
        $sheet->getStyle('C6')->applyFromArray($styleCenter);

        //apply style id progress
        $sheet->getStyle('A2')->applyFromArray($styleIdProgress);

        //merge cells
        $sheet->mergeCells('A6:A7');
        $sheet->mergeCells('B6:B7');
        $start_alpha = 'C';
        $alpha = 'C';

        for ($i = 1; $i <= count($data['jenis_bantal']) - 1; $i++) {
            $alpha++;
        }

        $sheet->mergeCells($start_alpha . '6:' . $alpha . '6');

        //value header perencanaan
        $sheet->setCellValue('A6', 'No');
        $sheet->setCellValue('B6', 'Ukuran');
        $sheet->getStyle('A6:B6')->applyFromArray($styleVerticalCenter);
        $sheet->setCellValue($start_alpha . '6', 'Jenis Bantal');

        foreach ($data['jenis_bantal'] as $jenis_bantal) {
            $sheet->setCellValue($start_alpha . '7', $jenis_bantal->nama_jenis_bantal);
            $start_alpha++;
        }

        //content perencanaan
        $jumlah_content = count($data['content']);
        $start = 8;
        $col = 8;
        $col_subrange = 8;
        $no = 1;
        $sumrange = array();

        foreach ($data['content'] as $row) {
            $sheet->setCellValue('A' . $col, $no);
            $sheet->setCellValue('B' . $col, $row->nama_pekerjaan);
            $col_bantal = 'C';

            foreach ($data['jenis_bantal'] as $row2) {
                if ($row2->id == $row->id_jenis_bantal) {
                    $sheet->setCellValue($col_bantal . $col, $row->qty);
                }
                $col_bantal++;
            }

            $col++;
            $no++;
        }

        $alpha_sum = 'C';

        foreach ($data['jenis_bantal'] as $bantal) {
            array_push(
                $sumrange,
                $alpha_sum . $col_subrange . ':' . $alpha_sum . ($col_subrange + ($jumlah_content - 1))
            );
            $alpha_sum++;
        }

        $batas_data_perencanaan = $jumlah_content + $start;

        //total_perencanaan
        $sheet->setCellValue('B' . $batas_data_perencanaan, 'TOTAL');

        //border perencanaan
        $sheet->getStyle('A6:' . $alpha . $batas_data_perencanaan)->applyFromArray($styleBorder);
        $alpha_sum = 'C';

        for ($j = 0; $j <= $jumlah_bantal - 1; $j++) {
            //echo $sumrange[$j];
            $sheet->setCellValue($alpha_sum . $batas_data_perencanaan, "=SUM($sumrange[$j])");
            $alpha_sum++;
        }

        //next section
        $next_section = $start_alpha;

        //value header realisasi
        $next_section++;
        $start_content = $next_section;
        $border_start = $next_section;
        $sheet->setCellValue($next_section . '6', 'No');
        $sheet->mergeCells($next_section . '6:' . $next_section . '7');
        $sheet->getStyle($next_section . '6')->applyFromArray($styleVerticalCenter);
        $next_section++;
        $sheet->getColumnDimension($next_section)->setAutoSize(true);
        $sheet->setCellValue($next_section . '6', 'Ukuran');
        $sheet->mergeCells($next_section . '6:' . $next_section . '7');
        $sheet->getStyle($next_section . '6')->applyFromArray($styleVerticalCenter);
        $tempat_total_realisasi = $next_section;

        $next_section++;

        $sheet->setCellValue($next_section . '6', 'REALISASI');
        $sheet->getStyle($next_section . '6')->applyFromArray($styleCenter);
        $alpha_sum_realisasi2 = $next_section;
        $alpha_sum_realisasi = $next_section;
        $start_alpha_realisasi = $next_section;
        $alpha_realisasi = $next_section;

        for ($a = 1; $a <= count($data['jenis_bantal']) - 1; $a++) {
            $alpha_realisasi++;
        }

        $sheet->mergeCells($start_alpha_realisasi . '6:' . $alpha_realisasi . '6');
        //value header realisasi (jenis bantal)
        $start_realisasi = $next_section;
        foreach ($data['jenis_bantal'] as $data_jenis_bantal) {
            $sheet->setCellValue($start_realisasi . '7', $data_jenis_bantal->nama_jenis_bantal);
            $start_realisasi++;
        }

        //content realisasi
        $start_realisasi = 8;
        $col_realisasi = 8;
        $col_subrange_realisasi = 8;
        $no_realisasi = 1;
        $sumrange_realisasi = array();
        $content_no = $start_content;
        $start_content++;
        $content_ukuran = $start_content;
        $start_content++;
        $content_jenis_bantal = $start_content;

        foreach ($data['content'] as $content) {
            $sheet->setCellValue($content_no . $col_realisasi, $no_realisasi);
            $sheet->setCellValue($content_ukuran . $col_realisasi, $content->nama_pekerjaan);
            $col_bantal_realisasi = $content_jenis_bantal;

            foreach ($data['jenis_bantal'] as $content2) {
                if ($content2->id == $content->id_jenis_bantal) {
                    $sheet->setCellValue($col_bantal_realisasi . $col_realisasi, $content->jumlah_realisasi);
                }
                $col_bantal_realisasi++;
            }

            $col_realisasi++;
            $no_realisasi++;
        }

        foreach ($data['jenis_bantal'] as $bantal2) {
            array_push(
                $sumrange_realisasi,
                $alpha_sum_realisasi . $col_subrange_realisasi . ':' . $alpha_sum_realisasi . ($col_subrange_realisasi + ($jumlah_content - 1))
            );

            $alpha_sum_realisasi++;
        }

        $batas_data_realisasi = $jumlah_content + $start_realisasi;

        //total_realisasi
        $sheet->setCellValue($tempat_total_realisasi . $batas_data_realisasi, 'TOTAL');

        for ($b = 0; $b <= $jumlah_bantal - 1; $b++) {
            $sheet->setCellValue($alpha_sum_realisasi2 . $batas_data_realisasi, "=SUM($sumrange_realisasi[$b])");
            $alpha_sum_realisasi2++;
        }

        //border realisasi
        $sheet->getStyle($border_start . '6:' . $alpha_realisasi . $batas_data_realisasi)->applyFromArray($styleBorder);
        $writer = new Xlsx($spreadsheet);
        $fileName = 'kartu-bal-' . $id_progress;
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function test()
    {
        $alpha = 'C';
        $alpha + 2;

        echo $alpha;
    }

    public function preview($id_progress)
    {
        $this->progress->table = 'perencanaan';
        $data['content'] = $this->progress->select([
            'jenis_pekerjaan.nama_pekerjaan', 'perencanaan.id_progress', 'perencanaan.qty', 'perencanaan.id_jenis_bantal',
            'realisasi.qty AS jumlah_realisasi'
        ])
            ->join('jenis_pekerjaan')
            ->xjoin('realisasi')
            ->where('perencanaan.id_progress', $id_progress)
            ->get();
        //$this->progress->table = 'realisasi';
        $data['nama_admin'] = $this->progress->select([
            'realisasi.nama_admin'
        ])
            ->xjoin('realisasi')
            ->where('perencanaan.id_progress', $id_progress)
            ->first();


        $this->progress->table = 'progress';
        $data['data_progress'] = $this->progress->where('id', $id_progress)->first();
        $this->progress->table = 'jenis_bantal';
        $data['jenis_bantal'] = $this->progress->get();
        $data['jumlah_bantal'] = $this->progress->count();

        // $this->penggunting->table = 'penggunting';
        // $data['mitra'] = $this->penggunting->where('id_progress', $id_progress)->get();

        foreach ($data['jenis_bantal'] as $row) {
            $this->progress->table = 'perencanaan';
            $data['total']['bt' . $row->id] =
                $this->progress->where('perencanaan.id_jenis_bantal', $row->id)
                ->where('perencanaan.id_progress', $id_progress)
                ->get();
            //$this->progress->table = 'realisasi';
            $data['total_perencanaan']['realisasi' . $row->id] =
                $this->progress->select([
                    'realisasi.qty AS qty'
                ])
                ->xjoin('realisasi')
                ->where('perencanaan.id_jenis_bantal', $row->id)
                ->where('perencanaan.id_progress', $id_progress)->get();
        }

        $query = "SELECT penggunting.id_mitra as 'id_mitra', mitra.nama as 'nama_mitra' FROM penggunting INNER JOIN mitra ON penggunting.id_mitra=mitra.id INNER JOIN progress ON penggunting.id_progress=progress.id WHERE penggunting.id_progress='$id_progress'";
        $data['mitra'] = $this->db->query($query)->result();

        // var_dump($data['mitra']);
        // die;

        $data['page']         = 'pages/progress/preview';
        $data['nav_title']    = 'realisasi';
        $data['title_detail'] = 'Preview';
        $data['id']           = $id_progress;
        $this->view($data);
    }

    public function showFormPlan($id_progress)
    {
        $this->progress->table = 'jenis_pekerjaan';
        $jenis_pekerjaan = $this->progress->get();

        $this->progress->table = 'jenis_bantal';
        $jenis_bantal = $this->progress->get();

        $this->progress->table = 'pembelian';
        $pembelian = $this->progress->get();

        $option = '';
        $option2 = '';
        $option3 = '';
        $option4 = '';

        foreach ($jenis_pekerjaan as $row) {
            $option .= '<option value="' . $row->id . '">' . $row->nama_pekerjaan . ' </option>';
        }

        foreach ($jenis_bantal as $row) {
            $option2 .= '<option value="' . $row->id . '">' . $row->nama_jenis_bantal . '</option>';
        }

        foreach ($pembelian as $row) {
            $option4 .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
        }

        $output = ' 
        <div class="container-fluid">
            <div class="div0 row" id="tempatForm">
                <input type="hidden" name="id_progress[]" value="' . $id_progress . '">
                <div class="col-xs-3" style="margin-top: 20px;">
                    <h2 class="card-inside-title"> Jenis Pekerjaan</h2>
                    <select class="form-control show-tick select2" name="id_jenis_pekerjaan[]" required>
                        <option></option>
                        ' . $option . '
                    </select>
                </div>
                <div class="col-xs-3" style="margin-top: 20px;">
                    <h2 class="card-inside-title">Jenis Bantal</h2>
                    <select class="form-control show-tick select2" name="id_jenis_bantal[]" required>
                        <option></option>
                        ' . $option2 . '
                    </select>
                </div> 
                <div class="col-xs-3" style="margin-top: 20px;">
                    <h2 class="card-inside-title">Kuantitas</h2>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" class="form-control" name="qty[]" required />
                        </div>
                    </div>
                </div>
                <div class="col-xs-3" style="margin-top: 20px;">
                <h2 class="card-inside-title">Satuan</h2>
                <select class="form-control show-tick " name="id_satuan[]" required>
                    <option value="">--Pilih Satuan--</option>
                    <option value="1">SET</option>
                    <option value="2">PCS</option>
                </select>
            </div> 
            </div>
        </div>
        ';
        echo $output;
    }

    public function showPenggunting($id_progress)
    {
        $this->progress->table = 'mitra';
        $mitra = $this->progress->get();
        $option = '';

        foreach ($mitra as $row) {
            $option .= '<option value="' . $row->id . '">' . $row->nama . ' - ' . $row->id . '  </option>';
        }

        $output = '<div class="row">
                        <div class="col-xs-3">
                            <input type="hidden" name="idProgress" value="' . $id_progress . '">
                            <select class="form-control show-tick select2" name="id_mitra">
                                <option></option>
                                ' . $option . '
                            </select>
                        </div>
                    </div>';
        echo $output;
    }
}