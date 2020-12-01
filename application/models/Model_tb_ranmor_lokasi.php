<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_tb_ranmor_lokasi extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('l.id, k.nama_kesatuan, l.jalan, l.rumah, l.tempat_parkir, l.tempat_ibadah, l.halaman_kantor, l.lain_lain, l.jumlah, l.create_date');
        $this->datatables->from('tb_ranmor_lokasi l');
        $this->datatables->join('tb_kesatuan k', 'k.id = l.id_kesatuan', 'left');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_ranmor_lokasi');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_ranmor_lokasi', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_ranmor_lokasi ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_ranmor_lokasi');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_ranmor_lokasi', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_ranmor_lokasi');
    }
}

/* End of file Model_tb_ranmor_jml_roda.php */
