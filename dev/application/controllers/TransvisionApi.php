<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransvisionApi extends CI_Controller {

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

    public function get_pemakaian_list() {
        $get = $this->input->get();
        $pemakaian = $this->Pemakaian_model->get_pemakaian_list(array('id_user' => $get['user_id'], 'is_finished' => '1'));

        if ($pemakaian != null) {
            $result = array('pemakaian' => $pemakaian);
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
            $result = array('pemakaian' => array($pemakaian_detail));
            echo json_encode($result);
        } else {
            $result = array('pemakaian' => array());
            echo json_encode($result);
        }
    }

    public function get_permohonan_list() {
        $get = $this->input->get();
        $permohonan = $this->Permohonan_model->get_permohonan(array('id_user' => $get['user_id']));

        if ($permohonan != null) {
            $result = array('permohonan' => $permohonan);
            echo json_encode($result);
        } else {
            $result = array('permohonan' => array());
            echo json_encode($result);
        }
    }

    public function get_accepted_permohonan() {
        $get = $this->input->get();
        $permohonan = $this->Permohonan_model->get_accepted_permohonan(array('id_user' => $get['user_id'], 'status_permohonan' => '1'));

        if ($permohonan != null) {
            $result = array('permohonan' => $permohonan);
            echo json_encode($result);
        } else {
            $result = array('permohonan' => array());
            echo json_encode($result);
        }
    }

    public function send_permohonan() {
        $post = $this->input->post();

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
            echo json_encode(array('response' => 'sent'));
        } else {
            echo json_encode(array('response' => 'failed'));
        }
    }

    public function verifikasi_kode_pemakaian() {
        $get = $this->input->get();
        $pemakaian_id = $get['pemakaian_id'];
        $kode_pemakaian = $get['kode_pemakaian'];

        $pemakaian = $this->Pemakaian_model->get($pemakaian_id);
        if ($pemakaian->kode_pemakaian == $kode_pemakaian) {
            echo json_encode(array('response' => 'verified'));
        } else {
            echo json_encode(array('response' => 'failed'));
        }
    }
}