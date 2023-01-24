<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mymitra extends MY_Controller
{

    public function index()
    {
        $data['title'] = 'Check Pekerjaan Mitra';
        $data['page']  = 'pages/mymitra/index';

        $this->view_check($data);
    }

    public function requestMitraReport()
    {
        $id_mitra = $this->input->post('id_mitra', true);
        $fromDate = $this->input->post('fromDate', true);
        $toDate   = $this->input->post('toDate', true);

        $fromDate2 = strtotime($fromDate);
        $toDate2   = strtotime($toDate);

        if ($id_mitra && $fromDate && $toDate) {
            $this->mymitra->table = 'distribusi';
            $data['content'] = $this->mymitra->select([
                'progress.id', 'store.created_at AS tanggal_store', 'mitrawork.nama_mitrawork', 'distribusi.jumlah_set',
                'store.jumlah_store', 'distribusi.status_pekerjaan'
            ])
                ->join('progress')
                ->join('mitrawork')
                ->xjoin('store')
                ->where('store.created_at >=', date("Y-m-d", $fromDate2))
                ->where('store.created_at <=', date("Y-m-d", $toDate2))
                ->where('distribusi.id_mitra', $id_mitra)
                ->get();

            $data['countSelesai'] = $this->mymitra->select([
                'progress.id', 'store.created_at AS tanggal_store', 'mitrawork.nama_mitrawork', 'distribusi.jumlah_set',
                'store.jumlah_store', 'distribusi.status_pekerjaan'
            ])
                ->join('progress')
                ->join('mitrawork')
                ->xjoin('store')
                ->where('store.created_at >=', date("Y-m-d", $fromDate2))
                ->where('store.created_at <=', date("Y-m-d", $toDate2))
                ->where('distribusi.id_mitra', $id_mitra)
                ->where('distribusi.status_pekerjaan', 'selesai')
                ->count();

            $data['countProses'] = $this->mymitra->select([
                'progress.id', 'store.created_at AS tanggal_store', 'mitrawork.nama_mitrawork', 'distribusi.jumlah_set',
                'store.jumlah_store', 'distribusi.status_pekerjaan'
            ])
                ->join('progress')
                ->join('mitrawork')
                ->xjoin('store')
                ->where('store.created_at >=', date("Y-m-d", $fromDate2))
                ->where('store.created_at <=', date("Y-m-d", $toDate2))
                ->where('distribusi.id_mitra', $id_mitra)
                ->where('distribusi.status_pekerjaan', 'proses')
                ->count();
        }
        $this->load->view('pages/mymitra/list_data_store_check_mitra', $data);
    }

    public function requestMitraChart()
    {

        $id_mitra = $this->input->post('id_mitra', true);

        if ($id_mitra) {
            $this->mymitra->table = 'distribusi';

            for ($i = 1; $i <= 12; $i++) {
                $data['selesai' . $i] = $this->mymitra->select(
                    [
                        'distribusi.status_pekerjaan', 'COUNT(distribusi.status_pekerjaan) AS jumlah', 'MONTH(store.created_at) AS bulan'
                    ]
                )
                    ->xjoin('store')
                    ->where('distribusi.id_mitra', $id_mitra)
                    ->where('YEAR(store.created_at)', date("Y"))
                    ->where('MONTH(store.created_at)', $i)
                    ->where('distribusi.status_pekerjaan', 'selesai')
                    ->get();

                $data['proses' . $i] = $this->mymitra->select(
                    [
                        'distribusi.status_pekerjaan', 'COUNT(distribusi.status_pekerjaan) AS jumlah', 'MONTH(store.created_at) AS bulan'
                    ]
                )
                    ->xjoin('store')
                    ->where('distribusi.id_mitra', $id_mitra)
                    ->where('YEAR(store.created_at)', date("Y"))
                    ->where('MONTH(store.created_at)', $i)
                    ->where('distribusi.status_pekerjaan', 'proses')
                    ->get();
            }

            echo json_encode($data);
        }
    }

    public function requestDataMitra()
    {
        $id_mitra = $this->input->post('id_mitra', true);

        if ($id_mitra) {
            $this->mymitra->table = 'mitra';
            $data['getMitra'] = $this->mymitra->where('id', $id_mitra)->first();
        }

        if ($data['getMitra']) {
            $this->load->view('pages/mymitra/list_data_check_mitra', $data);
        }
    }
}
