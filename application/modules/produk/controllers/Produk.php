<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        $this->load->model('Produk_model');
        $this->load->model('marketplace/Marketplace_model');

        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['judul'] = 'Data Produk';

        $this->load->view('templates/header', $data);
        $this->load->view('produk/produk_list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Produk_model->json();
    }

    public function read($id)
    {
        $row = $this->Produk_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_produk' => $row->id_produk,
                'nama_produk' => $row->nama_produk,
                'slug' => $row->slug,
                'deskripsi' => $row->deskripsi,
                'harga' => $row->harga,
                'thumbnail' => $row->thumbnail,
            );


            $data['judul'] = 'Detail Produk';

            $this->load->view('templates/header', $data);
            $this->load->view('produk/produk_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('produk'));
        }
    }

    public function hapus_bulk()
    {
        cek_akses('d');

        foreach ($_POST['data'] as $id) {
            delImage('produk', $id, 'thumbnail');
            $this->db->delete('produk', ['id_produk' => $id]);
        }
    }

    public function create()
    {
        cek_akses('c');

        $data = array(
            'button' => 'Create',
            'action' => site_url('produk/create_action'),
            'id_produk' => set_value('id_produk'),
            'nama_produk' => set_value('nama_produk'),
            'deskripsi' => set_value('deskripsi'),
            'harga' => set_value('harga'),
            'thumbnail' => set_value('thumbnail'),
        );

        $data['judul'] = 'Tambah Produk';
        $this->load->view('templates/header', $data);
        $this->load->view('produk/produk_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_produk' => $this->input->post('nama_produk', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'thumbnail' => _upload('thumbnail', 'produk/create', 'produk'),
            );

            $data['slug'] = slugify($this->input->post('nama_produk', TRUE));

            $this->Produk_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('produk'));
        }
    }

    public function update($id)
    {
        cek_akses('u');

        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('produk/update_action'),
                'id_produk' => set_value('id_produk', $row->id_produk),
                'nama_produk' => set_value('nama_produk', $row->nama_produk),
                'deskripsi' => set_value('deskripsi', $row->deskripsi),
                'harga' => set_value('harga', $row->harga),
                'thumbnail' => set_value('thumbnail', $row->thumbnail),
            );

            $data['judul'] = 'Ubah Produk';
            $data['gambar_produk'] = $this->Produk_model->get_gambar_produk($id);
            $data['marketplace_produk'] = $this->Produk_model->get_marketplace_produk($id);

            $this->load->view('templates/header', $data);
            $this->load->view('produk/produk_form', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('produk'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_produk', TRUE));
        } else {
            $data = array(
                'nama_produk' => $this->input->post('nama_produk', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'harga' => $this->input->post('harga', TRUE),
            );

            $data['slug'] = slugify($this->input->post('nama_produk', TRUE));


            $id = $this->input->post('id_produk', TRUE);
            if ($_FILES['thumbnail']['name']) {
                $data['thumbnail'] = _upload('thumbnail', 'produk/update/' . $id, 'produk');
                delImage('produk', $id, 'thumbnail');
            }

            $this->Produk_model->update($this->input->post('id_produk', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('produk'));
        }
    }

    public function delete($id)
    {
        cek_akses('d');
        delImage('produk', $id, 'thumbnail');
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $this->Produk_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('produk'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('produk'));
        }
    }

    public function resizeImage($filename)
    {
        $source_path = './assets/img/gambar_produk/' . $filename;
        $target_path = './assets/img/gambar_produk/';
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'width' => 200,
        );

        $this->image_lib->initialize($config_manip);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    public function tambah_gambar($id)
    {
        $valid = $this->form_validation;
        $valid->set_rules('req', 'req', 'trim|required');

        if ($valid->run() == TRUE) {

            $this->db->insert('gambar_produk', [
                'id_produk' => $id,
                'gambar' => _upload('gambar', 'produk/update/' . $id, 'gambar_produk'),
            ]);

            $thumb = _upload_thumbnail('gambar', 'produk/update/' . $id, 'gambar_produk');

            rename(
                $thumb['full_path'],
                $thumb['file_path'] . '/' . 'thumb' . '_' . $thumb['orig_name']
            );

            $this->resizeImage('thumb_' . $thumb['orig_name']);

            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('produk/update/' . $id));
        }

        $data['judul'] = 'Tambah Gambar';

        $this->load->view('templates/header', $data);
        $this->load->view('produk/produk_gambar_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapus_gambar_produk($id_gambar_produk, $id)
    {
        delImage('gambar_produk', $id_gambar_produk, 'gambar');
        delImageThumb('gambar_produk', $id_gambar_produk, 'gambar');

        $this->db->delete('gambar_produk', ['id_gambar_produk' => $id_gambar_produk]);
        $this->session->set_flashdata('success', 'Dihapus');
        redirect(site_url('produk/update/' . $id));
    }

    public function tambah_marketplace($id)
    {
        $valid = $this->form_validation;
        $valid->set_rules('id_marketplace', 'id_marketplace', 'trim|required');
        $valid->set_rules('link', 'link', 'trim|required');
        if ($valid->run() == TRUE) {
            $this->db->insert('marketplace_produk', [
                'id_produk' => $id,
                'id_marketplace' => $this->input->post('id_marketplace', TRUE),
                'link' => $this->input->post('link', TRUE),
            ]);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('produk/update/' . $id));
        }

        $data['judul'] = 'Tambah marketplace';
        $data['marketplace'] = $this->Marketplace_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('produk/produk_marketplace_tambah', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ubah_marketplace($id, $id_produk)
    {
        $valid = $this->form_validation;
        $valid->set_rules('id_marketplace', 'id_marketplace', 'trim|required');
        $valid->set_rules('link', 'link', 'trim|required');
        if ($valid->run() == TRUE) {
            $this->db->where('id_marketplace_produk', $id);
            $this->db->update('marketplace_produk', [
                'id_marketplace' => $this->input->post('id_marketplace', TRUE),
                'link' => $this->input->post('link', TRUE),
            ]);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('produk/update/' . $id_produk));
        }

        $data['judul'] = 'Ubah marketplace';
        $data['mp'] = $this->Produk_model->get_marketplace_produk_by_id($id);
        $data['marketplace'] = $this->Marketplace_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('produk/produk_marketplace_ubah', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapus_marketplace_produk($id_marketplace_produk, $id)
    {
        $this->db->delete(
            'marketplace_produk',
            ['id_marketplace_produk' => $id_marketplace_produk]
        );
        $this->session->set_flashdata('success', 'Dihapus');
        redirect(site_url('produk/update/' . $id));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_produk', 'nama produk', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
        $this->form_validation->set_rules('harga', 'harga', 'trim|required|numeric');

        $this->form_validation->set_rules('id_produk', 'id_produk', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
