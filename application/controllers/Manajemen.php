<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Model_tb_daftar_ranmor'));
    }

    public function index()
    {
        $view['title']    = 'Home';
        $view['pageName'] = 'home';

        $this->load->view('index', $view);
    }

    public function daftarRanmor($param = '', $id = '')
    {
        $view['title']    = 'Daftar Pencurian Kendaraan Motor';
        $view['pageName'] = 'daftarRanmor';

        if ($param == 'getAllData') {
            $dt    = $this->Model_tb_daftar_ranmor->getAllData();
            $start = $this->input->post('start');
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id   = $row->id_laporan;
                $th1  = '<div style="font-size:12px;">' . ++$start . '</div>';
                $th2  = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $th3  = '<div style="font-size:12px;">' . $row->kesatuan . '</div>';
                $th4  = '<div style="font-size:12px;">' . $row->no_laporan . '</div>';
                $th5  = '<div style="font-size:12px;">' . tgl_indo($row->tgl_laporan) . '</div>';
                $th6  = '<div style="font-size:12px;">' . $row->jenis_kejadian . '</div>';
                $th7  = '<div style="font-size:12px;">' . $row->lokasi . '</div>';
                $th8  = '<div style="font-size:12px;">' . tgl_indo($row->tgl_kejadian) . '</div>';
                $th9  = '<div style="font-size:12px;">' . $row->modus . '</div>';
                $th10 = '<div style="font-size:12px;">' . $row->no_polisi . '</div>';
                $th11 = '<div style="font-size:12px;">' . $row->jenis_kendaraan . '</div>';
                $th12 = '<div style="font-size:12px;">' . $row->merk_type . '</div>';
                $th13 = '<div style="font-size:12px;">' . $row->tahun_pembuatan . '</div>';
                $th14 = '<div style="font-size:12px;">' . $row->warna . '</div>';
                $th15 = '<div style="font-size:12px;">' . $row->no_rangka . '</div>';
                $th16 = '<div style="font-size:12px;">' . $row->no_mesin . '</div>';
                $th17 = '<div style="font-size:12px;">' . $row->nama_pelapor . '</div>';
                $th18 = '<div style="font-size:12px;">' . $row->alamat_pelapor . '</div>';
                $th19 = '<div style="font-size:12px;">' . $row->nama_pemilik . '</div>';
                $th20 = '<div style="font-size:12px;">' . $row->alamat_pemilik . '</div>';
                $th21 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                $data[]     = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12, $th13, $th14, $th15, $th16, $th17, $th18, $th19, $th20, $th21));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getById') {
            $data = $this->Model_tb_daftar_ranmor->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'addData') {
            $this->form_validation->set_rules("kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("no_laporan", "No Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tgl_laporan", "Tanggal Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jenis_kejadian", "Jenis Kejadian", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("lokasi", "Lokasi", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tgl_kejadian", "Tanggal Kejadian", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("modus", "Modus", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("no_polisi", "No Polisi", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jenis_kendaraan", "Jenis Kendaraan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("merk_type", "Merek/Type", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tahun_pembuatan", "Tahun Pembuatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("warna", "Warna", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("no_rangka", "No Rangka", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("no_mesin", "No Mesin", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("nama_pelapor", "Nama Pelapor", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("alamat_pelapor", "Alamat Pelapor", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("nama_pemilik", "Nama Pemilik", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("alamat_pemilik", "Alamat Pemilik", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['kesatuan']        = htmlspecialchars($this->input->post('kesatuan'));
                $data['no_laporan']      = htmlspecialchars($this->input->post('no_laporan'));
                $data['tgl_laporan']     = htmlspecialchars($this->input->post('tgl_laporan'));
                $data['jenis_kejadian']  = htmlspecialchars($this->input->post('jenis_kejadian'));
                $data['lokasi']          = htmlspecialchars($this->input->post('lokasi'));
                $data['tgl_kejadian']    = htmlspecialchars($this->input->post('tgl_kejadian'));
                $data['modus']           = htmlspecialchars($this->input->post('modus'));
                $data['no_polisi']       = htmlspecialchars($this->input->post('no_polisi'));
                $data['jenis_kendaraan'] = htmlspecialchars($this->input->post('jenis_kendaraan'));
                $data['merk_type']       = htmlspecialchars($this->input->post('merk_type'));
                $data['tahun_pembuatan'] = htmlspecialchars($this->input->post('tahun_pembuatan'));
                $data['warna']           = htmlspecialchars($this->input->post('warna'));
                $data['no_rangka']       = htmlspecialchars($this->input->post('no_rangka'));
                $data['no_mesin']        = htmlspecialchars($this->input->post('no_mesin'));
                $data['nama_pelapor']    = htmlspecialchars($this->input->post('nama_pelapor'));
                $data['alamat_pelapor']  = htmlspecialchars($this->input->post('alamat_pelapor'));
                $data['nama_pemilik']    = htmlspecialchars($this->input->post('nama_pemilik'));
                $data['alamat_pemilik']  = htmlspecialchars($this->input->post('alamat_pemilik'));
                $data['create_date']     = htmlspecialchars($this->input->post('create_date'));
                $result['messages']        = '';
                $result            = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                $this->Model_tb_daftar_ranmor->addData($data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("no_laporan", "No Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tgl_laporan", "Tanggal Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jenis_kejadian", "Jenis Kejadian", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("lokasi", "Lokasi", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tgl_kejadian", "Tanggal Kejadian", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("modus", "Modus", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("no_polisi", "No Polisi", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jenis_kendaraan", "Jenis Kendaraan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("merk_type", "Merek/Type", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tahun_pembuatan", "Tahun Pembuatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("warna", "Warna", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("no_rangka", "No Rangka", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("no_mesin", "No Mesin", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("nama_pelapor", "Nama Pelapor", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("alamat_pelapor", "Alamat Pelapor", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("nama_pemilik", "Nama Pemilik", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("alamat_pemilik", "Alamat Pemilik", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['id_laporan']                 = htmlspecialchars($this->input->post('id_laporan'));
                $data['kesatuan']        = htmlspecialchars($this->input->post('kesatuan'));
                $data['no_laporan']      = htmlspecialchars($this->input->post('no_laporan'));
                $data['tgl_laporan']     = htmlspecialchars($this->input->post('tgl_laporan'));
                $data['jenis_kejadian']  = htmlspecialchars($this->input->post('jenis_kejadian'));
                $data['lokasi']          = htmlspecialchars($this->input->post('lokasi'));
                $data['tgl_kejadian']    = htmlspecialchars($this->input->post('tgl_kejadian'));
                $data['modus']           = htmlspecialchars($this->input->post('modus'));
                $data['no_polisi']       = htmlspecialchars($this->input->post('no_polisi'));
                $data['jenis_kendaraan'] = htmlspecialchars($this->input->post('jenis_kendaraan'));
                $data['merk_type']       = htmlspecialchars($this->input->post('merk_type'));
                $data['tahun_pembuatan'] = htmlspecialchars($this->input->post('tahun_pembuatan'));
                $data['warna']           = htmlspecialchars($this->input->post('warna'));
                $data['no_rangka']       = htmlspecialchars($this->input->post('no_rangka'));
                $data['no_mesin']        = htmlspecialchars($this->input->post('no_mesin'));
                $data['nama_pelapor']    = htmlspecialchars($this->input->post('nama_pelapor'));
                $data['alamat_pelapor']  = htmlspecialchars($this->input->post('alamat_pelapor'));
                $data['nama_pemilik']    = htmlspecialchars($this->input->post('nama_pemilik'));
                $data['alamat_pemilik']  = htmlspecialchars($this->input->post('alamat_pemilik'));
                $data['create_date']     = htmlspecialchars($this->input->post('create_date'));
                $result['messages']           = '';
                $result               = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Model_tb_daftar_ranmor->update($data['id_laporan'], $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Model_tb_daftar_ranmor->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }

        $this->load->view('index', $view);
    }
}

/* End of file Manajemen.php */
