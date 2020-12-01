<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_tb_ranmor_modus_operandi extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('m.id, k.nama_kesatuan, m.gelap, m.kupal, m.rampas, m.tipu, m.curras, m.currat, m.lain_lain, m.jumlah,m.create_date');
        $this->datatables->from('tb_ranmor_modus_operandi m');
        $this->datatables->join('tb_kesatuan k', 'k.id = m.id_kesatuan', 'left');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_ranmor_modus_operandi');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_ranmor_modus_operandi', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_ranmor_modus_operandi ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_ranmor_modus_operandi');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_ranmor_modus_operandi', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_ranmor_modus_operandi');
    }
}

/* End of file Model_tb_ranmor_jml_roda.php */
