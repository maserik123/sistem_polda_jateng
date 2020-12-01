<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_kesatuan extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('id, nama_kesatuan');
        $this->datatables->from('tb_kesatuan');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_kesatuan');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_kesatuan', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_kesatuan ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_kesatuan');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_kesatuan', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_kesatuan');
    }
}

/* End of file Model_kesatuan.php */
