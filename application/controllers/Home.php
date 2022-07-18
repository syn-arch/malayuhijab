<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('produk/Produk_model');
    }

    public function index()
    {
        $data['judul'] = "";

        $this->load->view('home/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('home/footer', $data);
    }

    public function about()
    {
        $data['judul'] = "";
        $this->load->view('home/header', $data);
        $this->load->view('home/about', $data);
        $this->load->view('home/footer', $data);
    }

    public function contact()
    {
        $data['judul'] = "";
        $this->load->view('home/header', $data);
        $this->load->view('home/contact', $data);
        $this->load->view('home/footer', $data);
    }

    public function send_message()
    {
        $get = $this->input->get();
        $whatsapp = $this->db->get('tentang')->row()->whatsapp;

        $message  = "Nama : " . $get['name'] . "%0a";
        $message .= "Email : " . $get['email'] . "%0a";
        $message .= "Phone Number : " . $get['phone'] . "%0a";
        $message .= "Message : " . $get['message'] . "%0a";
        $url = "https://api.whatsapp.com/send?phone=$whatsapp&text=$message";

        return redirect($url);
    }

    public function products()
    {
        $q = $this->input->get('q');
        //konfigurasi pagination
        $config['base_url'] = site_url('home/products'); //site url

        if ($q) {
            $this->db->like('nama_produk', $q, 'both');
            $config['total_rows'] = $this->db->get('produk')->num_rows();
        } else {
            $config['total_rows'] = $this->db->count_all('produk'); //total row
        }

        $config['per_page'] = 8;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        $config['reuse_query_string'] = true;
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if ($q) {
            $data['products'] = $this->Produk_model->get_produk_list($config["per_page"], $data['page'], $q);
            $data['count'] = $config['total_rows'];
        } else {
            $data['products'] = $this->Produk_model->get_produk_list($config["per_page"], $data['page']);
        }

        $data['pagination'] = $this->pagination->create_links();

        //load view produk view
        $this->load->view('home/header', $data);
        $this->load->view('home/products', $data);
        $this->load->view('home/footer', $data);
    }

    public function detail($slug)
    {
        $data['judul'] = "";
        $data['produk'] = $this->Produk_model->get_by_slug($slug);

        $data['gambar_produk'] = $this->Produk_model->get_gambar_produk($data['produk']->id_produk);
        $data['marketplace_produk'] = $this->Produk_model->get_marketplace_produk($data['produk']->id_produk);

        $this->load->view('home/header', $data);
        $this->load->view('home/detail', $data);
        $this->load->view('home/footer', $data);
    }
}
