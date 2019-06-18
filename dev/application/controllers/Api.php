<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Content-Type:application/json');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Permohonan_model', 'Pemakaian_model', 'Mobil_model', 'User_model'));
    }

    public function login() {
        $get = $this->input->get();
        $user = $this->User_model->get_by(array('email' => @$get['email'], 'group' => 'user'), 1, null, true);

        if (@$user->password == crypt(@$get['password'], @$user->password)) {
            $data = array('last_login' => date("Y-m-d H:i:s"));
            $this->User_model->update($data, array('user_id' => $user->user_id));
            $result = array('users' => array($user));
            echo json_encode($result);
        } else {
            $result = array('users' => array());
            echo json_encode($result);
        }
    }

    public function get_permohonan_list() {
        $get = $this->input->get();
        $permohonan_list = $this->Permohonan_model->get_by(array('id_user' => $get['user_id']));

        if ($permohonan_list != null) {
            $result = array('permohonan' => $permohonan_list);
            echo json_encode($result);
        } else {
            $result = array('permohonan' => array());
            echo json_encode($result);
        }
    }

    public function get_permohonan_detail() {
        $get = $this->input->get();
        $permohonan_id = $get['permohonan_id'];
        $permohonan_detail = $this->Permohonan_model->get($permohonan_id);

        if ($permohonan_detail != null) {
            $result = array('respons' => 'sukses', 'permohonan_detail' => $permohonan_detail);
            echo json_encode($result);
        } else {
            $result = array('respons' => 'gagal');
            echo json_encode($result);
        }
    }

    public function add_permohonan() {
        $post = $this->input->post(null, true);

        $data = array(
            'id_user' => $post['user_id'],
            'tujuan' => $post['tujuan'],
            'keperluan' => $post['keperluan'],
            'jum_penumpang' => $post['jum_penumpang'],
            'tgl_pemakaian' => $post['tgl_pemakaian'],
            'lama_pemakaian' => $post['lama_pemakaian'],
            'dasar_pemakaian' => $post['dasar_pemakaian'],
            'created_on' => date("Y-m-d H:i:s")
        );

        /* insert data ke tabel permohonan */
        if ($this->Permohonan_model->insert($data)) {
            echo json_encode(array('respons' => 'sukses'));
        } else {
            echo json_encode(array('respons' => 'gagal'));
        }
    }

    public function get_pemakaian_sekarang() {
        $get = $this->input->get();
        $pemakaian_sekarang = $this->Pemakaian_model->get_pemakaian_sekarang(array('id_user' => $get['user_id'], 'status_pemakaian' => 0));

        if ($pemakaian_sekarang != null) {
            $result = array('pemakaian' => $pemakaian_sekarang);
            echo json_encode($result);
        } else {
            $result = array('pemakaian' => array());
            echo json_encode($result);
        }
    }

    public function get_pemakaian_list() {
        $get = $this->input->get();
        $pemakaian_list = $this->Pemakaian_model->get_pemakaian_list(array('id_user' => $get['user_id'], 'status_pemakaian' => 1));
        if ($pemakaian_list != null) {
            $result = array('pemakaian' => $pemakaian_list);
            echo json_encode($result);
        } else {
            $result = array('pemakaian' => array());
            echo json_encode($result);
        }
    }

    public function get_pemakaian_detail() {
        $get = $this->input->get();
        $pemakaian_id = $get['pemakaian_id'];
        $pemakaian_detail = $this->Pemakaian_model->get_pemakaian_detail($pemakaian_id);

        if ($pemakaian_detail != null) {
            $result = array('respons' => 'sukses', 'pemakaian_detail' => $pemakaian_detail);
            echo json_encode($result);
        } else {
            $result = array('respons' => 'gagal');
            echo json_encode($result);
        }
    }

    public function verifikasi_kode_pemakaian() {
        $get = $this->input->get();
        $pemakaian_id = $get['pemakaian_id'];
        $kode_pemakaian = $get['kode_pemakaian'];

        $pemakaian = $this->Pemakaian_model->get($pemakaian_id);
        if ($pemakaian->kode_pemakaian == $kode_pemakaian) {
            $result = array('respons' => 'sukses');
            echo json_encode($result);
        } else {
            $result = array('respons' => 'gagal');
            echo json_encode($result);
        }
    }

    public function is_already_upload_km_awal() {
        $get = $this->input->get();
        $pemakaian_id = $get['pemakaian_id'];

        $pemakaian = $this->Pemakaian_model->get($pemakaian_id);
        if ($pemakaian->km_awal != null) {
            $result = array('respons' => 'true');
            echo json_encode($result);
        } else {
            $result = array('respons' => 'false');
            echo json_encode($result);
        }
    }

    public function upload_km_awal() {
        global $SConfig;

        $post = $this->input->post();
        $pemakaian_id = $post['pemakaian_id'];
        $image = $post["image"];
        $km_awal = (int) $post["km_awal"];

        if ($image) {
            $target_dir = "uploads";

            if (!file_exists($target_dir)) {
                mkdir($target_dir);
            }

            $target_dir = $target_dir."/".rand()."_".time().".jpeg";
            $image_path = $SConfig->_site_url."/$target_dir";

            $data = array(
                'foto_km_awal' => $image_path, 
                'km_awal' => $km_awal,
                'berangkat' => date("H:i:s")
            );

            if (file_put_contents($target_dir, base64_decode($image))) {
                $this->Pemakaian_model->update($data, array('pemakaian_id' => $pemakaian_id));
                echo json_encode(array('respons' => 'sukses'));
            } else {
                echo json_encode(array('respons' => 'gagal'));
            }
        } else {
            echo json_encode(array('respons' => 'gagal'));
        }
    }

    public function upload_km_akhir() {
        global $SConfig;

        $post = $this->input->post();
        $pemakaian_id = $post['pemakaian_id'];
        $image = $post["image"];
        $km_akhir = (int) $post["km_akhir"];
        $catatan = $post['catatan'];

        if ($image) {
            $target_dir = "uploads";

            if (!file_exists($target_dir)) {
                mkdir($target_dir);
            }

            $target_dir = $target_dir."/".rand()."_".time().".jpeg";
            $image_path = $SConfig->_site_url."/$target_dir";

            $data = array(
                'foto_km_akhir' => $image_path, 
                'km_akhir' => $km_akhir,
                'kembali' => date("H:i:s"),
                'catatan' => $catatan,
                'status_pemakaian' => 1
            );

            if (file_put_contents($target_dir, base64_decode($image))) {
                $this->Pemakaian_model->update($data, array('pemakaian_id' => $pemakaian_id));
                echo json_encode(array('respons' => 'sukses'));
            } else {
                echo json_encode(array('respons' => 'gagal'));
            }
        } else {
            echo json_encode(array('respons' => 'gagal'));
        }
    }
    
    public function set_coordinate() {
        $post = $this->input->post();
        $pemakaian_id = $post['pemakaian_id'];

        $data = array(
            'lat' => $post['lat'],
            'lng' => $post['lng']
        );

        $where = array('pemakaian_id' => $pemakaian_id);
        $this->Pemakaian_model->update($data, $where);

        $result = array('respons' => 'sukses');
        echo json_encode($result);
    }
}