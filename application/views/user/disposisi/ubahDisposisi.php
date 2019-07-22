<div class="container-fluid">
    <div class="user">
        <div class="row">
            <div class="col-10">
                <h1 style="font-size: 24px; color:black">Master <small style="font-size: 60%">Disposisi > Edit</small> </h1>
            </div>
            <div class="col-2">
            </div>
        </div>

        <div class="card mx-auto mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-6">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Disposisi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_dis" value="<?= $disp['nama_dis'] ?>" id="nama_dis">
                                    <?= form_error('nama_dis', '<small class="form-text text-danger">', '</small>'); ?>
                                    <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-fw fa-save pr-2"></i>Save</button>
                                    <a href="<?= base_url('user/disposisi') ?>" class="btn btn-secondary mt-3"><i class="fas fa-fw fa-undo pr-2"></i>Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-3">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->