<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-9">
            <h1 style="font-size: 24px; color:black">Data <small style="font-size: 60%">Others</small> </h1>
        </div>
        <div class="col-3">
            <a href="<?= base_url('user/tambahOthers') ?>" class="btn btn-primary float-right">
                <i class="fas fa-fw fa-plus"></i>
                Add Surat Masuk
            </a>
        </div>
    </div>
    <div class="mt-2">
        <?= $this->session->flashdata('others'); ?>
    </div>
    <div class="card mx-auto mt-3">

        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal dan Jam</th>
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Pengirim</th>
                                <th scope="col">Disposisi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($others as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= date('d F Y', strtotime($m['tgl_ot'])); ?></td>
                                    <td> <a href="<?= base_url('user/detailOthers/') . $m['id_ot'] ?>"><?= $m['no_ot']; ?></a> </td>
                                    <td><?= $m['pengirim_ot']; ?></td>
                                    <td><?= $m['nama_dis']; ?></td>
                                    <td>
                                        <a href="<?= base_url('user/detailOthers/') . $m['id_ot'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-folder-open"></i></a>
                                        <a href="<?= base_url('user/ubahOthers/') . $m['id_ot'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i></a>
                                        <a href="<?= base_url('user/hapusOthers/') . $m['id_ot'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach;  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->