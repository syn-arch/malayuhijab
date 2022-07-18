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
                        <a href="<?php echo base_url('testimoni') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group <?php if(form_error('nama_testimoni')) echo 'has-error'?> ">
                                            <label for="nama_testimoni">Nama Testimoni</label>
                                            <input type="text" class="form-control" name="nama_testimoni" id="nama_testimoni" placeholder="Nama Testimoni" value="<?php echo $nama_testimoni; ?>" />
                                            <?php echo form_error('nama_testimoni', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('deskripsi')) echo 'has-error'?> ">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea>
                                            <?php echo form_error('deskripsi', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('gambar')) echo 'has-error'?> ">
                                            <label for="gambar">Gambar</label>
                                            <input type="text" class="form-control" name="gambar" id="gambar" placeholder="Gambar" value="<?php echo $gambar; ?>" />
                                            <?php echo form_error('gambar', '<small style="color:red">','</small>') ?>
                                        </div>
	    <input type="hidden" name="id_testimoni" value="<?php echo $id_testimoni; ?>" /> 
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