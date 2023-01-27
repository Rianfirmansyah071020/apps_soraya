<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Store extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if (
            $role == 'admin' ||
            $role == 'admin_store' ||
            $role == 'admin_operator' ||
            $role == 'admin_distribusi'
        ) {
            return;
        } else {
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $this->store->table = 'progress';
        $data['content'] = $this->store
            ->where('YEAR(tanggal)', date("Y"))
            ->where('MONTH(tanggal)', date("m"))
            ->orderBy('tanggal', 'DESC')
            ->get();

        foreach ($data['content'] as $content) {
            $this->store->table = 'distribusi';
            $getDistribusi = $this->store->select([
                'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan', 'distribusi.id AS id_distribusi',
                '(distribusi.jumlah_set - store.jumlah_store) AS sisa_set',
                'mitra.id', 'store.jumlah_store', 'store.created_at',
                'mitra.nama', 'mitrawork.nama_mitrawork'
            ])
                ->join('mitra')
                ->xjoin('store', 'inner')
                ->join('mitrawork')
                ->where('id_progress', $content->id)->get();

            foreach ($getDistribusi as $row) {
                if ($row->sisa_set != 0) {
                    $data_update = array(
                        'status_pekerjaan' => 'proses'
                    );

                    $this->store->where('id', $row->id_distribusi)->update($data_update);
                } else {
                    $data_update = array(
                        'status_pekerjaan' => 'selesai'
                    );

                    $this->store->where('id', $row->id_distribusi)->update($data_update);
                }
            }
        }
        $data['page'] = 'pages/store/index';
        $data['title'] = 'Daftar Penyerahan Pekerjaan';
        $data['nav_title'] = 'store';
        $data['title_detail'] = 'Daftar Penyerahan Pekerjaan';
        $this->view($data);
    }

    public function filter($month, $year)
    {
        $this->store->table = 'progress';
        $data['content'] = $this->store->where('MONTH(tanggal)', $month)->where('YEAR(tanggal)', $year)->orderBy('tanggal', 'DESC')->get();

        foreach ($data['content'] as $content) {
            $this->store->table = 'distribusi';
            $getDistribusi = $this->store->select([
                'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan', 'distribusi.id AS id_distribusi',
                '(distribusi.jumlah_set - store.jumlah_store) AS sisa_set',
                'mitra.id', 'store.jumlah_store', 'store.created_at',
                'mitra.nama', 'mitrawork.nama_mitrawork'
            ])
                ->join('mitra')
                ->xjoin('store', 'inner')
                ->join('mitrawork')
                ->where('id_progress', $content->id)->get();

            foreach ($getDistribusi as $row) {
                if ($row->sisa_set != 0) {
                    $data_update = array(
                        'status_pekerjaan' => 'proses'
                    );

                    $this->store->where('id', $row->id_distribusi)->update($data_update);
                } else {
                    $data_update = array(
                        'status_pekerjaan' => 'selesai'
                    );

                    $this->store->where('id', $row->id_distribusi)->update($data_update);
                }
            }
        }
        $data['title'] = 'Daftar Progress';
        $data['nav_title'] = 'progress';
        $data['title_detail'] = 'Daftar Progress';

        $this->load->view('pages/store/table', $data);
    }

    public function store_pekerjaan($idProgress)
    {
        $this->store->table = 'distribusi';
        $data['countDistribusi'] = $this->store->select([

            'distribusi.id AS id_distribusi',
            'distribusi.id_progress',
            'distribusi.jumlah_set',
            'mitrawork.nama_mitrawork',
            'mitra.nama',
            'distribusi.status_pekerjaan'
        ])
            ->join('mitra')
            ->join('mitrawork')
            ->where('id_progress', $idProgress)
            ->count();

        $data['id'] = $idProgress;

        $this->store->table = 'mitrawork';
        $data['mitrawork'] = $this->store->get();

        $data['page'] = 'pages/store/form_store';
        $data['title'] = 'Form Store Pekerjaan';
        $data['nav_title'] = 'store';

        $this->view($data);
    }

    public function showForm($idProgress)
    {
        $id_progress = $idProgress;
        $option = '';

        $this->store->table = 'distribusi';
        $hitungDist = $this->store->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan',
            'mitra.id', 'store.jumlah_store', 'distribusi.id AS id_distribusi',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->xjoin('store')
            ->join('mitrawork')
            ->where('id_progress', $idProgress)
            ->where('store.jumlah_store', null)
            ->count();

        $countStore = $this->store->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan',
            'mitra.id', 'store.jumlah_store',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->xjoin('store', 'inner')
            ->join('mitrawork')
            ->where('id_progress', $idProgress)->count();

        if ($countStore == 0) {
            $dist = $this->store->select([
                'distribusi.id AS id_distribusi', 'distribusi.id_progress', 'distribusi.jumlah_set', 'mitrawork.nama_mitrawork', 'mitra.nama',
                'distribusi.status_pekerjaan'
            ])
                ->join('mitra')
                ->join('mitrawork')
                ->where('id_progress', $idProgress)
                ->get();

            $countDist = $this->store->select([
                'distribusi.id AS id_distribusi', 'distribusi.id_progress', 'distribusi.jumlah_set', 'mitrawork.nama_mitrawork', 'mitra.nama',
                'distribusi.status_pekerjaan'
            ])
                ->join('mitra')
                ->join('mitrawork')
                ->where('id_progress', $idProgress)
                ->count();

            if ($hitungDist != 0) {
                foreach ($dist as $row) {
                    $option .= '<option value="' . $row->id_distribusi . '">' . $row->nama_mitrawork . ' - ' . $row->nama . ' - Jumlah Set : ' . $row->jumlah_set . '</option>';
                }
            }
        } else {
            $dist2 = $this->store->select([
                'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan',
                'mitra.id', 'store.jumlah_store', 'distribusi.id AS id_distribusi',
                'mitra.nama', 'mitrawork.nama_mitrawork'
            ])
                ->join('mitra')
                ->xjoin('store')
                ->join('mitrawork')
                ->where('id_progress', $idProgress)
                ->where('store.jumlah_store', null)
                ->get();

            $countDist =  $dist = $this->store->select([
                'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan',
                'mitra.id', 'store.jumlah_store', 'distribusi.id AS id_distribusi',
                'mitra.nama', 'mitrawork.nama_mitrawork'
            ])
                ->join('mitra')
                ->xjoin('store')
                ->join('mitrawork')
                ->where('id_progress', $idProgress)
                ->where('store.jumlah_store', null)
                ->count();

            if ($hitungDist != 0) {
                foreach ($dist2 as $row) {
                    $option .= '<option value="' . $row->id_distribusi . '">' . $row->nama_mitrawork . ' - ' . $row->nama . ' - Jumlah Set : ' . $row->jumlah_set . '</option>';
                }
            }
        }


        $output = '
                    <input type="hidden" name="id_progress[]" value="' . $id_progress . '">
                    <input type="hidden" name="status_pekerjaan[]" value="' . $row->status_pekerjaan . '">
                    <input type="hidden" name="jumlah_set[]" value="' . $row->status_pekerjaan . '">
                    <div class="col-xs-6" style="margin-top: 20px;">
                        <h2 class="card-inside-title">Pilih Data Distribusi</h2>
                        <select class="form-control show-tick select2" name="id_distribusi[]">
                            <option></option>
                        ' . $option . '
                        </select>
                    </div>
                    <div class="col-xs-6" style="margin-top: 20px;">
                        <h2 class="card-inside-title">Jumlah Set</h2>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" name="jumlah_store[]" required />
                            </div>
                        </div>
                    </div> 
        ';

        echo json_encode(array(
            'form' => $output,
            'count' => $countDist
        ));
    }

    public function insert_store($id)
    {
        $id_progress    = $this->input->post('id_progress', true);
        $id_distribusi  = $this->input->post('id_distribusi', true);
        $jumlah_store   = $this->input->post('jumlah_store', true);
        $jumlah_set     = $this->input->post('jumlah_set', true);
        $status_pekerjaan  = $this->input->post('status_pekerjaan', true);

        $data = array();
        $data_update = array();

        $i = 0;

        foreach ($id_progress as $row) {

            $this->store->table = 'store';
            $getStore = $this->store->where('distribusi.id_progress', $id)
                ->join('distribusi')
                ->count();

            $id2 = date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1);
            if ($status_pekerjaan[$i] == 'dikerjakan') {
                array_push($data, array(
                    'id'            => $id2,
                    'id_distribusi' => $id_distribusi[$i],
                    'jumlah_store'  => $jumlah_store[$i] >= $jumlah_set[$i] ? $jumlah_set[$i] : $jumlah_store[$i],
                    'nama_admin'    => $this->session->userdata('name'),
                ));
            }

            if ($getStore == 0) {
                $id = date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1);

                if ($jumlah_set[$i] <= $jumlah_store[$i]) {
                    array_push($data_update, array(
                        'id'               => $id_distribusi[$i],
                        'status_pekerjaan' => 'selesai'
                    ));
                } else {
                    array_push($data_update, array(
                        'id'               => $id_distribusi[$i],
                        'status_pekerjaan' => 'proses'
                    ));
                }

                if ($status_pekerjaan[$i] != 'dikerjakan') {
                    array_push($data, array(
                        'id'            => $id,
                        'id_distribusi' => $id_distribusi[$i],
                        'jumlah_store'  => $jumlah_store[$i] >= $jumlah_set[$i] ? $jumlah_set[$i] : $jumlah_store[$i],
                        'nama_admin'    => $this->session->userdata('name'),
                    ));
                }
            } else {
                if ($jumlah_set[$i] <= $jumlah_store[$i]) {
                    array_push($data_update, array(
                        'id'               => $id_distribusi[$i],
                        'status_pekerjaan' => 'selesai'
                    ));
                } else {
                    array_push($data_update, array(
                        'id'               => $id_distribusi[$i],
                        'status_pekerjaan' => 'proses'
                    ));
                }

                $data_update2 = array(
                    'jumlah_store' => $jumlah_store[$i] >= $jumlah_set[$i] ? $jumlah_set[$i] : $jumlah_store[$i]
                );

                $this->store->where('store.id_distribusi', $id_distribusi[$i])
                    ->update($data_update2);
            }
            $i++;
        }

        if (count($data) > 0) {
            if ($this->db->insert_batch('store', $data)) {
                if (count($data_update) > 0) {
                    $this->db->update_batch('distribusi', $data_update, 'id');
                }
                $this->session->set_flashdata('success', 'Data has been saved!');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong!');
            }
        } else {
            $this->db->update_batch('distribusi', $data_update, 'id');
            $this->session->set_flashdata('success', 'Data has been saved!');
        }

        redirect('store');
    }

    public function edit_store_pekerjaan($idProgress)
    {
        $this->store->table = 'distribusi';
        $data['getDistribusi'] = $this->store->select([
            'distribusi.id AS id_distribusi', 'distribusi.id_progress', 'distribusi.jumlah_set', 'mitrawork.nama_mitrawork', 'mitra.nama',
            'distribusi.status_pekerjaan', 'store.jumlah_store', 'store.id AS id_store'
        ])->xjoin('store', 'inner')->join('mitra')->join('mitrawork')->where('id_progress', $idProgress)
            ->get();

        $data['id'] = $idProgress;

        $this->store->table = 'mitrawork';
        $data['mitrawork'] = $this->store->get();

        $data['page'] = 'pages/store/form_edit_store';
        $data['title'] = 'Form Edit Store Pekerjaan';
        $data['nav_title'] = 'store';

        $this->view($data);
    }

    public function update_store()
    {
        $id_progress    = $this->input->post('id_progress', true);
        $id_distribusi  = $this->input->post('id_distribusi', true);
        $id_store  = $this->input->post('id_store', true);
        $jumlah_store   = $this->input->post('jumlah_store', true);
        $jumlah_set     = $this->input->post('jumlah_set', true);
        $status_pekerjaan  = $this->input->post('status_pekerjaan', true);

        $data_update = array();

        $i = 0;

        foreach ($id_progress as $row) {
            $data_update[] = array(
                'id'            => $id_store[$i],
                'jumlah_store'  => $jumlah_store[$i] > $jumlah_set[$i] ? $jumlah_set[$i] : $jumlah_store[$i]
            );
            $i++;
        }

        if (count($data_update) > 0) {
            if ($this->db->update_batch('store', $data_update, 'id')) {
                $this->session->set_flashdata('success', 'Data has been updated!');
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong');
            }
        } else {
            $this->session->set_flashdata('warning', 'Data has not found');
        }

        redirect(base_url('store'));
    }

    public function loadCetak()
    {
        $id_progress = $this->input->get('id', true);
        $data['id_progress'] = $id_progress;
        $this->store->table = 'perencanaan';
        $data['perencanaan'] = $this->store->select([
            'jenis_pekerjaan.nama_pekerjaan', 'perencanaan.id_progress', 'perencanaan.qty', 'perencanaan.id_jenis_bantal',
            'realisasi.qty AS jumlah_realisasi'
        ])
            ->join('jenis_pekerjaan')
            ->xjoin('realisasi')
            ->where('perencanaan.id_progress', $id_progress)
            ->get();

        $this->store->table = 'progress';
        $data['tanggal_progress'] = $this->store->where('id', $id_progress)->first();

        $this->store->table = 'jenis_bantal';
        $data['jenis_bantal'] = $this->store->get();
        $data['jumlah_bantal'] = $this->store->count();

        foreach ($data['jenis_bantal'] as $row) {
            $this->store->table = 'perencanaan';
            $data['total']['bt' . $row->id] =
                $this->store->where('perencanaan.id_jenis_bantal', $row->id)
                ->where('perencanaan.id_progress', $id_progress)
                ->get();

            $data['total_perencanaan']['realisasi' . $row->id] =
                $this->store->select([
                    'realisasi.qty AS qty'
                ])
                ->xjoin('realisasi')
                ->where('perencanaan.id_jenis_bantal', $row->id)
                ->where('perencanaan.id_progress', $id_progress)->get();
        }

        $this->store->table = 'distribusi';
        $data['distribusi'] = $this->store->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan', 'distribusi.id AS id_distribusi',
            '(distribusi.jumlah_set - store.jumlah_store) AS sisa_set',
            'mitra.id', 'store.jumlah_store', 'store.created_at',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->xjoin('store', 'inner')
            ->join('mitrawork')
            ->where('id_progress', $id_progress)->get();

        $data['belum_setor'] = $this->store->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan', 'distribusi.created_at',
            'mitra.id', 'store.jumlah_store', 'distribusi.id AS id_distribusi',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->xjoin('store')
            ->join('mitrawork')
            ->where('id_progress', $id_progress)
            ->where('store.jumlah_store', null)
            ->get();

        $this->load->view('pages/store/cetak_kartu', $data);
    }

    public function detail()
    {
        $id = $this->input->get('id', true);

        $this->store->table = 'distribusi';
        $getDistribusi = $this->store->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan', 'distribusi.id AS id_distribusi',
            '(distribusi.jumlah_set - store.jumlah_store) AS sisa_set',
            'mitra.id', 'store.jumlah_store', 'store.created_at',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->xjoin('store', 'inner')
            ->join('mitrawork')
            ->where('id_progress', $id)->get();

        foreach ($getDistribusi as $row) {
            if ($row->sisa_set != 0) {
                $data_update = array(
                    'status_pekerjaan' => 'proses'
                );
                $this->store->where('id', $row->id_distribusi)->update($data_update);
            } else {
                $data_update = array(
                    'status_pekerjaan' => 'selesai'
                );

                $this->store->where('id', $row->id_distribusi)->update($data_update);
            }
        }

        $data['content'] = $this->store->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan', 'distribusi.id AS id_distribusi',
            '(distribusi.jumlah_set - store.jumlah_store) AS sisa_set',
            'mitra.id', 'store.jumlah_store', 'store.created_at',
            'mitra.nama', 'mitrawork.nama_mitrawork',
        ])
            ->join('mitra')
            ->xjoin('store', 'inner')
            ->join('mitrawork')
            ->where('id_progress', $id)->get();

        $data['belum_setor'] = $this->store->select([
            'distribusi.id_progress', 'distribusi.id_mitra', 'distribusi.id_mitrawork', 'distribusi.jumlah_set', 'distribusi.status_pekerjaan', 'distribusi.created_at',
            'mitra.id', 'store.jumlah_store', 'distribusi.id AS id_distribusi',
            'mitra.nama', 'mitrawork.nama_mitrawork'
        ])
            ->join('mitra')
            ->xjoin('store')
            ->join('mitrawork')
            ->where('id_progress', $id)
            ->where('store.jumlah_store', null)
            ->get();

        $this->store->table = 'progress';
        $data['progress'] = $this->store->where('id', $id)->first();

        echo show_my_modal('pages/store/modal_detail', 'modal-detail-store', $data, 'lg');
    }
}