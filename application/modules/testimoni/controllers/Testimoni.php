<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Testimoni extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        $this->load->model('Testimoni_model');
        
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
            {
                $data['judul'] = 'Data Testimoni';

                $this->load->view('templates/header', $data);
                $this->load->view('testimoni/testimoni_list', $data);
                $this->load->view('templates/footer', $data);
            } 

            public function json() {
                header('Content-Type: application/json');
                echo $this->Testimoni_model->json();
            }

    public function read($id) 
        {
            $row = $this->Testimoni_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_testimoni' => $row->id_testimoni,
		'nama_testimoni' => $row->nama_testimoni,
		'deskripsi' => $row->deskripsi,
		'gambar' => $row->gambar,
	    );


                $data['judul'] = 'Detail Testimoni';

                $this->load->view('templates/header', $data);
                $this->load->view('testimoni/testimoni_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('testimoni'));
                }
            }

            public function hapus_bulk()
            {
                cek_akses('d');
                
                foreach($_POST['data'] as $id)
                {
                    
$this->db->delete('testimoni', ['id_testimoni' => $id]);
                }
            }

            public function create() 
            {
                cek_akses('c');

                $data = array(
                'button' => 'Create',
                'action' => site_url('testimoni/create_action'),
	    'id_testimoni' => set_value('id_testimoni'),
	    'nama_testimoni' => set_value('nama_testimoni'),
	    'deskripsi' => set_value('deskripsi'),
	    'gambar' => set_value('gambar'),
	);

                $data['judul'] = 'Tambah Testimoni';
                $this->load->view('templates/header', $data);
                $this->load->view('testimoni/testimoni_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'nama_testimoni' => $this->input->post('nama_testimoni',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'gambar' => $this->input->post('gambar',TRUE),
	    );

                        $this->Testimoni_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('testimoni'));
                    }
                }

                public function update($id) 
                {
                    cek_akses('u');

                    $row = $this->Testimoni_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('testimoni/update_action'),
		'id_testimoni' => set_value('id_testimoni', $row->id_testimoni),
		'nama_testimoni' => set_value('nama_testimoni', $row->nama_testimoni),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'gambar' => set_value('gambar', $row->gambar),
	    );

                        $data['judul'] = 'Ubah Testimoni';
$this->load->view('templates/header', $data);
                        $this->load->view('testimoni/testimoni_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('testimoni'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_testimoni', TRUE));
                            } else {
                                $data = array(
		'nama_testimoni' => $this->input->post('nama_testimoni',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'gambar' => $this->input->post('gambar',TRUE),
	    );

                                $this->Testimoni_model->update($this->input->post('id_testimoni', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('testimoni'));
                            }
                        }

                        public function delete($id) 
                        {
                            cek_akses('d');
                            $row = $this->Testimoni_model->get_by_id($id);

                            if ($row) {
                                $this->Testimoni_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('testimoni'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('testimoni'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('nama_testimoni', 'nama testimoni', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');

	$this->form_validation->set_rules('id_testimoni', 'id_testimoni', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Testimoni.php */
                        /* Location: ./application/modules/D:\xampp\htdocs\malayuhijab\application/modules//controllers/Testimoni.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2022-07-16 21:10:28 */
                        /* http://harviacode.com */