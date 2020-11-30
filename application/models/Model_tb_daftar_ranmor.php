<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_tb_daftar_ranmor extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('
        id_laporan,
        kesatuan,
        no_laporan,
        tgl_laporan,
        jenis_kejadian,
        lokasi,
        tgl_kejadian,
        modus,
        no_polisi,
        jenis_kendaraan,
        merk_type,
        tahun_pembuatan,
        warna,
        no_rangka,
        no_mesin,
        nama_pelapor,
        alamat_pelapor,
        nama_pemilik,
        alamat_pemilik,
        create_date,
        create_date
        ');
        $this->datatables->from('tb_daftar_ranmor');
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
