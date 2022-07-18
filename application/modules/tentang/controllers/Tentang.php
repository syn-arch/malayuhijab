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
                $data['judul'] = 'Data Tentang';

                $this->load->view('templates/header', $data);
                $this->load->view('tentang/tentang_list', $data);
                $this->load->view('templates/footer', $data);
            } 

            public function json() {
                header('Content-Type: application/json');
                echo $this->Tentang_model->json();
            }

    public function read($id) 
        {
            $row = $this->Tentang_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_tentang' => $row->id_tentang,
		'deskripsi' => $row->deskripsi,
		'maps' => $row->maps,
		'alamat' => $row->alamat,
		'whatsapp' => $row->whatsapp,
	    );


                $data['judul'] = 'Detail Tentang';

                $this->load->view('templates/header', $data);
                $this->load->view('tentang/tentang_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('tentang'));
                }
            }

            public function hapus_bulk()
            {
                cek_akses('d');
                
                foreach($_POST['data'] as $id)
                {
                     delImage('tentang', $id, 'gambar_tentang');
$this->db->delete('tentang', ['id_tentang' => $id]);
                }
            }

            public function create() 
            {
                cek_akses('c');

                $data = array(
                'button' => 'Create',
                'action' => site_url('tentang/create_action'),
	    'id_tentang' => set_value('id_tentang'),
	    'deskripsi' => set_value('deskripsi'),
	    'maps' => set_value('maps'),
	    'alamat' => set_value('alamat'),
	    'whatsapp' => set_value('whatsapp'),
	);

                $data['judul'] = 'Tambah Tentang';
                $this->load->view('templates/header', $data);
                $this->load->view('tentang/tentang_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'maps' => $this->input->post('maps',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'whatsapp' => $this->input->post('whatsapp',TRUE),
	    );

                        $this->Tentang_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('tentang'));
                    }
                }

                public function update($id) 
                {
                    cek_akses('u');

                    $row = $this->Tentang_model->get_by_id($id);

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

                        $data['judul'] = 'Ubah Tentang';
$this->load->view('templates/header', $data);
                        $this->load->view('tentang/tentang_form', $data);
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
                            $this->update($this->input->post('id_tentang', TRUE));
                            } else {
                                $data = array(
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'maps' => $this->input->post('maps',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'whatsapp' => $this->input->post('whatsapp',TRUE),
	    ); 

                                    $id = $this->input->post('id_tentang', TRUE);
                                    if($_FILES['gambar_tentang']['name']) {
                                        $data['gambar_tentang'] = _upload('gambar_tentang', 'tentang/update/' . $id, 'tentang');
                                        delImage('tentang', $id, 'gambar_tentang');
                                    }

                                $this->Tentang_model->update($this->input->post('id_tentang', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('tentang'));
                            }
                        }

                        public function delete($id) 
                        {
                            cek_akses('d');
                            delImage('tentang', $id, 'gambar_tentang');
$row = $this->Tentang_model->get_by_id($id);

                            if ($row) {
                                $this->Tentang_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('tentang'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
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