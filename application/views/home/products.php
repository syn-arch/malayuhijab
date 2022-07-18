  <div class="container py-5">
      <div class="py-5 d-flex w-100 justify-content-between align-items-center">
          <?php if ($q = $this->input->get('q')) : ?>
              <div class="py-5">
                  <h3 class="">Search result for: <b>"<?= $q ?>"</b></h3>
                  <p class=""><?= $count ?> Items found</p>
              </div>
          <?php endif ?>
          <?php if (!$this->input->get('q')) : ?>
              <div class="filter d-flex justify-content-between align-items-center">
                  <select class="form-select form-select-md filter-products" aria-label=".form-select-md example">
                      <option>Sort by:</option>
                      <option value="terbaru">Terbaru</option>
                      <option value="tertinggi">Tertinggi</option>
                      <option value="terendah">Terendah</option>
                  </select>
                  <div class="hl mx-3"></div>
                  <i class="fa-solid fa-arrow-down-a-z"></i>
              </div>
          <?php endif ?>
      </div>
      <div class="row">
          <?php foreach ($products as $row) : ?>
              <div class="col-6 col-md-3 my-2">
                  <div class="card border-0">
                      <a href="<?= base_url('home/detail/') . $row->slug ?>" class="text-decoration-none">
                          <img src="<?= base_url() ?>assets/img/produk/<?= $row->thumbnail ?>" class="card-img-top rounded" alt="..." />
                          <div class="card-body p-1">
                              <h6 class="fw-bold my-2 text-decoration-none text-dark"><?= $row->nama_produk ?></h6>
                              <h4 class="card-text fw-light text-dark text-decoration-none"><?= "Rp. " . number_format($row->harga) ?></h4>
                          </div>
                      </a>
                  </div>
              </div>
          <?php endforeach; ?>
      </div>
      <div class="row mt-4">
          <div class="col-md-12">
              <?php echo $pagination; ?>
          </div>
      </div>
  </div>
