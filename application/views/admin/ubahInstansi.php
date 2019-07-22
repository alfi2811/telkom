<div class="container-fluid">
    <div class="user">
        <div class="row">
            <div class="col-10">
                <h1 style="font-size: 24px; color:black">Setup <small style="font-size: 60%">Instansi > Edit</small> </h1>
            </div>
            <div class="col-2">
            </div>
        </div>
        <div class="card mx-auto mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-1">
                    </div>
                    <div class="col-8">

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Kabupaten / Kota</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kab" id="kab" value="<?= $instansi['kabKota'] ?>">
                                    <?= form_error('kab', '<small class="form-text text-danger">', '</small>'); ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Telp</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="telp" id="telp" value="<?= $instansi['telp'] ?>">
                                    <?= form_error('telp', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" id="email" value="<?= $instansi['email'] ?>">
                                    <?= form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $instansi['alamat'] ?>">
                                    <?= form_error('alamat', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Kepala</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kepala" id="kepala" value="<?= $instansi['kepala'] ?>">
                                    <?= form_error('kepala', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">NIP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nip" id="nip" value="<?= $instansi['nip'] ?>">
                                    <?= form_error('nip', '<small class="form-text text-danger">', '</small>'); ?>
                                    <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-fw fa-save pr-2"></i>Save</button>
                                    <a href="<?= base_url('admin/instansi') ?>" class="btn btn-secondary mt-3"><i class="fas fa-fw fa-undo pr-2"></i>Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-2">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->