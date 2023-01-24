<?php

function show_my_modal($content = '', $id = '', $data = '', $size = 'md')
{
    $CI = &get_instance();

    if ($content != '') {
        $view_content = $CI->load->view($content, $data, TRUE);

        return '<div class="modal fade" id="' . $id . '" role="dialog">
                  <div class="modal-dialog modal-dialog-scrollable modal-' . $size . '" role="document">
                    <div class="modal-content">
                        ' . $view_content . '
                    </div>
                  </div>
                </div>';
    }
}



function getKodeMax()
{
    $CI     = &get_instance();
    $query = $CI->db->query("SELECT progress.id AS NoODMax FROM progress WHERE MONTH(progress.tanggal) = MONTH(CURRENT_DATE) AND YEAR(progress.tanggal) = YEAR(CURRENT_DATE) ORDER BY progress.tanggal DESC");
    $result = $query->row();
    return $result;
}

function checkRencana($id_progress)
{
    $CI     = &get_instance();
    $query = $CI->db->query("SELECT perencanaan.id FROM perencanaan WHERE id_progress = '$id_progress'");
    $result = $query->num_rows();
    return $result;
}



function checkRealisasi($id_progress)
{
    $CI       = &get_instance();
    $query    = $CI->db->query("SELECT realisasi.id FROM realisasi, perencanaan, progress WHERE realisasi.id_perencanaan = perencanaan.id AND progress.id = perencanaan.id_progress AND progress.id = '$id_progress'");
    $result   = $query->num_rows();

    if ($result != 0) {
        return $result;
    } else {
        return false;
    }
}

function checkDistribusi($id_progress)
{
    $CI     = &get_instance();
    $query = $CI->db->query("SELECT distribusi.id FROM distribusi WHERE id_progress = '$id_progress'");
    $result = $query->num_rows();
    return $result;
}

function checkStore($id_progress)
{
    $CI     = &get_instance();
    $query = $CI->db->query("SELECT store.id FROM store, distribusi WHERE distribusi.id = store.id_distribusi AND id_progress = '$id_progress'");
    $result = $query->num_rows();
    return $result;
}

function checkStatusSelesaiDistribusi($id_progress)
{
    $CI     = &get_instance();
    $query = $CI->db->query("SELECT * FROM distribusi WHERE id_progress = '$id_progress' AND status_pekerjaan = 'selesai'");
    $result = $query->num_rows();
    return $result;
}

function checkStatusDikerjakanDistribusi($id_progress)
{
    $CI     = &get_instance();
    $query = $CI->db->query("SELECT * FROM distribusi WHERE id_progress = '$id_progress' AND status_pekerjaan = 'dikerjakan'");
    $result = $query->num_rows();
    return $result;
}

function getDropdownList($table, $columns)
{
    $CI    = &get_instance();
    $query = $CI->db->select($columns)->from($table)->get();

    if ($query->num_rows() >= 1) {
        $option1 = ['' => '- Select -'];
        $option2 = array_column($query->result_array(), $columns[1], $columns[0]);
        $options = $option1 + $option2;

        return $options;
    }


    return $options = ['' => '- Select -'];
}

function getMitra()
{
    $CI    = &get_instance();
    $query = $CI->db->query("SELECT * FROM mitra");
    $hasil = $query->result();

    foreach ($hasil as $row) {
        $val = array(
            'nama' => $row->nama
        );
    }

    return json_encode($hasil);
    // $output = '';
    // foreach ($hasil as $row) {
    //   $output .= '<option value="'.$row->id.'">"'.$row->nama.'"</option>';

    // }

    // return $output;


}

function konversiBln($blnsekarang)
{
    switch ($blnsekarang) {
        case "Jan":
            $convBln = "Jan";
            break;
        case "Feb":
            $convBln = "Feb";
            break;
        case "Mar":
            $convBln = "Mar";
            break;
        case "Apr":
            $convBln = "Apr";
            break;
        case "May":
            $convBln = "Mei";
            break;
        case "Jun":
            $convBln = "Jun";
            break;
        case "Jul":
            $convBln = "Jul";
            break;
        case "Aug":
            $convBln = "Agu";
            break;
        case "Sep":
            $convBln = "Sep";
            break;
        case "Oct":
            $convBln = "Okt";
            break;
        case "Nov":
            $convBln = "Nov";
            break;
        case "Dec":
            $convBln = "Des";
            break;
    }

    return $convBln;
}

function hashEncrypt($input)
{
    $hash   = password_hash($input, PASSWORD_DEFAULT);
    return $hash;
}

function hashEncryptVerify($input, $hash)
{
    if (password_verify($input, $hash)) {
        return true;
    } else {
        return false;
    }
}

function getPersentase($proses, $target)
{
    $persentase = ($proses / $target) * 100;
    return $persentase;
}

function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Jan',
        2 => 'Feb',
        3 => 'Mar',
        4 => 'Apr',
        5 => 'Mei',
        6 => 'Jun',
        7 => 'Jul',
        8 => 'Agu',
        9 => 'Sep',
        10 => 'Okt',
        11 => 'Nov',
        12 => 'Des'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
