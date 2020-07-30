<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kategori extends CI_Model
{
    public function get()
    {
        return $this->db->get('tb_kategori')->result();
    }

    public function get_where($id)
    {
        $this->db->from('tb_kategori');
        $this->db->where('id_kategori', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    public function add($data)
    {
        return $this->db->insert("tb_kategori", $data);
    }

    public function update($id, $data)
    {
        return $this->db->update('tb_kategori', $data, array('id_kategori' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete('tb_kategori', array('id_kategori' => $id));
    }
}
