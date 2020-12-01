<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_tb_daftar_ranmor extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('
        d.id_laporan,
        k.nama_kesatuan,
        d.no_laporan,
        d.tgl_laporan,
        d.jenis_kejadian,
        d.lokasi,
        d.tgl_kejadian,
        d.modus,
        d.no_polisi,
        d.jenis_kendaraan,
        d.merk_type,
        d.tahun_pembuatan,
        d.warna,
        d.no_rangka,
        d.no_mesin,
        d.nama_pelapor,
        d.alamat_pelapor,
        d.nama_pemilik,
        d.alamat_pemilik,
        d.create_date,
        d.create_date
        ');
        $this->datatables->from('tb_daftar_ranmor d');
        $this->datatables->join('tb_kesatuan k', 'k.id=d.id_kesatuan', 'left');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_daftar_ranmor');
        $this->db->order_by('id_laporan', 'desc');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_daftar_ranmor', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_daftar_ranmor ap', array('ap.id_laporan' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_daftar_ranmor');
        $this->db->where('id_laporan', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id_laporan', $id);
        $this->db->update('tb_daftar_ranmor', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id_laporan', $id);
        $this->db->delete('tb_daftar_ranmor');
    }
}

/* End of file Model_tb_daftar_ranmor.php */
