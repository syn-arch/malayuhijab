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
                        <a href="<?php echo base_url('website') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group <?php if(form_error('nama_website')) echo 'has-error'?> ">
                                                <label for="nama_website">Nama Website</label>
                                                <input type="text" class="form-control" name="nama_website" id="nama_website" placeholder="Nama Website" value="<?php echo $nama_website; ?>" />
                                                <?php echo form_error('nama_website', '<small style="color:red">','</small>') ?>
                                            </div>
	    <div class="form-group <?php if(form_error('deskripsi')) echo 'has-error'?> ">
                                                <label for="deskripsi">Deskripsi</label>
                                                <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea>
                                                <?php echo form_error('deskripsi', '<small style="color:red">','</small>') ?>
                                            </div>
	    <div class="form-group <?php if(form_error('deskripsi_service')) echo 'has-error'?> ">
                                                <label for="deskripsi_service">Deskripsi Service</label>
                                                <textarea class="form-control" rows="3" name="deskripsi_service" id="deskripsi_service" placeholder="Deskripsi Service"><?php echo $deskripsi_service; ?></textarea>
                                                <?php echo form_error('deskripsi_service', '<small style="color:red">','</small>') ?>
                                            </div>
	    <div class="form-group <?php if(form_error('deskripsi_testimoni')) echo 'has-error'?> ">
                                                <label for="deskripsi_testimoni">Deskripsi Testimoni</label>
                                                <textarea class="form-control" rows="3" name="deskripsi_testimoni" id="deskripsi_testimoni" placeholder="Deskripsi Testimoni"><?php echo $deskripsi_testimoni; ?></textarea>
                                                <?php echo form_error('deskripsi_testimoni', '<small style="color:red">','</small>') ?>
                                            </div>
	
                                            <?php if($this->uri->segment('3')) : ?>
                                            <div class="form-group">
                                                <img class="img-responsive" src="<?php echo base_url('assets/img/website/') . $gambar_tentang ?>">
                                            </div>
                                            <div class="form-group <?php if(form_error('gambar_tentang')) echo 'has-error'?> ">
                                                <label for="gambar_tentang">Gambar Tentang</label>
                                                <input type="file" class="form-control" name="gambar_tentang" id="gambar_tentang" placeholder="Gambar Tentang" value="<?php echo $gambar_tentang; ?>" />
                                                <?php echo form_error('gambar_tentang', '<small style="color:red">','</small>') ?>
                                            </div>
                                            <?php else: ?>
                                            <div class="form-group <?php if(form_error('gambar_tentang')) echo 'has-error'?> ">
                                                <label for="gambar_tentang">Gambar Tentang</label>
                                                <input required type="file" class="form-control" name="gambar_tentang" id="gambar_tentang" placeholder="Gambar Tentang" value="<?php echo $gambar_tentang; ?>" />
                                                <?php echo form_error('gambar_tentang', '<small style="color:red">','</small>') ?>
                                            </div>
                                            <?php endif; ?>
                                            
	    <div class="form-group <?php if(form_error('gambar_kontak')) echo 'has-error'?> ">
                                                <label for="gambar_kontak">Gambar Kontak</label>
                                                <input type="text" class="form-control" name="gambar_kontak" id="gambar_kontak" placeholder="Gambar Kontak" value="<?php echo $gambar_kontak; ?>" />
                                                <?php echo form_error('gambar_kontak', '<small style="color:red">','</small>') ?>
                                            </div>
	    <input type="hidden" name="id_website" value="<?php echo $id_website; ?>" /> 
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