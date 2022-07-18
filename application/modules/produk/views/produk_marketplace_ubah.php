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
                        <a href="<?php echo base_url('service') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?= base_url('produk/ubah_marketplace/') . $this->uri->segment(3) . '/' . $this->uri->segment(4)  ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="req" value="1">
                            <div class="form-group">
                                <label for="">Marketplace</label>
                                <select name="id_marketplace" id="id_marketplace" class="form-control" required>
                                    <option value="">Pilih Marketplace</option>
                                    <?php foreach ($marketplace as $row) { ?>
                                        <option <?= $row->id_marketplace == $mp->id_marketplace ? 'selected' : '' ?> value="<?= $row->id_marketplace ?>"><?= $row->nama_marketplace ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Link (Menggunakan https://)</label>
                                <input type="text" class="form-control" name="link" placeholder="Link" required value="<?= $mp->link ?>">
                            </div>
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
