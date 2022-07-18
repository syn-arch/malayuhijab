<?php $tentang = $this->db->get('tentang')->row() ?>
<?php $website = $this->db->get('website')->row() ?>
<div class="hero text-light" style="background-image: url(<?= base_url('assets/img/website/') . $website->gambar_kontak ?>)">
    <div class="overlay">
    </div>
</div>
<div class="container py-5">
    <h1 class="fw-bold text-center">Contact Us</h1>
    <p class="text-center">
    </p>
    <div class="row justify-content-center py-5">
        <div class="col-8">
            <form action="<?= base_url('home/send_message') ?>">
                <fieldset class="form-group">
                    <label class="fw-bold py-2" for="fullname">Name </label>
                    <input type="text" class="form-control" id="fullname" placeholder="Your full name" name="name">
                </fieldset>
                <fieldset class="form-group">
                    <label class="fw-bold py-2" for="email">Email </label>
                    <input type="email" class="form-control" id="email" placeholder="Your email" name="email">
                </fieldset>
                <fieldset class="form-group">
                    <label class="fw-bold py-2" for="email">Phone </label>
                    <input type="text" class="form-control" id="email" placeholder="Your phone number" name="phone">
                </fieldset>
                <fieldset class="form-group">
                    <label class="fw-bold py-2" for="email">Message </label>
                    <textarea class="form-control" cols="10" rows="10" placeholder="Your message here" name="message"></textarea>
                </fieldset>
                <button class="btn btn-primary btn-block my-3 py-2 w-100">Submit</button>
            </form>
        </div>
    </div>
</div>
