<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-9">
            <h1 style="font-size: 24px; color:black">Setup <small style="font-size: 60%">User</small> </h1>
        </div>
        <div class="col-3">
            <a href="<?= base_url('admin/tambahUser') ?>" class="btn btn-primary float-right">
                <i class="fas fa-fw fa-plus"></i>
                Add User
            </a>
        </div>
    </div>
    <div class="mt-2">
        <?= $this->session->flashdata('userMes'); ?>
    </div>
    <div class="card mx-auto mt-3">
        <div class="card-body">

            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Password</th>
                                <th scope="col">Hak Akses</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($userData as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $m['username']; ?></td>
                                    <td><?= $m['name']; ?></td>
                                    <td><?= $m['password']; ?></td>
                                    <td><?= $m['role']; ?></td>
                                    <td><?= $m['image']; ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/ubahUser/') . $m['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i></a>
                                        <a href="<?= base_url('admin/hapusUser/') . $m['id'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a>
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