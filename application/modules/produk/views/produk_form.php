<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4><?php echo $judul ?></h4>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('produk') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group <?php if (form_error('nama_produk')) echo 'has-error' ?> ">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk" value="<?php echo $nama_produk; ?>" />
                                <?php echo form_error('nama_produk', '<small style="color:red">', '</small>') ?>
                            </div>
                            <div class="form-group <?php if (form_error('deskripsi')) echo 'has-error' ?> ">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="editor" class="form-control" rows="10" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea>
                                <?php echo form_error('deskripsi', '<small style="color:red">', '</small>') ?>
                            </div>
                            <div class="form-group <?php if (form_error('harga')) echo 'has-error' ?> ">
                                <label for="harga">Harga</label>
                                <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
                                <?php echo form_error('harga', '<small style="color:red">', '</small>') ?>
                            </div>

                            <?php if ($this->uri->segment('3')) : ?>
                                <div class="form-group">
                                    <img class="img-responsive" src="<?php echo base_url('assets/img/produk/') . $thumbnail ?>">
                                </div>
                                <div class="form-group <?php if (form_error('thumbnail')) echo 'has-error' ?> ">
                                    <label for="thumbnail">Thumbnail</label>
                                    <input type="file" class="form-control" name="thumbnail" id="thumbnail" placeholder="Thumbnail" value="<?php echo $thumbnail; ?>" />
                                    <?php echo form_error('thumbnail', '<small style="color:red">', '</small>') ?>
                                </div>
                            <?php else : ?>
                                <div class="form-group <?php if (form_error('thumbnail')) echo 'has-error' ?> ">
                                    <label for="thumbnail">Thumbnail</label>
                                    <input required type="file" class="form-control" name="thumbnail" id="thumbnail" placeholder="Thumbnail" value="<?php echo $thumbnail; ?>" />
                                    <?php echo form_error('thumbnail', '<small style="color:red">', '</small>') ?>
                                </div>
                            <?php endif; ?>

                            <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" />
                            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>

<?php if ($judul == 'Ubah Produk') : ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="pull-left">
                        <div class="box-title">
                            <h4>Gambar Produk</h4>
                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="box-title">
                            <a href="<?php echo base_url('produk/tambah_gambar/') . $id_produk ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Gambar</a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dt" width="100%" id="#mytable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($gambar_produk as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><img src="<?= base_url('assets/img/gambar_produk/') . $row->gambar ?>" alt="" width="300"></td>
                                        <td><a class="btn btn-danger hapus-data" data-href="<?= base_url('produk/hapus_gambar_produk/') . $row->id_gambar_produk . '/' . $id_produk ?>"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="pull-left">
                        <div class="box-title">
                            <h4>Marketplace Produk</h4>
                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="box-title">
                            <a href="<?php echo base_url('produk/tambah_marketplace/') . $id_produk ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Marketplace</a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dt" width="100%" id="#mytable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>marketplace</th>
                                    <th>link</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($marketplace_produk as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row->nama_marketplace ?></td>
                                        <td><a target="_blank" href="<?= $row->link ?>"><?= $row->link ?></a></td>
                                        <td>
                                            <a class="btn btn-warning" href="<?= base_url('produk/ubah_marketplace/') . $row->id_marketplace_produk . '/' . $id_produk ?>"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger hapus-data" data-href="<?= base_url('produk/hapus_marketplace_produk/') . $row->id_marketplace_produk . '/' . $id_produk ?>"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
<?php endif ?>


<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
