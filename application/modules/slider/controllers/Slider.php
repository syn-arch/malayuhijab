<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Slider extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        $this->load->model('Slider_model');
        
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
            {
                $data['judul'] = 'Data Slider';

                $this->load->view('templates/header', $data);
                $this->load->view('slider/slider_list', $data);
                $this->load->view('templates/footer', $data);
            } 

            public function json() {
                header('Content-Type: application/json');
                echo $this->Slider_model->json();
            }

    public function read($id) 
        {
            $row = $this->Slider_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_slider' => $row->id_slider,
		'keterangan' => $row->keterangan,
		'gambar' => $row->gambar,
	    );


                $data['judul'] = 'Detail Slider';

                $this->load->view('templates/header', $data);
                $this->load->view('slider/slider_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('slider'));
                }
            }

            public function hapus_bulk()
            {
                cek_akses('d');
                
                foreach($_POST['data'] as $id)
                {
                     delImage('slider', $id, 'gambar');
$this->db->delete('slider', ['id_slider' => $id]);
                }
            }

            public function create() 
            {
                cek_akses('c');

                $data = array(
                'button' => 'Create',
                'action' => site_url('slider/create_action'),
	    'id_slider' => set_value('id_slider'),
	    'keterangan' => set_value('keterangan'),
	    'gambar' => set_value('gambar'),
	);

                $data['judul'] = 'Tambah Slider';
                $this->load->view('templates/header', $data);
                $this->load->view('slider/slider_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'keterangan' => $this->input->post('keterangan',TRUE),
		'gambar' => _upload('gambar', 'slider/create', 'slider'),
	    );

                        $this->Slider_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('slider'));
                    }
                }

                public function update($id) 
                {
                    cek_akses('u');

                    $row = $this->Slider_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('slider/update_action'),
		'id_slider' => set_value('id_slider', $row->id_slider),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'gambar' => set_value('gambar', $row->gambar),
	    );

                        $data['judul'] = 'Ubah Slider';
$this->load->view('templates/header', $data);
                        $this->load->view('slider/slider_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('slider'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_slider', TRUE));
                            } else {
                                $data = array(
		'keterangan' => $this->input->post('keterangan',TRUE),
	    ); 

                                    $id = $this->input->post('id_slider', TRUE);
                                    if($_FILES['gambar']['name']) {
                                        $data['gambar'] = _upload('gambar', 'slider/update/' . $id, 'slider');
                                        delImage('slider', $id, 'gambar');
                                    }

                                $this->Slider_model->update($this->input->post('id_slider', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('slider'));
                            }
                        }

                        public function delete($id) 
                        {
                            cek_akses('d');
                            delImage('slider', $id, 'gambar');
$row = $this->Slider_model->get_by_id($id);

                            if ($row) {
                                $this->Slider_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('slider'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('slider'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_slider', 'id_slider', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Slider.php */
                        /* Location: ./application/modules/C:\xampp\htdocs\malayuhijab\application/modules//controllers/Slider.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2022-07-18 19:41:10 */
                        /* http://harviacode.com */