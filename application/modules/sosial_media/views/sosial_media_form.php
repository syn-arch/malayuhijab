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
                        <a href="<?php echo base_url('sosial_media') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group <?php if(form_error('nama_sosial_media')) echo 'has-error'?> ">
                                            <label for="nama_sosial_media">Nama Sosial Media</label>
                                            <input type="text" class="form-control" name="nama_sosial_media" id="nama_sosial_media" placeholder="Nama Sosial Media" value="<?php echo $nama_sosial_media; ?>" />
                                            <?php echo form_error('nama_sosial_media', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('link')) echo 'has-error'?> ">
                                            <label for="link">Link</label>
                                            <input type="text" class="form-control" name="link" id="link" placeholder="Link" value="<?php echo $link; ?>" />
                                            <?php echo form_error('link', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('gambar')) echo 'has-error'?> ">
                                            <label for="gambar">Gambar</label>
                                            <input type="text" class="form-control" name="gambar" id="gambar" placeholder="Gambar" value="<?php echo $gambar; ?>" />
                                            <?php echo form_error('gambar', '<small style="color:red">','</small>') ?>
                                        </div>
	    <input type="hidden" name="id_sosial_media" value="<?php echo $id_sosial_media; ?>" /> 
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