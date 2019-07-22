<div class="container-fluid">
    <div class="user">
        <div class="row">
            <div class="col-10">
                <h1 style="font-size: 24px; color:black">Data <small style="font-size: 60%">Others > Insert</small> </h1>
            </div>
            <div class="col-2">
            </div>
        </div>
        <div class="card mx-auto mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-7">

                        <form action="<?= base_url('user/tambahOthers') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="no_ot" id="no_ot">
                                    <?= form_error('no_ot', '<small class="form-text text-danger">', '</small>'); ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Tanggal Surat</label>
                                <div class="col-sm-9">
                                    <input type='text' name="tgl_ot" class="form-control" id='datepicker'>
                                    <?= form_error('tgl_ot', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Pengirim</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="pengirim" id="pengirim">
                                    <?= form_error('pengirim', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Tujuan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tujuan" id="tujuan">
                                    <?= form_error('tujuan', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Perihal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="perihal" id="perihal">
                                    <?= form_error('perihal', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Disposisi</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="dis_id" name="dis_id">
                                        <option disabled selected>--- Disposisi ----</option>
                                        <?php foreach ($disp as $k) : ?>
                                            <option value="<?= $k['id_dis'] ?>"><?= $k['nama_dis'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('dis_id', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Isi Disposisi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="isi_dis" id="isi_dis">
                                    <?= form_error('isi_dis', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="keterangan" id="keterangan">
                                    <?= form_error('keterangan', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">Nominal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nominal" id="nominal">
                                    <?= form_error('nominal', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 text-right col-form-label">File</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="filePdf" id="fileMsk">
                                    <?= form_error('filePdf', '<small class="form-text text-danger">', '</small>'); ?>
                                    <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-fw fa-save pr-2"></i>Save</button>
                                    <a href="<?= base_url('user/others') ?>" class="btn btn-secondary mt-3"><i class="fas fa-fw fa-undo pr-2"></i>Cancel</a>
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