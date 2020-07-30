<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_catatan extends CI_Model
{
    private $selectField = array(
        "k.nama_kategori",
        "c.tanggal",
        "c.nominal",
        "c.jenis"
    );

    public function getAll(){
        $this->db->select($this->selectField);
        $this->db->from('tb_kategori k');
        $this->db->join('tb_catatan c', 'k.id_kategori=c.id_kategori', 'inner');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getMasuk($id){
        $this->db->select($this->selectField);
        $this->db->from('tb_kategori k');
        $this->db->join('tb_catatan c', 'k.id_kategori=c.id_kategori', 'inner');
        $this->db->where('k.id_kategori', $id);
        $this->db->where('c.jenis', "masuk");
        $this->db->order_by('c.tanggal', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getKeluar($id){
        $this->db->select($this->selectField);
        $this->db->from('tb_kategori k');
        $this->db->join('tb_catatan c', 'k.id_kategori=c.id_kategori', 'inner');
        $this->db->where('k.id_kategori', $id);
        $this->db->where('c.jenis', "keluar");
        $this->db->order_by('c.tanggal', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get()
    {
        return $this->db->get('tb_catatan')->result();
    }

}
