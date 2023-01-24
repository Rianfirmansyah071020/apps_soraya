<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Distribusi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');
        $this->load->library('mypdf');
        $this->load->library('Pdf');
        if ($role == 'admin' || $role == 'admin_distribusi' || $role == 'admin_operator') {
            return;
        } else {
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $this->distribusi->table = 'progress';
        $data['content'] = $this->distribusi->select([
            'id', 'motif', 'tanggal'
        ])
            ->where('YEAR(tanggal)', date("Y"))
            ->where('MONTH(tanggal)', date("m"))
            ->orderBy('id', 'DESC')
            ->get();
        $data['page'] = 'pages/distribusi/index';
        $data['title'] = 'Daftar Pendistribusian';
        $data['nav_title'] = 'distribusi';
        $data['title_detail'] = 'Daftar Pendistribusian';
        $this->distribusi->table = 'mitrawork';
        $data['jenis_pekerjaan'] = $this->distribusi->get();

        $this->view($data);
    }

    public function filter($month, $year)
    {
        $this->distribusi->table = 'progress';
        $data['content'] = $this->distribusi->where('MONTH(tanggal)', $month)->where('YEAR(tanggal)', $year)->orderBy('tanggal', 'DESC')->get();

        $data['title'] = 'Daftar Progress';
        $data['nav_title'] = 'progress';
        $data['title_detail'] = 'Daftar Progress';

        $this->load->view('pages/distribusi/table', $data);
    }

    public function filterDistribusiBasedOnJenisPekerjaan($id_jenis_pekerjaan = '')
    {
        $month = $this->input->post('month', true);
        $year = $this->input->post('year', true);

        if ($id_jenis_pekerjaan != '') {
            if ($month == "" && $year == "") {
                $sql = "SELECT DISTINCT distribusi.id_progress AS id, progress.motif, progress.tanggal 
                        FROM `distribusi`, progress, mitrawork 
                        WHERE progress.id = distribusi.id_progress 
                        AND distribusi.id_mitrawork = mitrawork.id 
                        AND id_mitrawork = '$id_jenis_pekerjaan' 
                        ORDER BY tanggal 
                        DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else if ($month != "" && $year == "") {
                $sql = "SELECT DISTINCT distribusi.id_progress 
                        AS id, progress.motif, progress.tanggal 
                        FROM `distribusi`, progress, mitrawork 
                        WHERE progress.id = distribusi.id_progress 
                        AND distribusi.id_mitrawork = mitrawork.id 
                        AND id_mitrawork = '$id_jenis_pekerjaan' 
                        AND MONTH(tanggal) = '$month' 
                        ORDER BY tanggal 
                        DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else if ($month == "" && $year != "") {
                $sql = "SELECT DISTINCT distribusi.id_progress AS id, progress.motif, progress.tanggal 
                        FROM `distribusi`, progress, mitrawork 
                        WHERE progress.id = distribusi.id_progress 
                        AND distribusi.id_mitrawork = mitrawork.id 
                        AND id_mitrawork = '$id_jenis_pekerjaan' 
                        AND YEAR(tanggal) = '$year' 
                        ORDER BY tanggal 
                        DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else {
                $sql = "SELECT DISTINCT distribusi.id_progress AS id, progress.motif, progress.tanggal 
                        FROM `distribusi`, progress, mitrawork 
                        WHERE progress.id = distribusi.id_progress 
                        AND distribusi.id_mitrawork = mitrawork.id 
                        AND id_mitrawork = '$id_jenis_pekerjaan' 
                        AND MONTH(tanggal) = '$month' 
                        AND YEAR(tanggal) = '$year' 
                        ORDER BY tanggal 
                        DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            }
        } else {
            if ($month == "" && $year == "") {
                $month = date('m');
                $year = date('Y');
                $sql = "SELECT DISTINCT progress.id, progress.motif, progress.tanggal 
                        FROM progress 
                        WHERE MONTH(tanggal) = '$month' 
                        AND YEAR(tanggal) = '$year' 
                        ORDER BY tanggal 
                        DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else if ($month != "" && $year == "") {
                $sql = "SELECT DISTINCT progress.id, progress.motif, progress.tanggal 
                        FROM progress WHERE MONTH(tanggal) = '$month' 
                        ORDER BY tanggal 
                        DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else if ($month == "" && $year != "") {
                $sql = "SELECT DISTINCT progress.id, progress.motif, progress.tanggal 
                        FROM progress 
                        WHERE YEAR(tanggal) = '$year' 
                        ORDER BY tanggal 
                        DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            } else {
                $sql = "SELECT DISTINCT progress.id, progress.motif, progress.tanggal 
                        FROM progress 
                        WHERE MONTH(tanggal) = '$month' 
                        AND YEAR(tanggal) = '$year' 
                        ORDER BY tanggal 
                        DESC";
                $query = $this->db->query($sql);
                $data['content'] = $query->result();
            }
        }

        $data['title'] = 'Daftar Progress';
        $data['nav_title'] = 'progress';
        $data['title_detail'] = 'Daftar Progress';

        $this->load->view('pages/distribusi/table', $data);
    }

    public function add_work($id)
    {
        $data['id'] = $id;

        $data['title'] = 'Tambah Pembagian Kerja';
        $data['nav_title'] = 'distribusi';
        $data['page'] = 'pages/distribusi/form';

        $this->view($data);
    }

    public function insert_work()
    {
        $digits = 4;

        $idProgress = $this->input->post('id_progress', true);
        $idMitra = $this->input->post('id_mitra', true);
        $idMitraWork = $this->input->post('id_mitrawork', true);
        $jumlahSet = $this->input->post('jumlah_set', true);
        $data = array();

        $i = 0;
        foreach ($idProgress as $row) {

            $this->distribusi->table = 'distribusi';
            $getDistribusi = $this->distribusi->where('distribusi.id_progress', $row)
                ->where('distribusi.id_mitra', $idMitra[$i])
                ->where('distribusi.id_mitrawork', $idMitraWork[$i])
                ->count();

            if ($getDistribusi == 0) {
                $id = date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                array_push($data, array(
                    'id'            => $id,
                    'id_progress'   => $row,
                    'id_mitra'      => $idMitra[$i],
                    'id_mitrawork'  => $idMitraWork[$i],
                    'jumlah_set'    => $jumlahSet[$i],
                    'nama_admin'    => $this->session->userdata('name'),
                ));
            } else {
                $data_update = array(
                    'jumlah_set' => $jumlahSet[$i]
                );

                $this->distribusi->where('distribusi.id_progress', $row)
                    ->where('distribusi.id_mitra', $idMitra[$i])
                    ->where('distribusi.id_mitrawork', $idMitraWork[$i])
                    ->update($data_update);
            }

            $i++;
        }

        if (count($data) > 0) {
            if ($this->db->insert_batch('distribusi', $data)) {
                $this->session->set_flashdata('success', 'Data has been saved!');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong!');
            }
        } else {
            $this->session->set_flashdata('success', 'Data has been saved!');
        }

        redirect('distribusi');
    }

    public function edit_distribusi($id_progress)
    {
        $this->distribusi->table = 'mitra';
        $data['getMitra'] = $this->distribusi->where('is_active', true)->get();

        $this->distribusi->table = 'mitrawork';
        $data['getJenisPekerjaan'] = $this->distribusi->get();
        $data['id']     = $id_progress;

        $this->distribusi->table = 'distribusi';
        $data['getDist']    = $this->distribusi->where('id_progress', $id_progress)->get();

        $data['page']   = 'pages/distribusi/form_edit';
        $data['title'] = 'Edit Pembagian Kerja';
        $data['nav_title'] = 'distribusi';

        $this->view($data);
    }

    public function update_work()
    {
        $idProgress = $this->input->post('id_progress', true);
        $idDistribusi = $this->input->post('id_distribusi', true);

        $idMitra = $this->input->post('id_mitra', true);
        $idMitraWork = $this->input->post('id_mitrawork', true);
        $jumlahSet = $this->input->post('jumlah_set', true);

        $data_update = array();

        $i = 0;
        foreach ($idProgress as $row) {
            $data_update[] = array(
                'id'            => $idDistribusi[$i],
                'id_progress'   => $row,
                'id_mitra'  => $idMitra[$i],
                'id_mitrawork' => $idMitraWork[$i],
                'jumlah_set'   => $jumlahSet[$i],
                'nama_admin' => $this->session->userdata('name'),
            );

            $i++;
        }

        if (count($data_update) > 0) {
            if ($this->db->update_batch('distribusi', $data_update, 'id')) {
                $this->session->set_flashdata('success', 'Data has been updated!');
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong');
            }
        } else {
            $this->session->set_flashdata('warning', 'Data has not found!');
        }

        redirect(base_url('distribusi'));
    }

    public function delete_work($id)
    {

        $this->distribusi->table = 'distribusi';
        if ($this->distribusi->where('id', $id)->delete()) {

            $this->distribusi->table = 'store';
            $checkStore = $this->distribusi->where('store.id_distribusi', $id)->count();

            if ($checkStore > 0) {
                $this->distribusi->where('store.id_distribusi', $id)->delete();
            }

            echo json_encode(array(
                'status_code'      => 200
            ));
        } else {
            echo json_encode(array(
                'status_code'      => 400
            ));
        }
    }

    public function lihat_distribusi()
    {
        $this->distribusi->table    = 'mitra';
        $data['mitra']           = $this->distribusi
            ->orderBy('created_at', 'DESC')->get();
        $data['title']          = 'Lihat Distribusi Mitra';
        $data['nav_title']      = 'distribusi-mitra';
        $data['title_detail']   = 'Lihat Distribusi Mitra';
        $data['page']           = 'pages/distribusi/lihat_distribusi_mitra';

        $this->view($data);
    }

    public function get_lihat_distribusi()
    {
        $id_mitra = $this->input->post('id_mitra', true);
        $fromDate = $this->input->post('fromDate', true);
        $toDate   = $this->input->post('toDate', true);

        $fromDate2 = strtotime($fromDate);
        $toDate2   = strtotime($toDate);

        if ($id_mitra && $fromDate && $toDate) {
            $this->distribusi->table = 'distribusi';
            $data['content']         = $this->distribusi->select([
                'progress.motif',
                'progress.id', 'distribusi.created_at AS tanggal_distribusi',
                'mitrawork.nama_mitrawork', 'distribusi.jumlah_set',
                'distribusi.status_pekerjaan'
            ])
                ->join('progress')
                ->join('mitrawork')
                ->where('DATE(distribusi.created_at) >=', date("Y-m-d", $fromDate2))
                ->where('DATE(distribusi.created_at) <=', date("Y-m-d", $toDate2))
                ->where('distribusi.id_mitra', $id_mitra)
                ->orderBy('distribusi.created_at', 'ASC')
                ->get();

            $this->distribusi->table = 'mitra';
            $data['getMitra']           = $this->distribusi->where('id', $id_mitra)->first();

            echo json_encode([
                'statusCode'            => 200,
                'html'               => $this->load->view('pages/distribusi/result_lihat_distribusi_mitra', $data, true),
                'iframe'            => base_url("distribusi/tes-lagi/$fromDate2/$toDate2/$id_mitra"),
                'fromDate'          => date("Y-m-d", $fromDate2),
                'toDate'            => date("Y-m-d", $toDate2)
            ]);
        }
    }

    public function tes_lagi($fromDate, $toDate, $id_mitra)
    {

        $this->distribusi->table = 'distribusi';
        $data['content']         = $this->distribusi->select([
            'progress.motif',
            'progress.id', 'distribusi.created_at AS tanggal_distribusi',
            'mitrawork.nama_mitrawork', 'distribusi.jumlah_set',
            'distribusi.status_pekerjaan'
        ])
            ->join('progress')
            ->join('mitrawork')
            ->where('DATE(distribusi.created_at) >=', date("Y-m-d", $fromDate))
            ->where('DATE(distribusi.created_at) <=', date("Y-m-d", $toDate))
            ->where('distribusi.id_mitra', $id_mitra)
            ->orderBy('distribusi.created_at', 'ASC')
            ->get();

        $this->distribusi->table = 'mitra';
        $data['getMitra']           = $this->distribusi->where('id', $id_mitra)->first();
        $this->load->view('pages/distribusi/cetak_distribusi_mitra', $data);
    }

    public function show_modal_lihat_tugas_mitra()
    {
        $data['mitra']           = $this->mitra
            ->orderBy('created_at', 'DESC')->get();
        $this->output->set_output(show_my_modal('pages/distribusi/modal_lihat_tugas_mitra', 'modal-lihat-tugas-mitra', $data, 'ku'));
    }

    public function showForm($id_progress)
    {
        $this->distribusi->table = 'mitra';
        $mitra = $this->distribusi->where('is_active', true)->get();

        $this->distribusi->table = 'mitrawork';
        $mitrawork = $this->distribusi->get();

        $option = '';
        $option2 = '';

        foreach ($mitra as $row) {
            $option .= '<option value="' . $row->id . '">' . $row->nama . ' - ' . $row->id . '  </option>';
        }

        foreach ($mitrawork as $row) {
            $option2 .= '<option value="' . $row->id . '">' . $row->nama_mitrawork . '</option>';
        }

        $output = '<input type="hidden" name="id_progress[]" value="' . $id_progress . '">
                        <div class="col-xs-4" style="margin-top: 20px;">
                            <h2 class="card-inside-title"> Jenis Pekerjaan</h2>
                            <select class="form-control show-tick select2" name="id_mitrawork[]">
                                <option></option>
                                ' . $option2 . '
                            </select>
                        </div>
                        <div class="col-xs-4" style="margin-top: 20px;">
                            <h2 class="card-inside-title">Mitra</h2>
                            <select class="form-control show-tick select2" name="id_mitra[]">
                                <option></option>
                                ' . $option . '
                            </select>
                        </div>
                        <div class="col-xs-4" style="margin-top: 20px;">
                            <h2 class="card-inside-title">Jumlah Set</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="jumlah_set[]" required />
                                </div>
                            </div>
                        </div>
                    ';

        echo $output;
    }

    public function detail($id)
    {
        $data['content'] = $this->distribusi->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan', 'distribusi.id AS id_distribusi',
            'distribusi.created_at',
            'mitra.id',
            'mitra.nama', 'mitrawork.nama_mitrawork',
        ])
            ->join('mitra')
            ->join('mitrawork')
            ->where('id_progress', $id)->get();

        $this->distribusi->table = 'progress';
        $data['progress'] = $this->distribusi->where('id', $id)->first();

        echo show_my_modal('pages/distribusi/modal_detail', 'modal-detail-distribusi', $data, 'lg');
    }

    public function load_table_detail($id)
    {
        $data['content'] = $this->distribusi->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan', 'distribusi.id AS id_distribusi',
            'mitra.id',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->join('mitrawork')
            ->where('id_progress', $id)->get();

        $this->load->view('pages/distribusi/table_detail', $data);
    }

    public function cetakPdf($data, $id_progress)
    {
        $this->mypdf->generate('pages/distribusi/cetak_kartu', $data, 'kartu_order_bal_v2' . $id_progress, array(0, 0, 360, 360), 'portrait');
    }

    public function loadCetak($id_progress)
    {
        $this->distribusi->table = 'perencanaan';
        $data['id_progress'] = $id_progress;

        $data['perencanaan'] = $this->distribusi->select([
            'jenis_pekerjaan.nama_pekerjaan', 'perencanaan.id_progress', 'perencanaan.qty', 'perencanaan.id_jenis_bantal',
            'realisasi.qty AS jumlah_realisasi'
        ])
            ->join('jenis_pekerjaan')
            ->xjoin('realisasi')
            ->where('perencanaan.id_progress', $id_progress)
            ->get();

        $this->distribusi->table = 'progress';
        $data['tanggal_progress'] = $this->distribusi->where('id', $id_progress)->first();

        $this->distribusi->table = 'jenis_bantal';
        $data['jenis_bantal'] = $this->distribusi->get();
        $data['jumlah_bantal'] = $this->distribusi->count();

        foreach ($data['jenis_bantal'] as $row) {
            $this->distribusi->table = 'perencanaan';
            $data['total']['bt' . $row->id] =
                $this->distribusi->where('perencanaan.id_jenis_bantal', $row->id)
                ->where('perencanaan.id_progress', $id_progress)
                ->get();

            $data['total_perencanaan']['realisasi' . $row->id] =
                $this->distribusi->select([
                    'realisasi.qty AS qty'
                ])
                ->xjoin('realisasi')
                ->where('perencanaan.id_jenis_bantal', $row->id)
                ->where('perencanaan.id_progress', $id_progress)->get();
        }

        $this->distribusi->table = 'distribusi';
        $data['distribusi'] = $this->distribusi->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan',
            'mitra.id',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->join('mitrawork')
            ->where('id_progress', $id_progress)->get();

        $this->load->view('pages/distribusi/cetak_kartu', $data);
    }

    public function tes_fpdf()
    {
        error_reporting(0);
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 60);

        $pdf->SetFont('Courier', '', '13');
        $pdf->Cell(0, 7, 'DATA PENDISTRIBUSIAN MITRA', 0, 1, 'C');
        $pdf->Cell(10, 5, '', 0, 1);
        $pdf->SetFont('Courier', '', '10');
        $pdf->Cell(50, 6, 'Nama Mitra', 0, 0);
        $pdf->Cell(5, 6, ':', 0, 0);
        $pdf->Cell(80, 6, 'Nesri Wahyuni', 0, 0);
        $pdf->Cell(50, 6, 'No Mitra', 0, 0);
        $pdf->Cell(5, 6, ':', 0, 0);
        $pdf->Cell(0, 6, 'MTR-964210111090437', 0, 1);
        $pdf->Cell(50, 6, 'No HP', 0, 0);
        $pdf->Cell(5, 6, ':', 0, 0);
        $pdf->Cell(80, 6, '082388334711', 0, 0);
        $pdf->Cell(50, 6, 'Alamat', 0, 0);
        $pdf->Cell(5, 6, ':', 0, 0);
        $pdf->MultiCell(0, 6, 'Kp Tangah Kec Kuranji Padang', 0);
        $pdf->Cell(10, 7, '', 0, 1);

        // ! table header
        $h = 13;
        $left = 40;
        $top = 80;

        $left = $pdf->GetX();
        $pdf->Cell(20, $h, 'NO', 1, 0, 'L');
        $pdf->SetX($left += 20);
        $pdf->Cell(75, $h, 'NIP', 1, 0, 'C');
        $pdf->SetX($left += 75);
        $pdf->Cell(100, $h, 'NAMA', 1, 0, 'C');
        $pdf->SetX($left += 100);
        $pdf->Cell(150, $h, 'ALAMAT', 1, 0, 'C');
        $pdf->SetX($left += 150);
        $pdf->Cell(100, $h, 'EMAIL', 1, 0, 'C');
        $pdf->SetX($left += 100);
        $pdf->Cell(100, $h, 'WEBSITE', 1, 1, 'C');

        $pdf->Output('I', 'Data Pendistribusian Mitra');
    }
}
