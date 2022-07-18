<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Service extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        $this->load->model('Service_model');
        
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
            {
                $data['judul'] = 'Data Service';

                $this->load->view('templates/header', $data);
                $this->load->view('service/service_list', $data);
                $this->load->view('templates/footer', $data);
            } 

            public function json() {
                header('Content-Type: application/json');
                echo $this->Service_model->json();
            }

    public function read($id) 
        {
            $row = $this->Service_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_service' => $row->id_service,
		'nama_service' => $row->nama_service,
		'deskripsi' => $row->deskripsi,
		'gambar' => $row->gambar,
	    );


                $data['judul'] = 'Detail Service';

                $this->load->view('templates/header', $data);
                $this->load->view('service/service_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('service'));
                }
            }

            public function hapus_bulk()
            {
                cek_akses('d');
                
                foreach($_POST['data'] as $id)
                {
                    
$this->db->delete('service', ['id_service' => $id]);
                }
            }

            public function create() 
            {
                cek_akses('c');

                $data = array(
                'button' => 'Create',
                'action' => site_url('service/create_action'),
	    'id_service' => set_value('id_service'),
	    'nama_service' => set_value('nama_service'),
	    'deskripsi' => set_value('deskripsi'),
	    'gambar' => set_value('gambar'),
	);

                $data['judul'] = 'Tambah Service';
                $this->load->view('templates/header', $data);
                $this->load->view('service/service_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'nama_service' => $this->input->post('nama_service',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'gambar' => $this->input->post('gambar',TRUE),
	    );

                        $this->Service_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('service'));
                    }
                }

                public function update($id) 
                {
                    cek_akses('u');

                    $row = $this->Service_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('service/update_action'),
		'id_service' => set_value('id_service', $row->id_service),
		'nama_service' => set_value('nama_service', $row->nama_service),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'gambar' => set_value('gambar', $row->gambar),
	    );

                        $data['judul'] = 'Ubah Service';
$this->load->view('templates/header', $data);
                        $this->load->view('service/service_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('service'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_service', TRUE));
                            } else {
                                $data = array(
		'nama_service' => $this->input->post('nama_service',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'gambar' => $this->input->post('gambar',TRUE),
	    );

                                $this->Service_model->update($this->input->post('id_service', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('service'));
                            }
                        }

                        public function delete($id) 
                        {
                            cek_akses('d');
                            $row = $this->Service_model->get_by_id($id);

                            if ($row) {
                                $this->Service_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('service'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('service'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('nama_service', 'nama service', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');

	$this->form_validation->set_rules('id_service', 'id_service', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Service.php */
                        /* Location: ./application/modules/D:\xampp\htdocs\malayuhijab\application/modules//controllers/Service.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2022-07-16 21:09:19 */
                        /* http://harviacode.com */