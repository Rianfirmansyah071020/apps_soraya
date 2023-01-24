<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{

    public function index()
    {
        $sess_data = [
            'id', 'name', 'username', 'password', 'role', 'is_login'
        ];
        $this->session->unset_userdata($sess_data);
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
/* End of file Logout.php */
