<script>
    console.log('test')
    document.addEventListener("DOMContentLoaded", function(event) {
        table = $('#data').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            "dataType": 'JSON',
            // "dom": 'Bfrtip',
            // "buttons": [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            "ajax": {
                "url": "<?php echo site_url('manajemen/daftarRanmor/getAllData') ?>",
                "type": "POST",
                "data": {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                "targets": [0],
                "className": "center"
            }]
        });
    });

    var save_method;

    function updateAllTable() {
        table.ajax.reload();
    }

    function tambah() {
        save_method = 'add';
        $('#form_inputan')[0].reset();
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $('#modal').modal('show');
        $('.reset').show();
    }

    function ubah(id) {
        save_method = 'update';
        $('#form_inputan')[0].reset();
        $('#modal').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('manajemen/daftarRanmor/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id_laporan"]').val(data.id_laporan);
                $('[name="kesatuan"]').val(data.kesatuan);
                $('[name="no_laporan"]').val(data.no_laporan);
                $('[name="tgl_laporan"]').val(data.tgl_laporan);
                $('[name="jenis_kejadian"]').val(data.jenis_kejadian);
                $('[name="lokasi"]').val(data.lokasi);
                $('[name="tgl_kejadian"]').val(data.tgl_kejadian);
                $('[name="modus"]').val(data.modus);
                $('[name="no_polisi"]').val(data.no_polisi);
                $('[name="jenis_kendaraan"]').val(data.jenis_kendaraan);
                $('[name="merk_type"]').val(data.merk_type);
                $('[name="tahun_pembuatan"]').val(data.tahun_pembuatan);
                $('[name="warna"]').val(data.warna);
                $('[name="no_rangka"]').val(data.no_rangka);
                $('[name="no_mesin"]').val(data.no_mesin);
                $('[name="nama_pelapor"]').val(data.nama_pelapor);
                $('[name="alamat_pelapor"]').val(data.alamat_pelapor);
                $('[name="nama_pemilik"]').val(data.nama_pemilik);
                $('[name="alamat_pemilik"]').val(data.alamat_pemilik);
                // $('[name="create_date"]').val(data.create_date);
                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }

    function hapus(id) {
        swal({
                title: "Apakah Yakin Akan Dihapus?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: "<?php echo site_url('manajemen/daftarRanmor/delete'); ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        data = resp.result;
                        updateAllTable();
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleting Data');
                    }
                });
            });
    }


    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        if (save_method == 'add') {
            url = '<?php echo base_url() ?>manajemen/daftarRanmor/addData';
        } else {
            url = '<?php echo base_url() ?>manajemen/daftarRanmor/update';
        }
        swal({
                title: "Apakah anda sudah yakin ?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                cancelButtonText: "Kembali",
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: $('#form_inputan').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_inputan input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            updateAllTable();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_inputan")[0].reset();
                            $('#modal').modal('hide');
                        } else {
                            $.each(data['messages'], function(key, value) {
                                var element = $('#' + key);
                                element.closest('div.form-group')
                                    .removeClass('has-error')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('#text-error')
                                    .remove();
                                element.after(value);
                            });
                        }
                        swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status']
                        });
                    }

                });
            });
    }
</script>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Polda - <small>Jawa Tengah</small></h3>
            </div>

        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Kendaraan Hilang</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <button class="btn btn-primary btn-sm" onclick="tambah()">
                                <li class="fa fa-plus"></li> Tambah Data
                            </button>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <p class="text-muted font-13 m-b-30">

                                    </p>
                                    <table id="data" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tools</th>
                                                <th>Kesatuan</th>
                                                <th>No Laporan</th>
                                                <th>Tanggal Laporan</th>
                                                <th>Jenis Kejadian</th>
                                                <th>lokasi</th>
                                                <th>Tanggal Kejadian</th>
                                                <th>Modus</th>
                                                <th>No Polisi</th>
                                                <th>Jenis Kendaraan</th>
                                                <th>Merek/Tipe</th>
                                                <th>Tahun Pembuatan</th>
                                                <th>Warna</th>
                                                <th>No Rangka</th>
                                                <th>No Mesin</th>
                                                <th>Nama Pelapor</th>
                                                <th>Alamat Pelapor</th>
                                                <th>Nama Pemilik</th>
                                                <th>Alamat Pemilik</th>
                                                <th>Tanggal Upload</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <li class="fa fa-list"></li> Form Data Laporan Ranmor
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')); ?>
            <div class="modal-body">
                <?php echo form_input(array('id' => 'id_laporan', 'name' => 'id_laporan', 'type' => 'hidden')); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Kesatuan<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" name="kesatuan" id="kesatuan" class="form-control has-feedback-left">
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">No Laporan<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="no_laporan" name="no_laporan" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Tanggal Laporan<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="date" id="tgl_laporan" name="tgl_laporan" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Jenis Kejadian<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="jenis_kejadian" name="jenis_kejadian" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Lokasi<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="lokasi" name="lokasi" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Tanggal Kejadian<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="date" id="tgl_kejadian" name="tgl_kejadian" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Modus<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="modus" name="modus" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">No Polisi<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="no_polisi" name="no_polisi" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Jenis Kendaraan<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="jenis_kendaraan" name="jenis_kendaraan" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Merek/Type<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="merk_type" name="merk_type" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Tahun Pembuatan<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="tahun_pembuatan" name="tahun_pembuatan" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Warna<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="warna" name="warna" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">No Rangka<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="no_rangka" name="no_rangka" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">No Mesin<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="no_mesin" name="no_mesin" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Nama Pelapor<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="nama_pelapor" name="nama_pelapor" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Alamat Pelapor<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="alamat_pelapor" name="alamat_pelapor" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Nama Pemilik<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="nama_pemilik" name="nama_pemilik" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Alamat Pemilik<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" id="alamat_pemilik" name="alamat_pemilik" class="form-control has-feedback-left" required>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Create Date<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                <input type="text" id="create_date" name="create_date" value="<?php echo date('Y-m-d'); ?>" class="form-control has-feedback-left" readonly>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="button" onclick="simpan()" class="btn btn-success btn-sm">Simpan</button>

            </div>
            <?php echo form_close() ?>
        </div>

    </div>
</div>