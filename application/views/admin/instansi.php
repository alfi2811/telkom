<div class="container-fluid">
    <div class="instansi">
        <div class="row">
            <div class="col-10">
                <h1 style="font-size: 24px; color:black">Setup <small style="font-size: 60%">Instansi</small> </h1>
            </div>
            <div class="col-2">
                <a href="<?= base_url('admin/ubahInstansi') ?>" class="btn btn-primary float-right">
                    <i class="fas fa-fw fa-cog"></i>
                    Setup
                </a>
            </div>
        </div>

        <div class="card mx-auto mt-3">
            <?= $this->session->flashdata('instansi'); ?>
            <div class="card-body">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                <h4>KANTOR STO TELKOM KARET</h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="info-table">
                        <tr>
                            <td class="field">Kabupaten / Kota</td>
                            <td><?= $instansi['kabKota']; ?></td>

                        </tr>
                        <tr>
                            <td class="field">Telp</td>
                            <td><?= $instansi['telp']; ?></td>
                        </tr>
                        <tr>
                            <td class="field">Email</td>
                            <td><?= $instansi['email']; ?></td>
                        </tr>
                        <tr>
                            <td class="field">Alamat</td>
                            <td><?= $instansi['alamat']; ?></td>
                        </tr>
                        <tr>
                            <td class="field">Kepala</td>
                            <td><?= $instansi['kepala']; ?></td>
                        </tr>
                        <tr>
                            <td class="field">NIP</td>
                            <td><?= $instansi['nip']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->