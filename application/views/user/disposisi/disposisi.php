<div class="container-fluid">
    <div class="user">
        <div class="row">
            <div class="col-10">
                <h1 style="font-size: 24px; color:black">Master <small style="font-size: 60%">Disposisi</small> </h1>
            </div>
            <div class="col-2">
                <a href="<?= base_url('user/tambahDisposisi') ?>" class="btn btn-primary float-right">
                    <i class="fas fa-fw fa-plus"></i>
                    Add Disposisi
                </a>
            </div>
        </div>

        <div class="card mx-auto mt-3">
            <div class="card-body">
                <?= $this->session->flashdata('disposisi'); ?>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Disposisi</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($disposisi as $m) : ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $m['nama_dis']; ?></td>
                                        <td><a href="<?= base_url('user/ubahDisposisi/') . $m['id_dis'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i></a>
                                            <a href="<?= base_url('user/hapusDisposisi/') . $m['id_dis'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a>
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