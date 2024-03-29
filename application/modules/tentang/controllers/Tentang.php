<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tentang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        $this->load->model('Tentang_model');

        $this->load->library('form_validation');
        $this->load->library('datatables');
    }


    public function index()
    {
        cek_akses('u');

        $row = $this->Tentang_model->get_by_id();

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tentang/update_action'),
                'id_tentang' => set_value('id_tentang', $row->id_tentang),
                'deskripsi' => set_value('deskripsi', $row->deskripsi),
                'maps' => set_value('maps', $row->maps),
                'alamat' => set_value('alamat', $row->alamat),
                'whatsapp' => set_value('whatsapp', $row->whatsapp),
            );

            $data['judul'] = 'Tentang';
            $this->load->view('templates/header', $data);
            $this->load->view('tentang/tentang_list', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('tentang'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index($this->input->post('id_tentang', TRUE));
        } else {
            $data = array(
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'maps' => $this->input->post('maps', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'whatsapp' => $this->input->post('whatsapp', TRUE),
            );

            $id = $this->input->post('id_tentang', TRUE);
            if ($_FILES['gambar_tentang']['name']) {
                $data['gambar_tentang'] = _upload('gambar_tentang', 'tentang/update/' . $id, 'tentang');
                delImage('tentang', $id, 'gambar_tentang');
            }

            $this->Tentang_model->update($this->input->post('id_tentang', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('tentang'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
        $this->form_validation->set_rules('maps', 'maps', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('whatsapp', 'whatsapp', 'trim|required');

        $this->form_validation->set_rules('id_tentang', 'id_tentang', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Tentang.php */
                        /* Location: ./application/modules/D:\xampp\htdocs\malayuhijab\application/modules//controllers/Tentang.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2022-07-16 21:09:07 */
                        /* http://harviacode.com */
