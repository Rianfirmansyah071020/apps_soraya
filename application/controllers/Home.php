<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
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
        $this->home->table = 'progress';
        $data['countProgress'] = $this->home->where('MONTH(tanggal)', date("m"))->count();

        $this->home->table = 'distribusi';
        $data['countDist']     = $this->home->select([
            'distribusi.jumlah_set', 'progress.tanggal'
        ])
            ->join('progress')
            ->where('MONTH(progress.tanggal)', date("m"))
            ->get();

        $this->home->table = 'store AS s';
        $data['countStore'] = $this->home->select([
            's.jumlah_store', 'progress.tanggal'
        ])
            ->join('distribusi')
            ->joinAlt2('progress', 'distribusi')
            ->where('MONTH(progress.tanggal)', date("m"))
            ->get();

        $this->home->table = 'mitra';
        $data['countMitra'] = $this->home->where('is_active', true)->count();

        $data['rankMitra'] = $this->home->select([
            'mitra.id', 'mitra.nama',
            'SUM(store.jumlah_store) AS jumlah_store',
            'SUM(distribusi.jumlah_set) AS jumlah_set', '(SUM(distribusi.jumlah_set) - SUM(store.jumlah_store)) AS belum_selesai'
        ])
            ->xjoin('distribusi')
            ->joinAlt('store', 'distribusi')
            ->where('MONTH(store.created_at)', date("m"))
            ->orderBy('belum_selesai')
            ->groupBy('mitra.id')
            ->where('is_active', true)
            ->limit(5)
            ->get();

        $data['page'] = 'pages/home/index';
        $data['title'] = 'Dashboard';
        $data['nav_title'] = 'home';
        $this->view($data);
    }

    public function requestProgressChart()
    {
        $this->home->table = 'distribusi';

        for ($i = 1; $i <= 12; $i++) {
            $data['proses' . $i]    = $this->home->select([
                'SUM(store.jumlah_store) AS jumlah'
            ])
                ->xjoin('store')
                ->join('progress')
                ->where('YEAR(progress.tanggal)', date("Y"))
                ->where('MONTH(progress.tanggal)', $i)
                ->where('distribusi.status_pekerjaan', 'proses')
                ->get();

            $data['selesai' . $i]    = $this->home->select([
                'SUM(store.jumlah_store) AS jumlah'
            ])
                ->xjoin('store')
                ->join('progress')
                ->where('YEAR(progress.tanggal)', date("Y"))
                ->where('MONTH(progress.tanggal)', $i)
                ->where('distribusi.status_pekerjaan', 'selesai')
                ->get();


            $data['dikerjakan' . $i]   = $this->home->select(
                [
                    'SUM(distribusi.jumlah_set) AS jumlah'
                ]
            )
                ->join('progress')
                ->where('YEAR(progress.tanggal)', date("Y"))
                ->where('MONTH(progress.tanggal)', $i)
                ->where('distribusi.status_pekerjaan', 'dikerjakan')
                ->get();
        }

        echo json_encode($data);
    }

    public function requestCountDoneProgress()
    {
        $this->home->table = 'progress';
        $id_progres = $this->home->select([
            'progress.id'
        ])->where('MONTH(progress.tanggal)', date("m"))->get();

        $i = 0;
        $y = 0;
        $z = 0;
        foreach ($id_progres as $row) {
            if (checkDistribusi($row->id) == checkStatusSelesaiDistribusi($row->id) && checkDistribusi($row->id) != 0) {
                $i++;
            }

            if (checkDistribusi($row->id) != checkStatusSelesaiDistribusi($row->id) && checkDistribusi($row->id) != 0) {
                $y++;
            }

            if (checkDistribusi($row->id) == checkStatusDikerjakanDistribusi($row->id) && checkDistribusi($row->id) != 0) {
                $z++;
            }
        }

        $data = [
            'selesai' => $i,
            'belum_selesai' => $y,
            'dikerjakan'    => $z
        ];

        echo json_encode($data);
    }

    public function requestDurasiKerjaMitra()
    {
        $mitra = $this->home->where('is_active', true)->get();
        $count = 0;
        $count2 = 0;
        $count3 = 0;
        foreach ($mitra as $row) {
            $date_diff = date_diff(new DateTime($row->tgl_mulai_kerja), new DateTime(date("Y-m-d")));

            if ($date_diff->y < 1) {
                $count++;
            }

            if ($date_diff->y >= 1 && $date_diff->y <= 5) {
                $count2++;
            }

            if ($date_diff->y > 5) {
                $count3++;
            }
        }
        $data['kurangsetahun']      = $count;
        $data['rentang']            = $count2;
        $data['lebihdarirentang']   = $count3;

        echo json_encode($data);
    }

    public function requestUmurKerjaMitra()
    {
        $mitra = $this->home->where('is_active', true)->get();
        $umur = 0;
        $umur2 = 0;
        $umur3 = 0;
        foreach ($mitra as $row) {
            $date_diff_umur = date_diff(new DateTime($row->tgl_lahir), new DateTime(date("Y-m-d")));

            if ($date_diff_umur->y >= 17 && $date_diff_umur->y <= 29) {
                $umur++;
            }

            if ($date_diff_umur->y >= 30 && $date_diff_umur->y <= 49) {
                $umur2++;
            }

            if ($date_diff_umur->y >= 50) {
                $umur3++;
            }
        }

        $data['umur'] = $umur;
        $data['umur2'] = $umur2;
        $data['umur3'] = $umur3;

        echo json_encode($data);
    }
}
