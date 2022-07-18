  <div class="container py-5">
      <div class="py-5 d-flex w-100 justify-content-between align-items-center">
          <div class="filter d-flex justify-content-between align-items-center">
              <select class="form-select form-select-md" aria-label=".form-select-md example">
                  <option selected>Sort by:</option>
                  <option value="terbaru">Terbaru</option>
                  <option value="tertinggi">Tertinggi</option>
                  <option value="terendah">Terendah</option>
              </select>
              <div class="hl mx-3"></div>
              <i class="fa-solid fa-arrow-down-a-z"></i>
          </div>
      </div>
      <div class="row">
          <?php foreach ($products as $row) : ?>
              <div class="col-6 col-md-3 my-2">
                  <div class="card border-0">
                      <img src="<?= base_url() ?>assets/img/produk/<?= $row->thumbnail ?>" class="card-img-top rounded" alt="..." />
                      <div class="card-body p-1">
                          <a href="<?= base_url('home/detail/') . $row->slug ?>">
                              <h6 class="fw-bold my-2"><?= $row->nama_produk ?></h6>
                          </a>
                          <h4 class="card-text fw-light"><?= "Rp. " . number_format($row->harga) ?></h4>
                      </div>
                  </div>
              </div>
          <?php endforeach; ?>
      </div>
  </div>
