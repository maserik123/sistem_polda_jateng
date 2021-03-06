<?php
/* 
Developed by Fitra Arrafiq
email us : Fitra Official (fitraarrafiq@gmail.com)
*/
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('User', 'Model_tb_daftar_ranmor', 'Model_tb_ranmor_jml_roda', 'Model_tb_ranmor_lokasi', 'Model_tb_ranmor_modus_operandi', 'Model_tb_ranmor_rekap', 'Model_tb_ranmor_waktu', 'Model_kesatuan'));
    }

    public function index()
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']    = 'Home';
            $view['pageName'] = 'home';
            $view['visualize'] = $this->Model_tb_ranmor_rekap->visualizeHilang();
            $this->load->view('index', $view);
        }
    }

    public function daftarRanmor($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']       = 'Daftar Pencurian Kendaraan Motor';
            $view['pageName']    = 'daftarRanmor';
            $view['getKesatuan'] = $this->Model_kesatuan->getData();
            if ($param == 'getAllData') {
                $dt    = $this->Model_tb_daftar_ranmor->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id   = $row->id_laporan;
                    $th1  = '<div style="font-size:12px;">' . ++$start . '</div>';
                    $th2  = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $th3  = '<div style="font-size:12px;">' . $row->nama_kesatuan . '</div>';
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
                    $data['id_kesatuan']     = htmlspecialchars($this->input->post('kesatuan'));
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
                    $data['id_laporan']      = htmlspecialchars($this->input->post('id_laporan'));
                    $data['id_kesatuan']     = htmlspecialchars($this->input->post('kesatuan'));
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
                    $result            = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
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

    public function ranmorJmlRoda($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']       = 'Pencurian Kendaraan Berdasarkan Jumlah Roda';
            $view['pageName']    = 'ranmorJmlRoda';
            $view['getKesatuan'] = $this->Model_kesatuan->getData();

            if ($param == 'getAllData') {
                $dt    = $this->Model_tb_ranmor_jml_roda->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<div style="font-size:12px;">' . ++$start . '</div>';
                    $th2 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $th3 = '<div style="font-size:12px;">' . $row->nama_kesatuan . '</div>';
                    $th4 = '<div style="font-size:12px;">' . $row->roda_4 . '</div>';
                    $th5 = '<div style="font-size:12px;">' . $row->roda_2 . '</div>';
                    $th6 = '<div style="font-size:12px;">' . $row->jumlah . '</div>';
                    $th7 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $data = $this->Model_tb_ranmor_jml_roda->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("id_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("roda_4", "Roda 4", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("roda_2", "Roda 2", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_kesatuan'] = htmlspecialchars($this->input->post('id_kesatuan'));
                    $data['roda_4']      = htmlspecialchars($this->input->post('roda_4'));
                    $data['roda_2']      = htmlspecialchars($this->input->post('roda_2'));
                    $data['jumlah']      = ($data['roda_4'] + $data['roda_2']);
                    $data['create_date'] = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                    $this->Model_tb_ranmor_jml_roda->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("id_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("roda_4", "Roda 4", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("roda_2", "Roda 2", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']          = htmlspecialchars($this->input->post('id'));
                    $data['id_kesatuan'] = htmlspecialchars($this->input->post('id_kesatuan'));
                    $data['roda_4']      = htmlspecialchars($this->input->post('roda_4'));
                    $data['roda_2']      = htmlspecialchars($this->input->post('roda_2'));
                    $data['jumlah']      = ($data['roda_4'] + $data['roda_2']);

                    $data['create_date'] = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Model_tb_ranmor_jml_roda->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->Model_tb_ranmor_jml_roda->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }

            $this->load->view('index', $view);
        }
    }

    public function ranmorModusOperandi($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']       = 'Daftar Pencurian Kendaraan Motor';
            $view['pageName']    = 'ranmorModusOperandi';
            $view['getKesatuan'] = $this->Model_kesatuan->getData();

            if ($param == 'getAllData') {
                $dt    = $this->Model_tb_ranmor_modus_operandi->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id   = $row->id;
                    $th1  = '<div style="font-size:12px;">' . ++$start . '</div>';
                    $th2  = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $th3  = '<div style="font-size:12px;">' . $row->nama_kesatuan . '</div>';
                    $th4  = '<div style="font-size:12px;">' . $row->gelap . '</div>';
                    $th5  = '<div style="font-size:12px;">' . $row->kupal . '</div>';
                    $th6  = '<div style="font-size:12px;">' . $row->rampas . '</div>';
                    $th7  = '<div style="font-size:12px;">' . $row->tipu . '</div>';
                    $th8  = '<div style="font-size:12px;">' . $row->curras . '</div>';
                    $th9  = '<div style="font-size:12px;">' . $row->currat . '</div>';
                    $th10 = '<div style="font-size:12px;">' . $row->lain_lain . '</div>';
                    $th11 = '<div style="font-size:12px;">' . $row->jumlah . '</div>';
                    $th12 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                    $data[]     = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $data = $this->Model_tb_ranmor_modus_operandi->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("id_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("gelap", "Gelap", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("kupal", "Kupal", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("rampas", "Rampas", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("tipu", "Tipu", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("curras", "Curras", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("currat", "Currat", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("lain_lain", "Lain-lain", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_kesatuan'] = htmlspecialchars($this->input->post('id_kesatuan'));
                    $data['gelap']       = htmlspecialchars($this->input->post('gelap'));
                    $data['kupal']       = htmlspecialchars($this->input->post('kupal'));
                    $data['rampas']      = htmlspecialchars($this->input->post('rampas'));
                    $data['tipu']        = htmlspecialchars($this->input->post('tipu'));
                    $data['curras']      = htmlspecialchars($this->input->post('curras'));
                    $data['currat']      = htmlspecialchars($this->input->post('currat'));
                    $data['lain_lain']   = htmlspecialchars($this->input->post('lain_lain'));
                    $data['jumlah']      = ($data['gelap'] + $data['kupal'] + $data['rampas'] + $data['tipu'] + $data['curras'] + $data['currat'] + $data['lain_lain']);
                    $data['create_date'] = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                    $this->Model_tb_ranmor_modus_operandi->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("id_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("gelap", "Gelap", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("kupal", "Kupal", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("rampas", "Rampas", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("tipu", "Tipu", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("curras", "Curras", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("currat", "Currat", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("lain_lain", "Lain-lain", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']          = htmlspecialchars($this->input->post('id'));
                    $data['id_kesatuan'] = htmlspecialchars($this->input->post('id_kesatuan'));
                    $data['gelap']       = htmlspecialchars($this->input->post('gelap'));
                    $data['kupal']       = htmlspecialchars($this->input->post('kupal'));
                    $data['rampas']      = htmlspecialchars($this->input->post('rampas'));
                    $data['tipu']        = htmlspecialchars($this->input->post('tipu'));
                    $data['curras']      = htmlspecialchars($this->input->post('curras'));
                    $data['currat']      = htmlspecialchars($this->input->post('currat'));
                    $data['lain_lain']   = htmlspecialchars($this->input->post('lain_lain'));
                    $data['jumlah']      = ($data['gelap'] + $data['kupal'] + $data['rampas'] + $data['tipu'] + $data['curras'] + $data['currat'] + $data['lain_lain']);
                    $data['create_date'] = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Model_tb_ranmor_modus_operandi->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->Model_tb_ranmor_modus_operandi->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }

            $this->load->view('index', $view);
        }
    }

    public function ranmorLokasi($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']       = 'Daftar Pencurian Kendaraan Motor';
            $view['pageName']    = 'ranmorLokasi';
            $view['getKesatuan'] = $this->Model_kesatuan->getData();

            if ($param == 'getAllData') {
                $dt    = $this->Model_tb_ranmor_lokasi->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id   = $row->id;
                    $th1  = '<div style="font-size:12px;">' . ++$start . '</div>';
                    $th2  = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $th3  = '<div style="font-size:12px;">' . $row->nama_kesatuan . '</div>';
                    $th4  = '<div style="font-size:12px;">' . $row->jalan . '</div>';
                    $th5  = '<div style="font-size:12px;">' . $row->rumah . '</div>';
                    $th6  = '<div style="font-size:12px;">' . $row->tempat_parkir . '</div>';
                    $th7  = '<div style="font-size:12px;">' . $row->tempat_ibadah . '</div>';
                    $th8  = '<div style="font-size:12px;">' . $row->halaman_kantor . '</div>';
                    $th9  = '<div style="font-size:12px;">' . $row->lain_lain . '</div>';
                    $th10 = '<div style="font-size:12px;">' . $row->jumlah . '</div>';
                    $th11 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                    $data[]     = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $data = $this->Model_tb_ranmor_lokasi->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("id_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("jalan", "Jalan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("rumah", "Rumah", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("tempat_parkir", "Tempat Parkir", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("tempat_ibadah", "Tempat Ibadah", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("halaman_kantor", "Halaman Kantor", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("lain_lain", "Lain-lain", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_kesatuan']    = htmlspecialchars($this->input->post('id_kesatuan'));
                    $data['jalan']          = htmlspecialchars($this->input->post('jalan'));
                    $data['rumah']          = htmlspecialchars($this->input->post('rumah'));
                    $data['tempat_parkir']  = htmlspecialchars($this->input->post('tempat_parkir'));
                    $data['tempat_ibadah']  = htmlspecialchars($this->input->post('tempat_ibadah'));
                    $data['halaman_kantor'] = htmlspecialchars($this->input->post('halaman_kantor'));
                    $data['lain_lain']      = htmlspecialchars($this->input->post('lain_lain'));
                    $data['jumlah']         = ($data['jalan'] + $data['rumah'] + $data['tempat_parkir'] + $data['tempat_ibadah'] + $data['halaman_kantor'] + $data['lain_lain']);
                    $data['create_date']    = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']       = '';
                    $result           = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                    $this->Model_tb_ranmor_lokasi->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("id_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("jalan", "Jalan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("rumah", "Rumah", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("tempat_parkir", "Tempat Parkir", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("tempat_ibadah", "Tempat Ibadah", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("halaman_kantor", "Halaman Kantor", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("lain_lain", "Lain-lain", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']             = htmlspecialchars($this->input->post('id'));
                    $data['id_kesatuan']    = htmlspecialchars($this->input->post('id_kesatuan'));
                    $data['jalan']          = htmlspecialchars($this->input->post('jalan'));
                    $data['rumah']          = htmlspecialchars($this->input->post('rumah'));
                    $data['tempat_parkir']  = htmlspecialchars($this->input->post('tempat_parkir'));
                    $data['tempat_ibadah']  = htmlspecialchars($this->input->post('tempat_ibadah'));
                    $data['halaman_kantor'] = htmlspecialchars($this->input->post('halaman_kantor'));
                    $data['lain_lain']      = htmlspecialchars($this->input->post('lain_lain'));
                    $data['jumlah']         = ($data['jalan'] + $data['rumah'] + $data['tempat_parkir'] + $data['tempat_ibadah'] + $data['halaman_kantor'] + $data['lain_lain']);
                    $data['create_date']    = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']       = '';
                    $result           = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Model_tb_ranmor_lokasi->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->Model_tb_ranmor_lokasi->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }

            $this->load->view('index', $view);
        }
    }

    public function ranmorWaktu($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']       = 'Daftar Pencurian Kendaraan Motor';
            $view['pageName']    = 'ranmorWaktu';
            $view['getKesatuan'] = $this->Model_kesatuan->getData();

            if ($param == 'getAllData') {
                $dt    = $this->Model_tb_ranmor_waktu->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<div style="font-size:12px;">' . ++$start . '</div>';
                    $th2 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $th3 = '<div style="font-size:12px;">' . $row->nama_kesatuan . '</div>';
                    $th4 = '<div style="font-size:12px;">' . $row->w_24_06 . '</div>';
                    $th5 = '<div style="font-size:12px;">' . $row->w_06_12 . '</div>';
                    $th6 = '<div style="font-size:12px;">' . $row->w_12_18 . '</div>';
                    $th7 = '<div style="font-size:12px;">' . $row->w_18_24 . '</div>';
                    $th8 = '<div style="font-size:12px;">' . $row->jumlah . '</div>';
                    $th9 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $data = $this->Model_tb_ranmor_waktu->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("id_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("w_24_06", "No Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("w_06_12", "Tanggal Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("w_12_18", "Jenis Kejadian", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("w_18_24", "Lokasi", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_kesatuan'] = htmlspecialchars($this->input->post('id_kesatuan'));
                    $data['w_24_06']     = htmlspecialchars($this->input->post('w_24_06'));
                    $data['w_06_12']     = htmlspecialchars($this->input->post('w_06_12'));
                    $data['w_12_18']     = htmlspecialchars($this->input->post('w_12_18'));
                    $data['w_18_24']     = htmlspecialchars($this->input->post('w_18_24'));
                    $data['jumlah']      = ($data['w_24_06'] + $data['w_06_12'] + $data['w_12_18'] +  $data['w_18_24']);
                    $data['create_date'] = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                    $this->Model_tb_ranmor_waktu->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("id_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("w_24_06", "No Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("w_06_12", "Tanggal Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("w_12_18", "Jenis Kejadian", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("w_18_24", "Lokasi", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']          = htmlspecialchars($this->input->post('id'));
                    $data['id_kesatuan'] = htmlspecialchars($this->input->post('id_kesatuan'));
                    $data['w_24_06']     = htmlspecialchars($this->input->post('w_24_06'));
                    $data['w_06_12']     = htmlspecialchars($this->input->post('w_06_12'));
                    $data['w_12_18']     = htmlspecialchars($this->input->post('w_12_18'));
                    $data['w_18_24']     = htmlspecialchars($this->input->post('w_18_24'));
                    $data['jumlah']      = ($data['w_24_06'] + $data['w_06_12'] + $data['w_12_18'] +  $data['w_18_24']);
                    $data['create_date'] = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Model_tb_ranmor_waktu->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->Model_tb_ranmor_waktu->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }

            $this->load->view('index', $view);
        }
    }

    public function rekapRanmor($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']    = 'Daftar Pencurian Kendaraan Motor';
            $view['pageName'] = 'rekapRanmor';
            $view['getKesatuan'] = $this->Model_kesatuan->getData();

            if ($param == 'getAllData') {
                $dt    = $this->Model_tb_ranmor_rekap->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id   = $row->id;
                    $th1  = '<div style="font-size:12px;">' . ++$start . '</div>';
                    $th2  = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $th3  = '<div style="font-size:12px;">' . $row->nama_kesatuan . '</div>';
                    $th4  = '<div style="font-size:12px;">' . $row->hilang . '</div>';
                    $th5  = '<div style="font-size:12px;">' . $row->temu . '</div>';
                    $th6  = '<div style="font-size:12px;">' . $row->jumlah . '</div>';
                    $th7 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                    $data[]     = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $data = $this->Model_tb_ranmor_rekap->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("id_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("hilang", "No Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("temu", "Tanggal Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_kesatuan']        = htmlspecialchars($this->input->post('id_kesatuan'));
                    $data['hilang']      = htmlspecialchars($this->input->post('hilang'));
                    $data['temu']     = htmlspecialchars($this->input->post('temu'));
                    $data['jumlah']  = ($data['hilang'] + $data['temu']);
                    $data['create_date']     = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']        = '';
                    $result            = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                    $this->Model_tb_ranmor_rekap->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("id_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("hilang", "No Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("temu", "Tanggal Laporan", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']      = htmlspecialchars($this->input->post('id'));
                    $data['id_kesatuan']        = htmlspecialchars($this->input->post('id_kesatuan'));
                    $data['hilang']      = htmlspecialchars($this->input->post('hilang'));
                    $data['temu']     = htmlspecialchars($this->input->post('temu'));
                    $data['jumlah']  = ($data['hilang'] + $data['temu']);
                    $data['create_date']     = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']        = '';
                    $result            = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Model_tb_ranmor_rekap->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->Model_tb_ranmor_rekap->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }

            $this->load->view('index', $view);
        }
    }

    public function kesatuan($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']    = 'Daftar Pencurian Kendaraan Motor';
            $view['pageName'] = 'kesatuan';

            if ($param == 'getAllData') {
                $dt    = $this->Model_kesatuan->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = $row->id;
                    $th1 = '<div style="font-size:12px;">' . ++$start . '</div>';
                    $th2 = '<div style="font-size:12px;">' . $row->nama_kesatuan . '</div>';
                    $th3 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $data[]    = gathered_data(array($th1, $th2, $th3));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $data = $this->Model_kesatuan->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("nama_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['nama_kesatuan'] = htmlspecialchars($this->input->post('nama_kesatuan'));
                    $result['messages']      = '';
                    $result          = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                    $this->Model_kesatuan->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("nama_kesatuan", "Kesatuan", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']            = htmlspecialchars($this->input->post('id'));
                    $data['nama_kesatuan'] = htmlspecialchars($this->input->post('nama_kesatuan'));
                    $result['messages']      = '';
                    $result          = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->Model_kesatuan->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->Model_kesatuan->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }

            $this->load->view('index', $view);
        }
    }
}

/* End of file Manajemen.php */
