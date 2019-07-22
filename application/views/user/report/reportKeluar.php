<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="report">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-10">
                <h1 style="font-size: 24px; color:black">Report <small style="font-size: 60%">Surat Masuk</small> </h1>
            </div>
            <div class="col-2">
            </div>
        </div>

        <div class="card mx-auto mt-3">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-auto col-form-label">Tanggal</label>
                        <div class="col">
                            <input type='text' name="tgl_dari" class="form-control" id='datepicker' placeholder="Dari">
                            <?= form_error('tgl_dari', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col">
                            <input type='text' name="tgl_ke" class="form-control" id='datepicker2' placeholder="Sampai">
                            <?= form_error('tgl_ke', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <label for="inputPassword" class="col-auto col-form-label">Disposisi</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="dis_id" name="dis_id">
                                <option value="nl" selected>--- All Disposisi ----</option>
                                <?php foreach ($disp as $k) : ?>
                                    <option value="<?= $k['id_dis'] ?>"><?= $k['nama_dis'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-auto">
                            <button type="submit" name="reportK" class="btn btn-primary"><i class="fas fa-fw fa-save pr-2"></i>Get Report</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="card mx-auto mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal dan Jam</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Disposisi</th>
                                </tr>
                            </thead>
                            <?php if (!empty($reportM)) : ?>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($reportM as $m) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= date('d F Y', strtotime($m['tgl_sk'])); ?></td>
                                            <td> <a href="http://"><?= $m['no_sk']; ?></a> </td>
                                            <td><?= $m['pengirim_sk']; ?></td>
                                            <td><?= $m['perihal']; ?></td>
                                            <td><?= $m['nama_dis']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            <?php endif; ?>
                        </table>
                        <?php if (!empty($reportM)) : ?>
                            <form action="<?= base_url('user/excelSk/' . $tgl_dari . '/' . $tgl_sampai . "/")   . $dispo  ?>" method="post">
                                <button type="submit" id="btnExport" name='export' value="Export to Excel" class="btn btn-info">Export to
                                    excel</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->