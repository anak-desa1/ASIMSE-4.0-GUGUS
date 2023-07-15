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
            <div class="card-body">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            <?= $subtitle ?>
                        </h3>
                    </div>
                    <!-- Default box -->
                    <div class="card-body p-0" style="display: block;">
                        <div class="tampil-modal"></div>
                        <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <div class="flash-data" data-flashdata=""><?= $this->session->flashdata('message'); ?></div>
                        <div class="card-header">
                            <!-- <h3 class="card-title">
                                <?php if ($pegawai['bagian_shift'] == 'ON') : ?>
                                    <button type="button" class="btn btn-info mb-3 btn-action">
                                        <i class="bi bi-plus-square"></i> Tambah Data
                                    </button>
                                <?php endif ?>
                            </h3> -->
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped projects">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Nama Kelas
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kelas as $t) :{ ?>
                                            <tr>
                                                    <td>
                                                        <?= $i ?>
                                                    </td>
                                                    <td>
                                                        <a>
                                                            <?= $t['tingkat'] ?>
                                                        </a>
                                                    </td>
                                                    <td class="project-actions">
                                                        <?php if ($cek_akses['role_id'] == 1) : ?>
                                                            <a class="btn btn-info btn-sm" href="<?= base_url() ?>akademik_rombel/atur_kkm/detail/<?= $t['tingkat'] ?>">
                                                                <i class="fas fa-folder">
                                                                </i>
                                                                KKM
                                                            </a>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                        <?php }
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    <?php } ?>   
    <!-- /.content -->

</main>