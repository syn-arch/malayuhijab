<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Website extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        $this->load->model('Website_model');

        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        cek_akses('u');

        $row = $this->Website_model->get_by_id();

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('website/update_action'),
                'id_website' => set_value('id_website', $row->id_website),
                'nama_website' => set_value('nama_website', $row->nama_website),
                'logo' => set_value('logo', $row->logo),
                'deskripsi' => set_value('deskripsi', $row->deskripsi),
                'deskripsi_service' => set_value('deskripsi_service', $row->deskripsi_service),
                'deskripsi_testimoni' => set_value('deskripsi_testimoni', $row->deskripsi_testimoni),
                'gambar_tentang' => set_value('gambar_tentang', $row->gambar_tentang),
                'gambar_kontak' => set_value('gambar_kontak', $row->gambar_kontak),
            );

            $data['judul'] = 'Pengaturan Website';
            $this->load->view('templates/header', $data);
            $this->load->view('website/website_list', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('website'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index($this->input->post('id_website', TRUE));
        } else {
            $data = array(
                'nama_website' => $this->input->post('nama_website', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'deskripsi_service' => $this->input->post('deskripsi_service', TRUE),
                'deskripsi_testimoni' => $this->input->post('deskripsi_testimoni', TRUE),
            );

            $id = $this->input->post('id_website', TRUE);
            if ($_FILES['logo']['name']) {
                $data['logo'] = _upload('logo', 'website', 'website');
                delImage('website', $id, 'logo');
            }

            if ($_FILES['gambar_tentang']['name']) {
                $data['gambar_tentang'] = _upload('gambar_tentang', 'website', 'website');
                delImage('website', $id, 'gambar_tentang');
            }

            if ($_FILES['gambar_kontak']['name']) {
                $data['gambar_kontak'] = _upload('gambar_kontak', 'website', 'website');
                delImage('website', $id, 'gambar_kontak');
            }

            $this->Website_model->update($this->input->post('id_website', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('website'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_website', 'nama website', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
        $this->form_validation->set_rules('deskripsi_service', 'deskripsi service', 'trim|required');
        $this->form_validation->set_rules('deskripsi_testimoni', 'deskripsi testimoni', 'trim|required');

        $this->form_validation->set_rules('id_website', 'id_website', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
