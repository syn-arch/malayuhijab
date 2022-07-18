<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Sosial_media extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        $this->load->model('Sosial_media_model');
        
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
            {
                $data['judul'] = 'Data Sosial Media';

                $this->load->view('templates/header', $data);
                $this->load->view('sosial_media/sosial_media_list', $data);
                $this->load->view('templates/footer', $data);
            } 

            public function json() {
                header('Content-Type: application/json');
                echo $this->Sosial_media_model->json();
            }

    public function read($id) 
        {
            $row = $this->Sosial_media_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_sosial_media' => $row->id_sosial_media,
		'nama_sosial_media' => $row->nama_sosial_media,
		'link' => $row->link,
		'gambar' => $row->gambar,
	    );


                $data['judul'] = 'Detail Sosial Media';

                $this->load->view('templates/header', $data);
                $this->load->view('sosial_media/sosial_media_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('sosial_media'));
                }
            }

            public function hapus_bulk()
            {
                cek_akses('d');
                
                foreach($_POST['data'] as $id)
                {
                    
$this->db->delete('sosial_media', ['id_sosial_media' => $id]);
                }
            }

            public function create() 
            {
                cek_akses('c');

                $data = array(
                'button' => 'Create',
                'action' => site_url('sosial_media/create_action'),
	    'id_sosial_media' => set_value('id_sosial_media'),
	    'nama_sosial_media' => set_value('nama_sosial_media'),
	    'link' => set_value('link'),
	    'gambar' => set_value('gambar'),
	);

                $data['judul'] = 'Tambah Sosial Media';
                $this->load->view('templates/header', $data);
                $this->load->view('sosial_media/sosial_media_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'nama_sosial_media' => $this->input->post('nama_sosial_media',TRUE),
		'link' => $this->input->post('link',TRUE),
		'gambar' => $this->input->post('gambar',TRUE),
	    );

                        $this->Sosial_media_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('sosial_media'));
                    }
                }

                public function update($id) 
                {
                    cek_akses('u');

                    $row = $this->Sosial_media_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('sosial_media/update_action'),
		'id_sosial_media' => set_value('id_sosial_media', $row->id_sosial_media),
		'nama_sosial_media' => set_value('nama_sosial_media', $row->nama_sosial_media),
		'link' => set_value('link', $row->link),
		'gambar' => set_value('gambar', $row->gambar),
	    );

                        $data['judul'] = 'Ubah Sosial Media';
$this->load->view('templates/header', $data);
                        $this->load->view('sosial_media/sosial_media_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('sosial_media'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_sosial_media', TRUE));
                            } else {
                                $data = array(
		'nama_sosial_media' => $this->input->post('nama_sosial_media',TRUE),
		'link' => $this->input->post('link',TRUE),
		'gambar' => $this->input->post('gambar',TRUE),
	    );

                                $this->Sosial_media_model->update($this->input->post('id_sosial_media', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('sosial_media'));
                            }
                        }

                        public function delete($id) 
                        {
                            cek_akses('d');
                            $row = $this->Sosial_media_model->get_by_id($id);

                            if ($row) {
                                $this->Sosial_media_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('sosial_media'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('sosial_media'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('nama_sosial_media', 'nama sosial media', 'trim|required');
	$this->form_validation->set_rules('link', 'link', 'trim|required');
	$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');

	$this->form_validation->set_rules('id_sosial_media', 'id_sosial_media', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Sosial_media.php */
                        /* Location: ./application/modules/C:\xampp\htdocs\malayuhijab\application/modules//controllers/Sosial_media.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2022-07-18 19:47:09 */
                        /* http://harviacode.com */