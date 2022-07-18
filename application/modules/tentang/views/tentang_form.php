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
                        <a href="<?php echo base_url('tentang') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group <?php if(form_error('deskripsi')) echo 'has-error'?> ">
                                                <label for="deskripsi">Deskripsi</label>
                                                <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea>
                                                <?php echo form_error('deskripsi', '<small style="color:red">','</small>') ?>
                                            </div>
	    <div class="form-group <?php if(form_error('maps')) echo 'has-error'?> ">
                                                <label for="maps">Maps</label>
                                                <textarea class="form-control" rows="3" name="maps" id="maps" placeholder="Maps"><?php echo $maps; ?></textarea>
                                                <?php echo form_error('maps', '<small style="color:red">','</small>') ?>
                                            </div>
	    <div class="form-group <?php if(form_error('alamat')) echo 'has-error'?> ">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
                                                <?php echo form_error('alamat', '<small style="color:red">','</small>') ?>
                                            </div>
	    <div class="form-group <?php if(form_error('whatsapp')) echo 'has-error'?> ">
                                                <label for="whatsapp">Whatsapp</label>
                                                <input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Whatsapp" value="<?php echo $whatsapp; ?>" />
                                                <?php echo form_error('whatsapp', '<small style="color:red">','</small>') ?>
                                            </div>
	    <input type="hidden" name="id_tentang" value="<?php echo $id_tentang; ?>" /> 
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