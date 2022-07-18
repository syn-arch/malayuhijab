<div class="container py-5 mt-5">
    <div class="row">
        <div class=" col-12 col-xl-6">
            <div class="row">
                <div class="col-12">
                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                        <a href="<?= base_url() ?>assets/img/gambar_produk/<?= $gambar_produk[0]->gambar ?? $produk->thumbnail ?>">
                            <img src="<?= base_url() ?>assets/img/gambar_produk/<?= $gambar_produk[0]->gambar ?? $produk->thumbnail ?>" class="w-100 img-fluid" alt="" />
                        </a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="thumbnails d-flex justify-content-between align-items-center w-100">
                        <?php foreach ($gambar_produk as $row) : ?>
                            <a class="p-1 text-center" href="<?= base_url('assets/img/gambar_produk/') . $row->gambar ?>" data-standard="<?= base_url('assets/img/gambar_produk/') . $row->gambar ?>">
                                <img class="img-fluid w-100 height-100px" src="<?= base_url('assets/img/gambar_produk/') . 'thumb_' . $row->gambar ?>" alt="" />
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-12 col-xl-6 p-1 text-dark">
            <h2 class="fw-bold"><?= $produk->nama_produk ?></h2>
            <div class="text-dark">
                <?= $produk->deskripsi ?>
            </div>
            <h3 class="price fw-bold text-primary pt-3"><?= "Rp. " . number_format($produk->harga) ?></h3>
            <hr class="w-75">
            <h5 class="fw-bold py-3">Available in :</h5>
            <div class="d-flex flex-wrap align-items-center">
                <?php foreach ($marketplace_produk as $row) : ?>
                    <a href="<?= $row->link ?>" target="_blank" class="marketplace-detail p-2 m-1">
                        <img src="<?= base_url() ?>assets/img/marketplace/<?= $row->gambar ?>" alt="">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<style>
    /* Shrink wrap strategy 1 */
    .easyzoom {
        float: left;
    }

    .easyzoom img {
        display: block;
    }


    /* Shrink wrap strategy 2 */
    .easyzoom {
        display: inline-block;
    }

    .easyzoom img {
        vertical-align: bottom;
    }
</style>
