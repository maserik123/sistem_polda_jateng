<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_tb_ranmor_rekap extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('r.id, k.nama_kesatuan, r.hilang, r.temu, r.jumlah, r.create_date');
        $this->datatables->from('tb_ranmor_rekap r');
        $this->datatables->join('tb_kesatuan k', 'k.id = r.id_kesatuan', 'left');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_ranmor_rekap');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_ranmor_rekap', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_ranmor_rekap ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_ranmor_rekap');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_ranmor_rekap', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_ranmor_rekap');
    }
}

/* End of file Model_tb_ranmor_jml_roda.php */
