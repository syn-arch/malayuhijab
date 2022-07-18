<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Marketplace extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        $this->load->model('Marketplace_model');
        
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
            {
                $data['judul'] = 'Data Marketplace';

                $this->load->view('templates/header', $data);
                $this->load->view('marketplace/marketplace_list', $data);
                $this->load->view('templates/footer', $data);
            } 

            public function json() {
                header('Content-Type: application/json');
                echo $this->Marketplace_model->json();
            }

    public function read($id) 
        {
            $row = $this->Marketplace_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_marketplace' => $row->id_marketplace,
		'nama_marketplace' => $row->nama_marketplace,
		'deskripsi' => $row->deskripsi,
		'gambar' => $row->gambar,
		'link_marketplace' => $row->link_marketplace,
	    );


                $data['judul'] = 'Detail Marketplace';

                $this->load->view('templates/header', $data);
                $this->load->view('marketplace/marketplace_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('marketplace'));
                }
            }

            public function hapus_bulk()
            {
                cek_akses('d');
                
                foreach($_POST['data'] as $id)
                {
                     delImage('marketplace', $id, 'gambar');
$this->db->delete('marketplace', ['id_marketplace' => $id]);
                }
            }

            public function create() 
            {
                cek_akses('c');

                $data = array(
                'button' => 'Create',
                'action' => site_url('marketplace/create_action'),
	    'id_marketplace' => set_value('id_marketplace'),
	    'nama_marketplace' => set_value('nama_marketplace'),
	    'deskripsi' => set_value('deskripsi'),
	    'gambar' => set_value('gambar'),
	    'link_marketplace' => set_value('link_marketplace'),
	);

                $data['judul'] = 'Tambah Marketplace';
                $this->load->view('templates/header', $data);
                $this->load->view('marketplace/marketplace_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'nama_marketplace' => $this->input->post('nama_marketplace',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'gambar' => _upload('gambar', 'marketplace/create', 'marketplace'),
		'link_marketplace' => $this->input->post('link_marketplace',TRUE),
	    );

                        $this->Marketplace_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('marketplace'));
                    }
                }

                public function update($id) 
                {
                    cek_akses('u');

                    $row = $this->Marketplace_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('marketplace/update_action'),
		'id_marketplace' => set_value('id_marketplace', $row->id_marketplace),
		'nama_marketplace' => set_value('nama_marketplace', $row->nama_marketplace),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'gambar' => set_value('gambar', $row->gambar),
		'link_marketplace' => set_value('link_marketplace', $row->link_marketplace),
	    );

                        $data['judul'] = 'Ubah Marketplace';
$this->load->view('templates/header', $data);
                        $this->load->view('marketplace/marketplace_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('marketplace'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_marketplace', TRUE));
                            } else {
                                $data = array(
		'nama_marketplace' => $this->input->post('nama_marketplace',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'link_marketplace' => $this->input->post('link_marketplace',TRUE),
	    ); 

                                    $id = $this->input->post('id_marketplace', TRUE);
                                    if($_FILES['gambar']['name']) {
                                        $data['gambar'] = _upload('gambar', 'marketplace/update/' . $id, 'marketplace');
                                        delImage('marketplace', $id, 'gambar');
                                    }

                                $this->Marketplace_model->update($this->input->post('id_marketplace', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('marketplace'));
                            }
                        }

                        public function delete($id) 
                        {
                            cek_akses('d');
                            delImage('marketplace', $id, 'gambar');
$row = $this->Marketplace_model->get_by_id($id);

                            if ($row) {
                                $this->Marketplace_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('marketplace'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('marketplace'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('nama_marketplace', 'nama marketplace', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('link_marketplace', 'link marketplace', 'trim|required');

	$this->form_validation->set_rules('id_marketplace', 'id_marketplace', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Marketplace.php */
                        /* Location: ./application/modules/C:\xampp\htdocs\malayuhijab\application/modules//controllers/Marketplace.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2022-07-18 20:09:41 */
                        /* http://harviacode.com */