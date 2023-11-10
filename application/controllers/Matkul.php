<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Matkul extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('kode_mk');
        if ($id == '') {
            $tbapi = $this->db->get('tbapi')->result();
        } else {
            $this->db->where('kode_mk', $id);
            $tbapi = $this->db->get('tbapi')->result();
        }
        $this->response($tbapi, 200);
    }


    public function index_post() {
        // Mendapatkan data yang akan disimpan dari request
        $data = array(
            'kode_mk' => $this->post('kode_mk'),
            'nama_mk' => $this->post('nama_mk'),
            'sks' => $this->post('sks'),

            // ... sesuaikan dengan struktur tabel tbapi
        );

        // Menyimpan data ke dalam tabel tbapi
        $this->db->insert('tbapi', $data);

        // Menanggapi dengan pesan berhasil atau gagal
        $this->response(array('status' => 'Data created successfully'), 201);
    }

    // Update operation
    public function index_put() {
        $id = $this->put('kode_mk');

        // Mendapatkan data yang akan diupdate dari request
        $data = array(
            'kode_mk' => $this->post('kode_mk'),
            'nama_mk' => $this->post('nama_mk'),
            'sks' => $this->post('sks'),
        );

        // Melakukan update data berdasarkan ID
        $this->db->where('kode_mk', $id);
        $this->db->update('tbapi', $data);

        // Menanggapi dengan pesan berhasil atau gagal
        $this->response(array('status' => 'Data updated successfully'), 200);
    }

    // Delete operation
    public function index_delete() {
        $id = $this->delete('kode_mk');

        // Menghapus data berdasarkan ID
        $this->db->where('kode_mk', $id);
        $this->db->delete('tbapi');

        // Menanggapi dengan pesan berhasil atau gagal
        $this->response(array('status' => 'Data deleted successfully'), 200);
    
    }
}
?>