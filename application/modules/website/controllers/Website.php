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
                $data['judul'] = 'Data Website';

                $this->load->view('templates/header', $data);
                $this->load->view('website/website_list', $data);
                $this->load->view('templates/footer', $data);
            } 

            public function json() {
                header('Content-Type: application/json');
                echo $this->Website_model->json();
            }

    public function read($id) 
        {
            $row = $this->Website_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_website' => $row->id_website,
		'nama_website' => $row->nama_website,
		'deskripsi' => $row->deskripsi,
		'deskripsi_service' => $row->deskripsi_service,
		'deskripsi_testimoni' => $row->deskripsi_testimoni,
		'gambar_tentang' => $row->gambar_tentang,
		'gambar_kontak' => $row->gambar_kontak,
	    );


                $data['judul'] = 'Detail Website';

                $this->load->view('templates/header', $data);
                $this->load->view('website/website_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('website'));
                }
            }

            public function hapus_bulk()
            {
                cek_akses('d');
                
                foreach($_POST['data'] as $id)
                {
                     delImage('website', $id, 'gambar_tentang');
$this->db->delete('website', ['id_website' => $id]);
                }
            }

            public function create() 
            {
                cek_akses('c');

                $data = array(
                'button' => 'Create',
                'action' => site_url('website/create_action'),
	    'id_website' => set_value('id_website'),
	    'nama_website' => set_value('nama_website'),
	    'deskripsi' => set_value('deskripsi'),
	    'deskripsi_service' => set_value('deskripsi_service'),
	    'deskripsi_testimoni' => set_value('deskripsi_testimoni'),
	    'gambar_tentang' => set_value('gambar_tentang'),
	    'gambar_kontak' => set_value('gambar_kontak'),
	);

                $data['judul'] = 'Tambah Website';
                $this->load->view('templates/header', $data);
                $this->load->view('website/website_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'nama_website' => $this->input->post('nama_website',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'deskripsi_service' => $this->input->post('deskripsi_service',TRUE),
		'deskripsi_testimoni' => $this->input->post('deskripsi_testimoni',TRUE),
		'gambar_tentang' => _upload('gambar_tentang', 'website/create', 'website'),
		'gambar_kontak' => $this->input->post('gambar_kontak',TRUE),
	    );

                        $this->Website_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('website'));
                    }
                }

                public function update($id) 
                {
                    cek_akses('u');

                    $row = $this->Website_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('website/update_action'),
		'id_website' => set_value('id_website', $row->id_website),
		'nama_website' => set_value('nama_website', $row->nama_website),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'deskripsi_service' => set_value('deskripsi_service', $row->deskripsi_service),
		'deskripsi_testimoni' => set_value('deskripsi_testimoni', $row->deskripsi_testimoni),
		'gambar_tentang' => set_value('gambar_tentang', $row->gambar_tentang),
		'gambar_kontak' => set_value('gambar_kontak', $row->gambar_kontak),
	    );

                        $data['judul'] = 'Ubah Website';
$this->load->view('templates/header', $data);
                        $this->load->view('website/website_form', $data);
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
                            $this->update($this->input->post('id_website', TRUE));
                            } else {
                                $data = array(
		'nama_website' => $this->input->post('nama_website',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'deskripsi_service' => $this->input->post('deskripsi_service',TRUE),
		'deskripsi_testimoni' => $this->input->post('deskripsi_testimoni',TRUE),
		'gambar_kontak' => $this->input->post('gambar_kontak',TRUE),
	    ); 

                                    $id = $this->input->post('id_website', TRUE);
                                    if($_FILES['gambar_tentang']['name']) {
                                        $data['gambar_tentang'] = _upload('gambar_tentang', 'website/update/' . $id, 'website');
                                        delImage('website', $id, 'gambar_tentang');
                                    }

                                $this->Website_model->update($this->input->post('id_website', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('website'));
                            }
                        }

                        public function delete($id) 
                        {
                            cek_akses('d');
                            delImage('website', $id, 'gambar_tentang');
$row = $this->Website_model->get_by_id($id);

                            if ($row) {
                                $this->Website_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('website'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('website'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('nama_website', 'nama website', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('deskripsi_service', 'deskripsi service', 'trim|required');
	$this->form_validation->set_rules('deskripsi_testimoni', 'deskripsi testimoni', 'trim|required');
	$this->form_validation->set_rules('gambar_kontak', 'gambar kontak', 'trim|required');

	$this->form_validation->set_rules('id_website', 'id_website', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Website.php */
                        /* Location: ./application/modules/D:\xampp\htdocs\malayuhijab\application/modules//controllers/Website.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2022-07-16 21:08:47 */
                        /* http://harviacode.com */