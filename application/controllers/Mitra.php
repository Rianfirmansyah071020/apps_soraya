<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mitra extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');
        $this->load->library('mypdf');
        if ($role == 'admin' || $role == 'admin_finance') {
            return;
        } else {
            $this->session->set_flashdata('warning', 'Tidak Mempunyai Akses ke Menu Tersebut');
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $data['content'] = $this->mitra->select([
            'id', 'nama', 'tgl_lahir', 'tgl_mulai_kerja', 'nohp',
            'alamat', 'jenis_kelamin', 'tempat', 'status_nikah', 'image'
        ])->where('is_active', true)->get();
        $data['page'] = 'pages/mitra/index';
        $data['title'] = 'Daftar Mitra';
        $data['nav_title'] = 'mitra';
        $data['title_detail'] = 'Daftar Mitra Soraya Bedsheet';

        $this->view($data);
    }

    public function tes()
    {
        $data['content'] = $this->mitra->select([
            'nama', 'tgl_lahir', 'tgl_mulai_kerja', 'nohp',
            'alamat', 'jenis_kelamin', 'tempat', 'status_nikah', 'image'
        ])->where('is_active', true)->get();

        print_r($data['content']);
    }

    public function out()
    {
        $this->mitra->table = 'mitra';
        $query = "SELECT * FROM `mitra`
                  JOIN `mitra_out` ON `mitra`.`id` = `mitra_out`.`id`
                  WHERE `mitra`.`is_active` = 0";


        $data['content'] = $this->db->query($query)->result();
        // var_dump($data['content']);die;

        $data['page']    = 'pages/mitra/out';
        $data['title']   = 'Daftar Mitra Out';
        $data['nav_title'] = 'mitra_out';
        $data['title_detail'] = 'Daftar Mitra Out Soraya Bedsheet';

        $this->view($data);
    }

    public function add()
    {
        if (!$_POST) {
            $input = (object) $this->mitra->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if ($this->mitra->validate() == false) {
            $data['title']          = 'Tambah Mitra';

            $data['nav_title']      = 'mitra';
            $data['input']          = $input;
            $data['form_action']    = base_url('mitra/add');
            $data['page']           = 'pages/mitra/form';
            $this->view($data);

            if ($input->nama != '' && $input->nohp != '' && $input->tgl_lahir != '' && $input->tgl_mulai_kerja != '' && $input->alamat != '' && $input->jenis_kelamin != '' && $input->tempat != '' && $input->status_nikah != '') {
                if ($this->mitra->add($input) == true) {
                    $this->session->set_flashdata('success', 'Data has been saved!');
                } else {
                    $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                }

                redirect(base_url('mitra'));
            }
            return;
        }
    }


    public function edit($id)
    {
        $data['content'] = $this->mitra->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data Tidak ditemukan!');
        }

        if (!$_POST) {
            $data['input']  = $data['content'];
        } else {
            $data['input']  = (object) $this->input->post(null, true);
        }

        if (!$this->mitra->validate()) {
            if ($data['input']->nama == $data['content']->nama && $data['input']->nohp == $data['content']->nohp && $data['input']->tgl_lahir == $data['content']->tgl_lahir && $data['input']->tgl_mulai_kerja == $data['content']->tgl_mulai_kerja && $data['input']->alamat == $data['content']->alamat && $data['input']->jenis_kelamin == $data['content']->jenis_kelamin && $data['input']->tempat == $data['content']->tempat && $data['input']->status_nikah == $data['content']->status_nikah) {
                $data['title']          = 'Edit Mitra';
                $data['sub_title']      = 'This is form add mitra to fill another mitra by admin.';
                $data['nav_title']      = 'mitra';

                $data['form_action']    = base_url("mitra/edit/$id");
                $data['page']           = 'pages/mitra/form';

                $this->view($data);
            } else {
                if ($this->mitra->where('id', $id)->update($data['input'])) {
                    $this->session->set_flashdata('success', 'Data has been updated!');
                } else {
                    $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                }

                redirect(base_url("mitra"));
            }

            return;
        }
    }

    public function delete($id)
    {
        $mitra = $this->db->get_where('mitra', ['id' => $id])->row();
        $this->db->update('mitra', ['is_active' => false], ['id' => $id]);
        $data = [
            'id' => $id,
            'tgl_mitra_out' => date('Y-m-d'),
            'status' => 'Dihapus',
            'keterangan' => 'Mitra dihapus oleh admin'
        ];

        $result = $this->db->insert('mitra_out', $data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data has been deleted!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url("mitra"));
    }

    public function showModalToMitraOut($id_mitra)
    {
        $data['mitra'] = $this->mitra->where('id', $id_mitra)->first();
        $data['id_mitra'] = $id_mitra;

        echo show_my_modal('pages/mitra/modal_to_mitra_out', 'modal-to-mitra-out', $data, 'lg');
    }

    public function moveToMitraOut($id_mitra)
    {

        $this->db->get_where('mitra_out', ['id' => $id_mitra])->row();
        // var_dump($id_mitra);
        // die;

        $mitra = $this->db->update('mitra', ['is_active' => false], ['id' => $id_mitra]);

        $data = [
            'id' => $id_mitra,
            'tgl_mitra_out' => date('Y-m-d'),
            'status' => $this->input->post('status_out'),
            'keterangan' => $this->input->post('keterangan')
        ];

        $query = $this->db->insert('mitra_out', $data);

        $result = $query && $mitra;
        if ($result) {
            $this->session->set_flashdata('success', 'Mitra telah dikeluarkan!');
            redirect(base_url("mitra"));
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
            redirect(base_url("mitra"));
        }
    }

    public function moveToMitra($id_mitra)
    {
        $this->mitra->table = 'mitra_out';
        $mitra              = $this->mitra->where('id', $id_mitra)->get();

        // ubah is_active menjadi true
        $query1 = $this->db->update('mitra', ['is_active' => true], ['id' => $id_mitra]);
        $query2 = $this->mitra->where('id', $id_mitra)->delete();

        $result = $query1 && $query2;

        if ($result) {
            $this->session->set_flashdata('success', 'Mitra telah dimasukkan kembali!');
            redirect(base_url("mitra"));
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
            redirect(base_url("mitra"));
        }
    }

    public function exportToExcel($jenis_mitra)
    {
        if ($jenis_mitra == "mitra") {
            $mitra = $this->mitra->where('is_active', true)->get();
        } else {
            // $this->mitra->table = "mitra_out";
            // $mitra = $this->mitra->get();
            $query = "SELECT * FROM `mitra`
                  JOIN `mitra_out` ON `mitra`.`id` = `mitra_out`.`id`
                  WHERE `mitra`.`is_active` = 0";


        $mitra = $this->db->query($query)->result();
            // var_dump($mitra);die;
        }

        if ($mitra) {
            include_once APPPATH . '/third_party/xlsxwriter.class.php';
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
            error_reporting(E_ALL & ~E_NOTICE);

            if ($jenis_mitra == "mitra") {
                $filename = "data-mitra-" . date('d-m-Y-His') . ".xlsx";
            } else {
                $filename = "data-mitra-out-" . date('d-m-Y-His') . ".xlsx";
            }
            header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');

            $styles = array(
                'widths' => [7, 30, 25, 12, 14, 17, 25, 19, 135, 17, 14, 17],
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

            $header = array(
                'No'                => 'integer',
                'No Mitra'          => 'string',
                'Nama'              => 'string',
                'Tgl Lahir'         => 'dd/mm/yyyy',
                'Umur'              => 'string',
                'Tgl Mulai Kerja'   => 'dd/mm/yyyy',
                'Durasi Kerja'      => 'string',
                'No HP'             => 'string',
                'Alamat'            => 'string',
                'Jenis Kelamin'     => 'string',
                'Tempat'            => 'string',
                'Status'            => 'string',

            );

            $writer = new XLSXWriter();
            $writer->setAuthor('admin');

            $writer->writeSheetHeader('Mitra', $header, $styles);

            $no = 1;

            foreach ($mitra as $row) {
                $waktuAwal = new DateTime($row->tgl_mulai_kerja . " 00:00:00");
                $waktuSekarang = new DateTime();
                $diff = date_diff($waktuAwal, $waktuSekarang);

                if ($diff->m == 0 && $diff->y == 0) {
                    $durasi = 'Kurang dari sebulan';
                } else if ($diff->y > 0) {
                    $durasi = $diff->y . ' tahun ' . $diff->m . ' bulan';
                } else {
                    $durasi = $diff->m . ' bulan';
                }

                $umur_mitra = date_diff(new DateTime(date("Y-m-d")), new DateTime($row->tgl_lahir));

                $writer->writeSheetRow(

                    'Mitra',
                    [
                        $no,
                        $row->id,
                        $row->nama,
                        $row->tgl_lahir,
                        $umur_mitra->y . ' tahun',
                        $row->tgl_mulai_kerja,
                        $durasi,
                        $row->nohp,
                        $row->alamat,
                        ucwords($row->jenis_kelamin),
                        ucwords($row->tempat),
                        $row->status_nikah == "belum_nikah" ? "Belum Nikah" : ucwords($row->status_nikah)
                    ],
                    $styles2
                );

                $no++;
            }
            $writer->writeToStdOut();
        } else {
            $this->session->set_flashdata('warning', 'Tidak Ada Data!');
            if ($jenis_mitra == "mitra_out") {
                redirect(base_url("mitra/out"));
            } else {
                redirect(base_url("mitra"));
            }
        }
    }

    public function uploadMitraImage($title)
    {
        if (isset($_POST['image'])) {
            $data       = $_POST['image'];

            $image_array_1 = explode(";", $data);

            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);
            $imageName = url_title($title, '-', true) . '-' . date('YmdHis') . '.png';

            file_put_contents('./images/mitra/' . $imageName, $data);

            echo json_encode(array(
                'image_name'  => $imageName,
                'show_image'  => '<img src="' . base_url("images/mitra/$imageName") . '" id="imgMitra" class="img-fluid" style="width: 200px; border-radius: 50%;">'
            ));
        }
    }

    public function updateMitraImage()
    {
        $image_mitra = $this->input->post('image_mitra', true);
        $id_mitra_img    = $this->input->post('id_mitra_img', true);

        $image_mitra_temp = $this->input->post('image_mitra_temp', true);
        $this->mitra->table = 'mitra';
        if ($image_mitra) {
            if ($this->mitra->where('id', $id_mitra_img)->update(['image' => $image_mitra])) {
                if ($image_mitra_temp != $image_mitra && $image_mitra_temp != "") {
                    $this->mitra->deleteImage($image_mitra_temp);
                }

                echo json_encode([
                    'statusCode'    => 200,
                    'message'       => 'berhasil',
                    'fileName'      => $image_mitra
                ]);
            } else {
                echo json_encode([
                    'statusCode'    => 201,
                    'message'       => 'tidak berhasil'
                ]);
            }
        }
    }

    public function show_modal_generate_card()
    {
        $data['mitra']           = $this->mitra
            ->where('mitra.image !=', null)
            ->orderBy('created_at', 'DESC')->get();
        $this->output->set_output(show_my_modal('pages/mitra/id_card/modal_generate_id_card', 'modal-generate-id-card', $data, 'lg'));
    }

    public function load_selected_mitra()
    {
        $id_mitra = $this->input->get('id_mitra', true);
        $data['mitra']       = $this->mitra->where('id', $id_mitra)->first();

        $this->output->set_output($this->load->view('pages/mitra/id_card/mitra_terpilih', $data, true));
    }

    public function generateIdCardSelected()
    {
        $id_mitra           = $this->input->post('id_mitra', true);
        $data_mitra         = [];

        foreach ($id_mitra as $row) {
            $getMitra = $this->mitra->select([
                'mitra.nama', 'mitra.id', 'mitra.image'
            ])
                ->where('mitra.id', $row)
                ->where('mitra.image !=', null)->first();

            array_push($data_mitra, [
                'id'            => $getMitra->id,
                'nama'          => $getMitra->nama,
                'image'         => $getMitra->image,
            ]);
        }

        $data['mitra']      =  $data_mitra;
        $this->load->view('pages/mitra/id_card/index2', $data);
    }

    public function generateIdCard()
    {
        $index = $this->input->get('index');
        $this->mitra->table = 'mitra';

        if (!isset($index)) {
            $data['mitra']      = $this->mitra->select([
                'mitra.nama', 'mitra.id', 'mitra.image'
            ])
                ->where('mitra.image !=', null)
                ->limit_data(0, $this->mitra->perPage)->get();
            $data['index']      = 0;
        } else {
            $data['mitra']      = $this->mitra->select([
                'mitra.nama', 'mitra.id', 'mitra.image'
            ])
                ->where('mitra.image !=', null)
                ->limit_data($index, $this->mitra->perPage)->get();

            $data['index']      = $index;
        }

        $data['button_next'] = true;

        $this->load->view('pages/mitra/id_card/index', $data);
    }

    public function generateIdCardDetail($id_mitra)
    {
        $this->mitra->table = 'mitra';
        $data['mitra']      = $this->mitra->select([
            'mitra.nama', 'mitra.id', 'mitra.image'
        ])->where('mitra.id', $id_mitra)->get();

        $this->load->view('pages/mitra/id_card/index', $data);
    }

    public function generateIdCardHorizontal()
    {
        $index = $this->input->get('index');
        $this->mitra->table = 'mitra';

        if (!isset($index)) {
            $data['mitra']      = $this->mitra->select([
                'mitra.nama', 'mitra.id', 'mitra.image'
            ])
                ->where('mitra.image !=', null)
                ->limit_data(0, $this->mitra->perPage)->get();
            $data['index']      = 0;
        } else {
            $data['mitra']      = $this->mitra->select([
                'mitra.nama', 'mitra.id', 'mitra.image'
            ])
                ->where('mitra.image !=', null)
                ->limit_data($index, $this->mitra->perPage)->get();

            $data['index']      = $index;
        }

        $this->load->view('pages/mitra/id_card/index-horizontal', $data);
    }

    public function generateIdCardHorizontalDetail($id_mitra)
    {
        $this->mitra->table = 'mitra';
        $data['getMitra']      = $this->mitra->select([
            'mitra.nama', 'mitra.id', 'mitra.image'
        ])->where('mitra.id', $id_mitra)->first();

        $this->load->view('pages/mitra/id_card/index-horizontal', $data);
    }
}

/* End of file Mitra.php */
