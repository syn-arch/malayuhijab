<?php $website = $this->db->get('website')->row(); ?>

<div class="top-index">
    <div class="overlay-index">
        <div class="container min-vh-100 d-flex align-items-center justify-content-center">
            <div class="row flex-md-row flex-column-reverse">
                <div class="col-md-6 col-sm-12 d-flex align-items-center">
                    <div class="py-5">
                        <h1 class="text-uppercase fw-bold"><?= $website->nama_website ?></h1>
                        <p class="">
                            <?= $website->deskripsi ?>
                        </p>
                        <a href="#services" class="btn btn-primary rounded-0 btn-block px-4 py-2">Explore More!</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($this->db->get('slider')->result() as $index => $row) : ?>
                                <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                                    <img src="<?= base_url() ?>assets/img/slider/<?= $row->gambar ?>" class="d-block w-100" alt="...">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5 container min-vh-100 d-flex align-items-center justify-content-center" id="services">
    <div>
        <div class="w-75 mx-auto">
            <h2 class="fw-bold text-center">Services</h2>
            <p class="text-center "> <?= $website->deskripsi_service ?></p>
        </div>

        <div class="row">
            <?php foreach ($this->db->get('service')->result() as $row) : ?>
                <div class="col p-5">
                    <div class="card border-0">
                        <img src="<?= base_url() ?>assets/img/service/<?= $row->gambar ?>" class="card-img-top rounded" alt="...">
                        <div class="card-body p-1">
                            <h5 class="fw-bold my-2"><?= $row->nama_service ?></h5>
                            <p class="card-text"><?= $row->deskripsi ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<div class="py-5 container min-vh-100 d-flex flex-column justify-content-center" id="testimony">
    <div class="w-75 mx-auto">
        <h2 class="fw-bold text-center">Testimony</h2>
        <p class="text-center "><?= $website->deskripsi_testimoni ?></p>
    </div>
    <div class="row responsive">
        <?php foreach ($this->db->get('testimoni')->result() as $row) : ?>
            <div class="col-3 p-3">
                <div class="card text-center w-100 p-3">
                    <img src="<?= base_url() ?>assets/img/testimoni/<?= $row->gambar ?>" class="card-img-top avatar mx-auto" alt="..." style="width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 100%;">
                    <div class="card-body">
                        <p class="card-text"><?= $row->deskripsi ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
