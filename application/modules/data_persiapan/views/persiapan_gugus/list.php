<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title; ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html"><?= $home; ?></a></li>
                <!-- <li class="breadcrumb-item"><?= $subtitle; ?></li> -->
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Main content -->
    <section class="section dashboard">
        <div class="row">

            <!-- Main content -->
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>

            <div class="card">
                <div class="card-body">
                    <div class="info-box">
                        <h3 class="card-title"><?= $subtitle; ?></h3>
                    </div>

                    <form action="<?= base_url('data_persiapan/persiapan_gugus/data_gugus'); ?>" method="post" enctype="multipart/form-data">
                        <!--begin::Table-->
                        <div class="modal-body">
                            <div class="row">                 
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="kd_gugus" value="<?= $sch['kd_gugus'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="nama_gugus" name="nama_gugus" value="<?= $sch['nama_gugus'] ?>" placeholder="NPSN">
                                    </div>
                                </div>
                            </div>                     
                            <div class="mb-3">
                                <label for="">Alamat Sekolah</label>
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" style="height: 100px"><?= $sch['alamat'] ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="gugus_provinsi_id" class="form-control" id="provinsi">
                                            <option value="<?= $sch['gugus_provinsi_id'] ?>"> <?= $sch['provinsi'] ?> </option>
                                            <?php foreach ($provinsi as $prov) {
                                                echo '<option value="' . $prov->provinsi_id . '">' . $prov->provinsi . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="gugus_kota_id" class="form-control" id="kabupaten">
                                            <option value="<?= $sch['gugus_kota_id'] ?>"> <?= $sch['kota'] ?> </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="gugus_kecamatan_id" class="form-control" id="kecamatan">
                                            <option value="<?= $sch['gugus_kecamatan_id'] ?>"> <?= $sch['kecamatan'] ?> </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="kodepos" name="kodepos" value="<?= $sch['kodepos'] ?>" placeholder="Kode Pos">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="telp" name="telp" value="<?= $sch['telp'] ?>" placeholder="Telpon">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="email" name="email" value="<?= $sch['email'] ?>" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="web" name="web" value="<?= $sch['web'] ?>" placeholder="Website">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="sebutan_kepala" name="sebutan_kepala" value="<?= $sch['sebutan_kepala'] ?>" placeholder="Nama Kepala Gugus">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="nip" name="nip" value="<?= $sch['nip'] ?>" placeholder="NIP">
                                    </div>
                                </div>                               
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="card">
                                    <div class="col-md-12">
                                        <label for="">Logo gugus</label>
                                        <div class="mb-3 text-center">
                                            <img src="<?= base_url(); ?>panel/dist/upload/logo/<?= $sch['logo'] ?>" alt="..." style="width:100%;max-width:150px">
                                            <input type="hidden" name="old_image" value="<?= $sch['logo'] ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <input type="file" class="form-control" id="logo" name="logo" placeholder="Logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Table-->
                        <!-- /.card-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>

</main>

<!-- jQuery -->
<script src="<?= base_url() ?>panel/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#provinsi").change(function() {
            var url = "<?php echo site_url('data_profil/profil_sekolah/add_ajax_kab'); ?>/" + $(this).val();
            $('#kabupaten').load(url);
            return false;
        })

        $("#kabupaten").change(function() {
            var url = "<?php echo site_url('data_profil/profil_sekolah/add_ajax_kec'); ?>/" + $(this).val();
            $('#kecamatan').load(url);
            return false;
        })
    });
</script>
