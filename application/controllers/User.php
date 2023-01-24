<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');
        if ($role != 'admin') {
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $data['title'] = 'Admin User Management';
        $data['title_detail'] = 'User Management';
        $data['nav_title'] = 'user';
        $data['content'] = $this->user->get();
        $data['page'] = 'pages/user/index';

        $this->view($data);
    }

    public function add()
    {
        if (!$_POST) {
            $input = (object) $this->user->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
            $input->password = hashEncrypt($input->password);
        }

        if (!$this->user->validate()) {
            $data['title']          = 'Tambah Pengguna';
            $data['nav_title']      = 'user';
            $data['input']          = $input;
            $data['form_action']    = base_url('user/add');
            $data['page']           = 'pages/user/form';

            $image = $this->input->post('image', true);
            if ($image != '') {
                $this->user->deleteImage($data['input']->image);
            }

            $this->view($data);
            return;
        }

        if ($this->user->create($input)) {
            $this->session->set_flashdata('success', 'Data has been saved!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('user'));
    }

    public function edit($id)
    {
        $data['content'] = $this->user->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Sorry, data not found!');
            redirect(base_url('user'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
            if ($data['input']->password !== '') {
                $data['input']->password = hashEncrypt($data['input']->password);
            } else {
                $data['input']->password = $data['content']->password;
            }
        }

        if (!$this->user->validate()) {
            $data['title']          = 'Edit User';
            $data['sub_title']      = 'This is form update user to edit another user by admin.';
            $data['nav_title']      = 'user';
            $data['title_page']     = 'user';
            $data['form_action']    = base_url("user/edit/$id");
            $data['page']           = 'pages/user/form';

            $this->view($data);
            return;
        }

        if ($this->user->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data has been updated!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong!');
        }

        redirect(base_url('user'));
    }

    public function delete($id)
    {
        $user = $this->user->where('id', $id)->first();

        if (!$user) {
            $this->session->set_flashdata('warning', 'Sorry! Data not found');
            redirect(base_url('user'));
        }

        if ($this->user->where('id', $id)->delete()) {
            $this->user->deleteImage($user->image);
            $this->session->set_flashdata('success', 'Data Telah Berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan');
        }

        redirect(base_url('user'));
    }

    public function multipleDel()
    {
        $id = $_POST['id'];

        $user = $this->user->whereIn('id', $id)->get();
        
        if (isset($id)) {
            foreach ($user as $row) {
                if ($this->user->where('id', $row->id)->delete()) {
                    if ($row->image != '') {
                        $this->user->deleteImage($row->image);
                    }
                    $this->session->set_flashdata('success', 'Data Telah Berhasil dihapus');
                } else {
                    $this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan');
                }
            }
        } else {
            $this->session->set_flashdata('warning', 'Belum Memilih Data');
        }


        redirect(base_url('user'));
    }

    public function unique_username()
    {
        $username = $this->input->post('username');
        $id   = $this->input->post('id');
        $user = $this->user->where('username', $username)->first();

        if ($user) {
            if ($id == $user->id) {
                return true;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_message('unique_username', '%s has been used!');
            return false;
        }
        return true;
    }

    public function uploadImage()
    {
        if (!empty($_FILES) && $_FILES['file']['name'] != '') {

            $nama_admin = uniqid();
            $imageName = url_title($nama_admin, '-', true) . '-' . date('YmdHis');

            $upload    = $this->user->uploadImage('file', $imageName);
            if ($upload) {
                echo json_encode(array(
                    'statusCode' => 200,
                    'file_name'  => $upload['file_name']
                ));
            } else {
                echo 'gagal';
            }
        }
    }
}
