<div class="container-fluid">
    <div class="surat">
        <div class="row">
            <div class="col-10">
                <h4>Detail </h4>
            </div>
            <div class="col-2">
                <!-- <button class="btn btn-primary float-right">
                    <i class="fas fa-fw fa-cog"></i>
                    Setup
                </button> -->
            </div>
        </div>

        <div class="card mx-auto mt-3">
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-3">
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-7">
                                <a href="<?= base_url('assets/img/') . $sm['file_ot'] ?>" target="_blank" class="btn btn-sm btn-block btn-outline-secondary btn-lg mt-4"><i class="fas fa-file fa-7x p-2"></i></a>
                                <a href="<?= base_url('assets/img/') . $sm['file_ot'] ?>" target="_blank" class="btn btn-sm btn-block btn-outline-dark btn-lg mt-2">File</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <table class="table table-borderless" style="font-size: 15px;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        <h4><?= $sm['no_ot'] ?></h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="info-table">
                                <tr>
                                    <td class="field">Tanggal</td>
                                    <td><?= $sm['tgl_ot'] ?></td>

                                </tr>
                                <tr>
                                    <td class="field">Pengirim</td>
                                    <td><?= $sm['pengirim_ot'] ?></td>
                                </tr>
                                <tr>
                                    <td class="field">Pengirim</td>
                                    <td><?= $sm['tujuan'] ?></td>
                                </tr>
                                <tr>
                                    <td class="field">Perihal</td>
                                    <td><?= $sm['perihal'] ?></td>
                                </tr>
                                <tr>
                                    <td class="field">Disposisi</td>
                                    <?php foreach ($disp as $k) : ?>
                                        <?php if ($k['id_dis'] == $sm['dis_id']) : ?>
                                            <td><?= $k['nama_dis'] ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <td class="field">Isi Disposisi</td>
                                    <td><?= $sm['isi_dis'] ?></td>
                                </tr>
                                <tr>
                                    <td class="field">Keterangan</td>
                                    <td><?= $sm['keterangan'] ?></td>
                                </tr>
                                <tr>
                                    <td class="field">Nominal</td>
                                    <td><?= $sm['nominal'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="mb-4">
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->