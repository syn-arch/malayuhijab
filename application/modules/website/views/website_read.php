
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
                     <table class="table">
	    <tr><td>Nama Website</td><td><?php echo $nama_website; ?></td></tr>
	    <tr><td>Logo</td><td><img class="img-responsive" src='<?php echo base_url('assets/img/website/'.$logo) ?>'></td></tr>
	    <tr><td>Deskripsi</td><td><?php echo $deskripsi; ?></td></tr>
	    <tr><td>Deskripsi Service</td><td><?php echo $deskripsi_service; ?></td></tr>
	    <tr><td>Deskripsi Testimoni</td><td><?php echo $deskripsi_testimoni; ?></td></tr>
	    <tr><td>Gambar Tentang</td><td><?php echo $gambar_tentang; ?></td></tr>
	    <tr><td>Gambar Kontak</td><td><?php echo $gambar_kontak; ?></td></tr>
	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>