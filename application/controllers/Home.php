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
        $data['judul'] = "";
        $data['products'] = $this->Produk_model->get_all();

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
