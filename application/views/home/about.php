<?php $tentang = $this->db->get('tentang')->row() ?>
<div class="hero text-light" style="background-image: url(<?= base_url('assets/img/website/') . $website->gambar_tentang ?>)">
    <div class="overlay"></div>
</div>
<div class="container py-5">
    <h1 class="fw-bold text-center">About Us</h1>
    <p class="">
        <?= $tentang->deskripsi ?>
    </p>
    <div class="row py-5">
        <div class="col-md-6">
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe width="600" height="500" id="gmap_canvas" src="<?= $tentang->maps ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net"></a><br />
                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 500px;
                            width: 600px;
                        }
                    </style><a href="https://www.embedgooglemap.net">google maps insert</a>
                    <style>
                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 500px;
                            width: 600px;
                        }
                    </style>
                </div>
            </div>
        </div>
        <div class="col-md-6"><?= $tentang->alamat ?></div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center fw-bold">Our Store</h3>
            <div class="d-flex flex-wrap align-items-center justify-content-center w-100">
                <?php foreach ($this->db->get('marketplace')->result() as $row) : ?>
                    <a href="<?= $row->link_marketplace ?>" class="marketplace-detail p-2 m-1">
                        <img src="<?= base_url() ?>assets/img/marketplace/<?= $row->gambar ?>" alt="" />
                    </a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
