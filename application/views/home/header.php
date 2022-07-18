<?php $website = $this->db->get('website')->row(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $website->nama_website ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="<?= base_url() ?>assets/slick/slick.js"></script>
    <link rel="stylesheet" href=" <?= base_url() ?>assets/slick/slick.css" />
    <link rel="stylesheet" href=" <?= base_url() ?>assets/slick/slick-theme.css" />
    <link rel="stylesheet" href=" <?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/easyzoom.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light fixed-top bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand py-2 fw-bold" href="#"> <img src="<?= base_url() ?>assets/img/website/<?= $website->logo ?> " width="40" class=" me-2" alt=""><?= $website->nama_website ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarV" aria-controls="navbarV" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse py-3" id="navbarV">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home/') ?>index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home/') ?>index#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home/') ?>index#testimony">Testimony</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home/') ?>about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home/') ?>products">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home/') ?>contact">Contact</a>
                    </li>
                </ul>
                <form class="d-flex align-items-center justify-content-end" role="search" action="<?= base_url('home/products') ?>">
                    <input type="text" placeholder="Search" class="form-control cari-input" name="q">
                    <button class=" border-0 bg-transparent" type="submit"><i class="fa-solid fa-magnifying-glass px-2 cari-btn"></i></button>
                </form>
            </div>
        </div>
    </nav>

    <div class="whatsapp">
        <a target="_blank" href="https://wa.me/<?= $this->db->get('tentang')->row()->whatsapp ?>" class="text-white">
            <i class="fa-brands fa-whatsapp fa-3x"></i>
        </a>
    </div>
