<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use function PHPSTORM_META\map;

class Report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role == 'admin') {
            return;
        } else {
            $this->session->set_flashdata('warning', 'Tidak Mempunyai Akses ke Menu Tersebut');
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
    }

    public function showSelect()
    {
        $this->report->table = 'mitra';
        $mitra = $this->report->get();
        $option = '';
        foreach ($mitra as $row) {
            $option .= '<option value="' . $row->id . '">' . $row->nama . ' - ' . $row->id . '  </option>';
        }

        $output = '<select class="form-control show-tick select2" name="id_mitra" id="id_mitra">
                        <option></option>
                        ' . $option . '
                    </select>';

        echo $output;
    }

    public function mitra()
    {
        $this->report->table    = 'mitra';
        $data['mitra']          = $this->report->get();
        $data['title']          = 'Laporan Mitra';
        $data['nav_title']      = 'laporan-mitra';
        $data['title_detail']   = 'Form Laporan Mitra';
        $data['page']           = 'pages/report/mitra';

        $this->view($data);
    }

    public function requestDataMitra()
    {
        $id_mitra = $this->input->post('id_mitra', true);

        if ($id_mitra) {
            $this->report->table = 'mitra';
            $data['getMitra'] = $this->report->where('id', $id_mitra)->first();
            // var_dump($data['getMitra']);
            // die;
        }

        if ($data['getMitra']) {
            $this->load->view('pages/report/list_data_mitra', $data);
        }
    }

    public function requestMitraReport()
    {
        $id_mitra = $this->input->post('id_mitra', true);
        $fromDate = $this->input->post('fromDate', true);
        $toDate   = $this->input->post('toDate', true);

        $fromDate2 = strtotime($fromDate);
        $toDate2   = strtotime($toDate);

        if ($id_mitra && $fromDate && $toDate) {
            $this->report->table = 'distribusi';
            $data['content'] = $this->report->select([
                'progress.id', 'store.created_at AS tanggal_store', 'mitrawork.nama_mitrawork', 'distribusi.jumlah_set',
                'store.jumlah_store', 'distribusi.status_pekerjaan'
            ])
                ->join('progress')
                ->join('mitrawork')
                ->xjoin('store')
                ->where('progress.tanggal >=', date("Y-m-d", $fromDate2))
                ->where('progress.tanggal <=', date("Y-m-d", $toDate2))
                ->where('distribusi.id_mitra', $id_mitra)
                ->get();

            $data['countSelesai'] = $this->report->select([
                'progress.id', 'store.created_at AS tanggal_store', 'mitrawork.nama_mitrawork', 'distribusi.jumlah_set',
                'store.jumlah_store', 'distribusi.status_pekerjaan'
            ])
                ->join('progress')
                ->join('mitrawork')
                ->xjoin('store')
                ->where('progress.tanggal >=', date("Y-m-d", $fromDate2))
                ->where('progress.tanggal <=', date("Y-m-d", $toDate2))
                ->where('distribusi.id_mitra', $id_mitra)
                ->where('distribusi.status_pekerjaan', 'selesai')
                ->count();

            $data['countProses'] = $this->report->select([
                'progress.id', 'store.created_at AS tanggal_store', 'mitrawork.nama_mitrawork', 'distribusi.jumlah_set',
                'store.jumlah_store', 'distribusi.status_pekerjaan'
            ])
                ->join('progress')
                ->join('mitrawork')
                ->xjoin('store')
                ->where('progress.tanggal >=', date("Y-m-d", $fromDate2))
                ->where('progress.tanggal <=', date("Y-m-d", $toDate2))
                ->where('distribusi.id_mitra', $id_mitra)
                ->where('distribusi.status_pekerjaan', 'proses')
                ->count();
        }
        $this->load->view('pages/report/list_report_mitra', $data);
    }

    public function requestMitraChart()
    {
        $id_mitra = $this->input->post('id_mitra', true);

        if ($id_mitra) {
            $this->report->table = 'distribusi';

            for ($i = 1; $i <= 12; $i++) {
                $data['selesai' . $i] = $this->report->select(
                    [
                        'distribusi.status_pekerjaan', 'COUNT(distribusi.status_pekerjaan) AS jumlah', 'MONTH(store.created_at) AS bulan'
                    ]
                )
                    ->join('progress')
                    ->xjoin('store')
                    ->where('distribusi.id_mitra', $id_mitra)
                    ->where('YEAR(progress.tanggal)', date("Y"))
                    ->where('MONTH(progress.tanggal)', $i)
                    ->where('distribusi.status_pekerjaan', 'selesai')
                    ->get();

                $data['proses' . $i] = $this->report->select(
                    [
                        'distribusi.status_pekerjaan', 'COUNT(distribusi.status_pekerjaan) AS jumlah', 'MONTH(store.created_at) AS bulan'
                    ]
                )
                    ->join('progress')
                    ->xjoin('store')
                    ->where('distribusi.id_mitra', $id_mitra)
                    ->where('YEAR(progress.tanggal)', date("Y"))
                    ->where('MONTH(progress.tanggal)', $i)
                    ->where('distribusi.status_pekerjaan', 'proses')
                    ->get();
            }

            echo json_encode($data);
        }
    }

    public function distStore()
    {
        $data['page'] = 'pages/report/dist_store';
        $data['title_detail']   = 'Form Laporan Distribusi & Store';
        $data['nav_title'] = 'laporan-dist-store';

        $this->view($data);
    }

    public function requestDistStore()
    {
        $fromDateDistStore = $this->input->post('fromDateDistStore', true);
        $toDateDistStore   = $this->input->post('toDateDistStore', true);

        $fromDateDistStore2 = strtotime($fromDateDistStore);
        $toDateDistStore2   = strtotime($toDateDistStore);

        if ($fromDateDistStore && $toDateDistStore) {
            $this->report->table = 'mitra';
            $data['content'] = $this->report->select([
                'mitra.id', 'mitra.nama',
                'SUM(store.jumlah_store) AS jumlah_store',
                'SUM(distribusi.jumlah_set) AS jumlah_set'
            ])
                ->xjoin('distribusi')
                ->joinAlt('store', 'distribusi')
                ->where('store.created_at >=', date("Y-m-d", $fromDateDistStore2))
                ->where('store.created_at <=', date("Y-m-d", $toDateDistStore2))
                ->groupBy('mitra.id')
                ->get();

            $data['fromDate'] = $fromDateDistStore;
            $data['toDate']   = $toDateDistStore;
        }

        $this->load->view('pages/report/list_report_dist_store', $data);
    }


    public function requestDetailDistStore($id_mitra, $fromDate, $toDate)
    {
        $this->report->table = 'mitra';
        $data['detail'] = $this->report->select([
            'store.jumlah_store', 'distribusi.jumlah_set', 'mitrawork.nama_mitrawork', 'distribusi.id_progress', 'store.created_at'
        ])
            ->xjoin('distribusi')
            ->joinAlt('store', 'distribusi')
            ->joinAlt3('mitrawork', 'distribusi')
            ->where('store.created_at >=', $fromDate)
            ->where('store.created_at <=', $toDate)
            ->where('mitra.id', $id_mitra)
            ->orderBy('store.created_at', 'DESC')
            ->get();

        echo show_my_modal('pages/report/modal_detail_laporan_dist_store', 'modal-detail-laporan-dist-store', $data, 'lg');
    }

    public function tes()
    {
        $this->report->table = 'mitra';
        $data['content'] = $this->report->select([
            'mitra.id', 'mitra.nama',
            'SUM(store.jumlah_store) AS jumlah_store',
            'SUM(distribusi.jumlah_set) AS jumlah_set'
        ])
            ->xjoin('distribusi')
            ->joinAlt('store', 'distribusi')
            ->groupBy('mitra.id')
            ->get();

        print_r($data['content']);
    }

    public function OutIn()
    {
        $this->report->table    = 'mitra';
        $data['mitra']          = $this->report->get();
        $data['title']          = 'Laporan Mitra In Out';
        $data['nav_title']      = 'laporan-mitra-in-out';
        $data['title_detail']   = 'Form Laporan Mitra In Out';
        $data['page']           = 'pages/report/mitra_in_out';

        $this->view($data);
    }

    public function requestMitraInOut()
    {
        $fromDate = $this->input->post('fromDate', true);
        $toDate   = $this->input->post('toDate', true);

        $fromDate2 = strtotime($fromDate);
        $toDate2   = strtotime($toDate);

        $this->report->table    = 'mitra';
        $mitra_in =
            "SELECT * FROM `mitra`
        WHERE `mitra`.`tgl_mulai_kerja` >= '" . date("Y-m-d", $fromDate2) . "' AND `mitra`.`tgl_mulai_kerja` <= '" . date("Y-m-d", $toDate2) . "' AND `mitra`.`is_active` = 1";
        $data['mitra_in']       = $this->db->query($mitra_in)->result_array();


        $this->report->table    = 'mitra_out';
        $mitra_out = "SELECT `mitra`.*, `mitra_out`.`id` , `mitra_out`.`tgl_mitra_out`
        FROM `mitra`
        LEFT JOIN `mitra_out` ON `mitra`.`id` = `mitra_out`.`id`
        WHERE `mitra_out`.`tgl_mitra_out` >= '" . date("Y-m-d", $fromDate2) . "' AND `mitra_out`.`tgl_mitra_out` <= '" . date("Y-m-d", $toDate2) . "' AND `mitra`.`is_active` = 0";

        $data['mitra_out'] = $this->db->query($mitra_out)->result_array();


        $this->load->view('pages/report/list_report_mitra_in_out', $data);
    }

    public function exportToExcelMitraInOut()
    {
        $fromDate = $this->input->post('fromDate', true);
        $toDate   = $this->input->post('toDate', true);

        $fromDate2 = strtotime($fromDate);
        $toDate2   = strtotime($toDate);

        $in =
            "SELECT * FROM `mitra`
        WHERE `mitra`.`tgl_mulai_kerja` >= '" . date("Y-m-d", $fromDate2) . "' AND `mitra`.`tgl_mulai_kerja` <= '" . date("Y-m-d", $toDate2) . "' AND `mitra`.`is_active` = 1";
        $mitra_in    = $this->db->query($in)->result_array();


        $this->report->table    = 'mitra_out';
        $out = "SELECT `mitra`.*, `mitra_out`.`id` , `mitra_out`.`tgl_mitra_out`
        FROM `mitra`
        LEFT JOIN `mitra_out` ON `mitra`.`id` = `mitra_out`.`id`
        WHERE `mitra_out`.`tgl_mitra_out` >= '" . date("Y-m-d", $fromDate2) . "' AND `mitra_out`.`tgl_mitra_out` <= '" . date("Y-m-d", $toDate2) . "' AND `mitra`.`is_active` = 0";

        $mitra_out = $this->db->query($out)->result_array();

        // var_dump([
        //     'mitra_in' => $mitra_in,
        //     'mitra_out' => $mitra_out
        // ]);
        // die;


        // $this->report->table    = 'mitra';
        // $mitra_in       = $this->report->where('mitra.tgl_mulai_kerja >=', date("Y-m-d", $fromDate2))
        //     ->where('mitra.tgl_mulai_kerja <=', date("Y-m-d", $toDate2))
        //     ->get();

        // $this->report->table    = 'mitra_out';
        // $mitra_out       = $this->report->where('mitra_out.tgl_mitra_out >=', date("Y-m-d", $fromDate2))
        //     ->where('mitra_out.tgl_mitra_out <=', date("Y-m-d", $toDate2))
        //     ->get();


        if ($mitra_in && $mitra_out) {
            include_once APPPATH . '/third_party/xlsxwriter.class.php';
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
            error_reporting(E_ALL & ~E_NOTICE);
            $filename = "data-mitra-in-out-" . date('d-m-Y-His') . ".xlsx";
            header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');

            $styles = array(
                'widths' => [7, 30, 25, 12, 17, 25, 19, 135, 17, 14, 17],
                'heights' => [21],
                'font' => 'Arial', 'font-size' => 12,
                'font-style' => 'bold',
                'fill' => '#eee',
                'halign' => 'center',
                'border' => 'left,right,top,bottom',
                'border-style'  => 'thin'
            );

            $styles_out = array(
                'widths' => [7, 30, 25, 12, 17, 25, 19, 135, 17, 14, 17, 50, 20],
                'heights' => [21],
                'font' => 'Arial', 'font-size' => 12,
                'font-style' => 'bold',
                'fill' => '#eee',
                'halign' => 'center',
                'border' => 'left,right,top,bottom',
                'border-style'  => 'thin'
            );

            $styles2 = array(
                [
                    'font' => 'Arial', 'font-size' => 11,
                    'halign' => 'left',
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
            );

            $styles2_out = array(
                [
                    'font' => 'Arial', 'font-size' => 11,
                    'halign' => 'left',
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
            );

            $header = array(
                'No'                => 'integer',
                'No Mitra'          => 'string',
                'Nama'              => 'string',
                'Tgl Lahir'         => 'dd/mm/yyyy',
                'Tgl Mulai Kerja'   => 'dd/mm/yyyy',
                'Durasi Kerja'      => 'string',
                'No HP'             => 'string',
                'Alamat'            => 'string',
                'Jenis Kelamin'     => 'string',
                'Tempat'            => 'string',
                'Status'            => 'string',

            );

            $header2 = array(
                'No'                => 'integer',
                'No Mitra'          => 'string',
                'Nama'              => 'string',
                'Tgl Lahir'         => 'dd/mm/yyyy',
                'Tgl Mulai Kerja'   => 'dd/mm/yyyy',
                'Durasi Kerja'      => 'string',
                'No HP'             => 'string',
                'Alamat'            => 'string',
                'Jenis Kelamin'     => 'string',
                'Tempat'            => 'string',
                'Status'            => 'string',
                'Alasan Keluar'     => 'string',
                'Tgl Keluar'        => 'dd/mm/yyyy',

            );

            $writer = new XLSXWriter();
            $writer->setAuthor('admin');

            $writer->writeSheetHeader('Mitra_In', $header, $styles);
            $writer->writeSheetHeader('Mitra_Out', $header2, $styles_out);

            $no = 1;

            foreach ($mitra_in as $row) {
                $waktuAwal = new DateTime($row['tgl_mulai_kerja'] . " 00:00:00");
                $waktuSekarang = new DateTime();
                $diff = date_diff($waktuAwal, $waktuSekarang);

                if ($diff->m == 0 && $diff->y == 0) {
                    $durasi = 'Kurang dari sebulan';
                } else if ($diff->y > 0) {
                    $durasi = $diff->y . ' tahun ' . $diff->m . ' bulan';
                } else {
                    $durasi = $diff->m . ' bulan';
                }

                $writer->writeSheetRow(
                    'Mitra_In',
                    [
                        $no,
                        $row['id'],
                        $row['nama'],
                        $row['tgl_lahir'],
                        $row['tgl_mulai_kerja'],
                        $durasi,
                        $row['nohp'],
                        $row['alamat'],
                        ucwords($row['jenis_kelamin']),
                        ucwords($row['tempat']),
                        $row['status_nikah'] == "belum_nikah" ? "Belum Nikah" : ucwords($row['status_nikah'])

                    ],
                    $styles2
                );
                $no++;
            }

            foreach ($mitra_out as $row) {
                $waktuAwal = new DateTime($row['tgl_mulai_kerja'] . " 00:00:00");
                $waktuSekarang = new DateTime();
                $diff = date_diff($waktuAwal, $waktuSekarang);

                if ($diff->m == 0 && $diff->y == 0) {
                    $durasi = 'Kurang dari sebulan';
                } else if ($diff->y > 0) {
                    $durasi = $diff->y . ' tahun ' . $diff->m . ' bulan';
                } else {
                    $durasi = $diff->m . ' bulan';
                }

                $writer->writeSheetRow(

                    'Mitra_Out',
                    [
                        $no,
                        $row['id'],
                        $row['nama'],
                        $row['tgl_lahir'],
                        $row['tgl_mulai_kerja'],
                        $durasi,
                        $row['nohp'],
                        $row['alamat'],
                        ucwords($row['jenis_kelamin']),
                        ucwords($row['tempat']),
                        $row['status_nikah'] == "belum_nikah" ? "Belum Nikah" : ucwords($row['status_nikah']),
                        $row['status'] == "Lainnya" ? $row['keterangan'] : $row['status'],
                        $row['tgl_mitra_out']
                    ],
                    $styles2_out
                );

                $no++;
            }
            $writer->writeToStdOut();
        } else {
            // $this->session->set_flashdata('warning', 'Tidak Ada Data!');
            // if ($jenis_mitra == "mitra_out") {
            //     redirect(base_url("mitra/out"));
            // } else {
            //     redirect(base_url("mitra"));
            // }
        }
    }

    public function guntingRealisasi()
    {
        $this->report->table    = 'mitra';
        $data['mitra']          = $this->report->get();
        $data['title']          = 'Laporan Gunting & Realisasi';
        $data['nav_title']      = 'laporan-gunting-realisasi';
        $data['title_detail']   = 'Form Laporan Gunting Dan Realisasi';
        $data['page']           = 'pages/report/gunting_realisasi';
        $this->view($data);
    }

    public function requestGuntingRealisasiReport()
    {

        $id_mitra                 = $this->input->post('id_mitra');
        $fromDateGuntingRealisasi = $this->input->post('fromDateGuntingRealisasi', true);
        $toDateGuntingRealisasi   = $this->input->post('toDateGuntingRealisasi', true);

        $fromDateGuntingRealisasi2 = strtotime($fromDateGuntingRealisasi);
        $toDateGuntingRealisasi2   = strtotime($toDateGuntingRealisasi);

        $fromDate = date("Y-m-d", $fromDateGuntingRealisasi2);
        $toDate = date("Y-m-d", $toDateGuntingRealisasi2);

        if ($fromDateGuntingRealisasi && $toDateGuntingRealisasi) {
            $query = $this->db->query("SELECT DISTINCT penggunting.id_progress AS id, progress.motif FROM penggunting, progress WHERE progress.id = penggunting.id_progress AND penggunting.id_mitra = '$id_mitra' AND progress.tanggal_rencana >= '$fromDate' AND progress.tanggal_rencana <= '$toDate'");
            $data['content'] = $query->result();

            $data['fromDate'] = $fromDateGuntingRealisasi;
            $data['toDate']   = $toDateGuntingRealisasi;
        }

        //print_r($data['content']);
        $this->load->view('pages/report/list_report_gunting_realisasi', $data);
    }

    public function excel_detail_dist_store()
    {
        $id_mitra = $this->input->get('id_mitra', true);
        $fromDate = $this->input->get('fromDate', true);
        $toDate   = $this->input->get('toDate', true);

        $this->report->table = 'mitra';
        $data['detail'] = $this->report->select([
            'store.jumlah_store', 'distribusi.jumlah_set', 'mitrawork.nama_mitrawork', 'distribusi.id_progress', 'store.created_at'
        ])
            ->xjoin('distribusi')
            ->joinAlt('store', 'distribusi')
            ->joinAlt3('mitrawork', 'distribusi')
            ->where('store.created_at >=', $fromDate)
            ->where('store.created_at <=', $toDate)
            ->where('mitra.id', $id_mitra)
            ->orderBy('store.created_at', 'DESC')
            ->get();

        print_r($data['detail']);
        // $spreadsheet    = new Spreadsheet();

        // $spreadsheet->getActiveSheet()->mergeCells('A2:C2');
        // $spreadsheet->getActiveSheet()->mergeCells('A3:C3');
        // $spreadsheet->getActiveSheet()->setCellValue('A2', 'SALES REPORT PERDAY');
        // $spreadsheet->getActiveSheet()->setCellValue('A3', 'July' . ' ' . '2021');

        // $writer = new Xlsx($spreadsheet);

        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename="TesAja.xlsx"');
        // header('Cache-Control: max-age=0');

        // $writer->save('php://output');
    }
}
