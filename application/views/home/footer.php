    <?php $website = $this->db->get('website')->row(); ?>

    <div class="footer bg-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h1 class="fw-bold">
                        <?= $website->nama_website ?>
                    </h1>
                    <p>
                        <?= $website->deskripsi ?>
                    </p>
                </div>
                <div class="col-md-3 col-sm-12">
                    <h5>Links</h5>
                    <ul class="list-unstyled footer-link">
                        <li><a href="<?= base_url('home/index') ?>">Home</a></li>
                        <li><a href="<?= base_url('home/index#services') ?>">Services</a></li>
                        <li><a href="<?= base_url('home/index#testimony') ?>">Testimony</a></li>
                        <li><a href="<?= base_url('home/about') ?>">About Us</a></li>
                        <li><a href="<?= base_url('home/products') ?>">Product</a></li>
                        <li><a href="<?= base_url('home/contact') ?>">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-12">
                    <h5>Social Media</h5>
                    <ul class="list-unstyled footer-link">
                        <?php $sosmed = $this->db->get('sosial_media')->result() ?>
                        <?php foreach ($sosmed as $row) : ?>
                            <li><a href="<?= $row->link ?>"><i class="<?= $row->gambar ?>"></i> <?= $row->nama_sosial_media ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('.responsive').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>

    <script src="<?= base_url() ?>assets/js/easyzoom.js"></script>
    <script>
        $('.thumbnails').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            arrows: true,
            draggable: false,
            prevArrow: "<div class='arrow-items bg-light'><i class='fa-solid fa-arrow-left p-3 text-dark'></i></div>",
            nextArrow: "<div class='arrow-items bg-light'><i class='fa-solid fa-arrow-right p-3 text-dark'></i></div>",
        });
        // Instantiate EasyZoom instances
        var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });
    </script>
    <script>
        $(function() {
            $('.filter-products').change(function() {
                const filter = $(this).val()
                window.location.href = `<?= base_url('home/products?filter=') ?>${filter}`
            })
        })
    </script>

    <script src="https://kit.fontawesome.com/783904541b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>

    </html>
