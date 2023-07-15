<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title; ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><?= $home; ?></a></li>
                <!-- <li class="breadcrumb-item"><?= $subtitle; ?></li> -->
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Main content -->
    <?php if($pegawai['kd_gugus'] == $gugus['kd_gugus']){?>
        <section class="content">
            <div class="container-fluid">        
                <div class="table-responsive">
                    <table class="table table-striped" id="mytable" style="font-size: 14px;">
                        <thead>
                            <tr class="text-left">
                                <th scope="col">#</th>
                                <th scope="col">Logo</th>
                                <th scope="col">NPSN</th>
                                <th scope="col">Nama Sekolah</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Telp</th>
                                <th scope="col">Kepala Sekolah</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data_sekolah as $s) : ?>
                            <tr>
                                <td scope="row"><?= $i; ?></td>
                                <?php if($s['logo'] == '') {?>
                                <td><button type="button" class="btn btn-light"><i class="bi bi-card-image"></i></button></td>
                                <?php } else {?>
                                <td><img src="<?= base_url(); ?>dist/upload/logo/<?= $s['logo']; ?>" alt="..." style="width:50%;max-width:50px"></td>
                                <?php } ?>                                       
                                <td><?= $s['kd_sekolah']; ?></td>
                                <td><?= $s['nama_sekolah']; ?></td>
                                <td><?= $s['kecamatan'] ?></td>
                                <td><?= $s['telp']; ?></td>
                                <td><?= $s['sebutan_kepala']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-light"><i class="bi bi-eye"></i></button>                            
                                </td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>   
            <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    <?php } ?>
    <?php if($pegawai['kd_sekolah'] == $sekolah['kd_sekolah']){?>
        <section class="content">
            <div class="col-12">
                <div class="card">
                    <div class="tampil-modal"></div>
                    <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <div class="flash-data" data-flashdata=""><?= $this->session->flashdata('message'); ?></div>
                    <div class="card-body">
                        <div class="panel-body">
                            <?php if ($cek_akses['role_id'] == 1) : ?>
                                <button type="button" class="btn btn-primary mb-3 btn-action">
                                    <span class="fa fa-plus"></span> Tambah Data
                                </button>
                            <?php endif ?>
                            <div class="table-responsive">
                                <table id="example1" class="table table-striped projects">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun</th>
                                            <th>Semester</th>
                                            <th>Kepala Sekolah</th>
                                            <!-- <th>Tgl Raport PTS</th>
                                            <th>Tgl Raport PAS/PAT</th> -->
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
    <?php } ?>    
    <!-- /.content -->

</main>