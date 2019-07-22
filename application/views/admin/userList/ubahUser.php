<div class="container-fluid">
    <div class="user">
        <div class="row">
            <div class="col-10">
                <h1 style="font-size: 24px; color:black">Setup <small style="font-size: 60%">User > Edit</small> </h1>
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
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Nama User</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="name" value="<?= $userId['name'] ?>">
                                    <?= form_error('name', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username" id="username" value="<?= $userId['username'] ?>">
                                    <?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password1" id="password" value="<?= $userId['password'] ?>">
                                    <?= form_error('password1', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Ulang Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password2" id="pass">
                                    <?= form_error('password2', '<small class="form-text text-danger">', '</small>'); ?>
                                    <input type="hidden" name="date_created" value="<?= $userId['date_created'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="role" name="role">
                                        <?php foreach ($akses as $r) : ?>
                                            <?php if ($r == $userId['role']) : ?>
                                                <option value="<?= $r ?>" selected><?= $r ?></option>
                                            <?php else : ?>
                                                <option value="<?= $r ?>"><?= $r ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-fw fa-save pr-2"></i>Save</button>
                                    <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary mt-3"><i class="fas fa-fw fa-undo pr-2"></i>Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>

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