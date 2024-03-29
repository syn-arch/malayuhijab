<?php

$string = "<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class " . $c . " extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        \$this->load->model('$m');
        ";
if ($join) {
    foreach ($table_join as $row) {
        $string .= "\$this->load->model('$row/" . ucfirst($row) . "_model');";
    }
}

$string .= "
        \$this->load->library('form_validation');";

if ($jenis_tabel <> 'reguler_table') {
    $string .= "        \n\t\$this->load->library('datatables');";
}

$string .= "
    }";

if ($jenis_tabel == 'reguler_table') {

    $string .= "\n\npublic function index()
        {
            \$q = urldecode(\$this->input->get('q', TRUE));
            \$start = intval(\$this->input->get('start'));

            if (\$q <> '') {
                \$config['base_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
                \$config['first_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
                } else {
                    \$config['base_url'] = base_url() . '$c_url/index.html';
                    \$config['first_url'] = base_url() . '$c_url/index.html';
                }

                \$config['per_page'] = 10;
                \$config['page_query_string'] = TRUE;
                \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);
                \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q);

                \$this->load->library('pagination');
                \$this->pagination->initialize(\$config);

                \$data = array(
                '" . $c_url . "_data' => \$$c_url,
                'q' => \$q,
                'pagination' => \$this->pagination->create_links(),
                'total_rows' => \$config['total_rows'],
                'start' => \$start,
                );

                \$data['judul'] = 'Data " . ucwords(str_replace('_', ' ', $module)) . "';

                \$this->load->view('templates/header', \$data);
                \$this->load->view('$c_url/$v_list', \$data);
                \$this->load->view('templates/footer', \$data);
            }";
} else {

    $string .= "\n\n    public function index()
            {
                \$data['judul'] = 'Data " . ucwords(str_replace('_', ' ', $module)) . "';

                \$this->load->view('templates/header', \$data);
                \$this->load->view('$c_url/$v_list', \$data);
                \$this->load->view('templates/footer', \$data);
            } 

            public function json() {
                header('Content-Type: application/json');
                echo \$this->" . $m . "->json();
            }";
}

$string .= "\n\n    public function read(\$id) 
        {
            \$row = \$this->" . $m . "->get_by_id(\$id);
            if (\$row) {
                \$data = array(";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$row->" . $row['column_name'] . ",";
}
if ($join) {
    foreach ($table_join as $index => $row) {
        $string .= "\n\t\t'nama_" . $row . "' => \$row->nama_" . $row . ",";
    }
}
$string .= "\n\t    );


                \$data['judul'] = 'Detail " . ucwords(str_replace('_', ' ', $module)) . "';

                \$this->load->view('templates/header', \$data);
                \$this->load->view('$c_url/$v_read', \$data);
                \$this->load->view('templates/footer', \$data);
                } else {
                    \$this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('$c_url'));
                }
            }

            public function hapus_bulk()
            {
                cek_akses('d');
                
                foreach(\$_POST['data'] as \$id)
                {
                    ";
if (isset($_POST['ada_gambar'])) {
    $kolom_gambar = $_POST['kolom_gambar'];
    $string .= " delImage('$table_name', \$id, '$kolom_gambar');";
}
$string .= "\n\$this->db->delete('" . $table_name . "', ['id_" . $table_name . "' => \$id]);
                }
            }

            public function create() 
            {
                cek_akses('c');

                \$data = array(
                'button' => 'Create',
                'action' => site_url('$c_url/create_action'),";
foreach ($all as $row) {
    $string .= "\n\t    '" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
}
$string .= "\n\t);

                \$data['judul'] = 'Tambah " . ucwords(str_replace('_', ' ', $module)) . "';
                ";

if ($join) {
    foreach ($table_join as $index => $row) {
        $string .= "\$data['$row'] = \$this->" . ucfirst($row) . "_model->get_all();\n";
    }
}

$string .= "\$this->load->view('templates/header', \$data);
                \$this->load->view('$c_url/$v_form', \$data);
                \$this->load->view('templates/footer', \$data);
            }

            public function create_action() 
            {
                \$this->_rules();

                if (\$this->form_validation->run() == FALSE) {
                    \$this->create();
                    } else {
                        \$data = array(";
foreach ($non_pk as $row) {
    if (isset($_POST['ada_gambar'])) {
        $kolom_gambar = $_POST['kolom_gambar'];
        if ($row['column_name'] == $kolom_gambar) {
            $string .= "\n\t\t'" . $row['column_name'] . "' => _upload('$kolom_gambar', '$table_name/create', '$table_name'),";
        } else {
            $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
        }
    } else {
        $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
    }
}
$string .= "\n\t    );

                        \$this->" . $m . "->insert(\$data);
                        \$this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('$c_url'));
                    }
                }

                public function update(\$id) 
                {
                    cek_akses('u');

                    \$row = \$this->" . $m . "->get_by_id(\$id);

                    if (\$row) {
                        \$data = array(
                        'button' => 'Update',
                        'action' => site_url('$c_url/update_action'),";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->" . $row['column_name'] . "),";
}
$string .= "\n\t    );

                        \$data['judul'] = 'Ubah " . ucwords(str_replace('_', ' ', $module)) . "';\n";

if ($join) {
    foreach ($table_join as $index => $row) {
        $string .= "\$data['$row'] = \$this->" . ucfirst($row) . "_model->get_all();\n";
    }
}

$string .= "\$this->load->view('templates/header', \$data);
                        \$this->load->view('$c_url/$v_form', \$data);
                        \$this->load->view('templates/footer', \$data);

                        } else {
                            \$this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('$c_url'));
                        }
                    }

                    public function update_action() 
                    {
                        \$this->_rules();

                        if (\$this->form_validation->run() == FALSE) {
                            \$this->update(\$this->input->post('$pk', TRUE));
                            } else {
                                \$data = array(";
foreach ($non_pk as $row) {
    if (isset($_POST['ada_gambar'])) {
        $kolom_gambar = $_POST['kolom_gambar'];
        if ($row['column_name'] != $kolom_gambar) {
            $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
        }
    } else {
        $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
    }
}
$string .= "\n\t    );";

if (isset($_POST['ada_gambar'])) {
    $string .= " \n
                                    \$id = \$this->input->post('$pk', TRUE);
                                    if(\$_FILES['$kolom_gambar']['name']) {
                                        \$data['$kolom_gambar'] = _upload('$kolom_gambar', '$table_name/update/' . \$id, '$table_name');
                                        delImage('$table_name', \$id, '$kolom_gambar');
                                    }";
}

$string .= "

                                \$this->" . $m . "->update(\$this->input->post('$pk', TRUE), \$data);
                                \$this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('$c_url'));
                            }
                        }

                        public function delete(\$id) 
                        {
                            cek_akses('d');
                            ";

if (isset($_POST['ada_gambar'])) {
    $string .= "delImage('$table_name', \$id, '$kolom_gambar');\n";
}

$string .= "\$row = \$this->" . $m . "->get_by_id(\$id);

                            if (\$row) {
                                \$this->" . $m . "->delete(\$id);
                                \$this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('$c_url'));
                                } else {
                                    \$this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('$c_url'));
                                }
                            }

                            public function _rules() 
                            {";
foreach ($non_pk as $row) {
    $int = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
    if (isset($_POST['ada_gambar'])) {
        $kolom_gambar = $_POST['kolom_gambar'];
        if ($row['column_name'] != $kolom_gambar) {
            $string .= "\n\t\$this->form_validation->set_rules('" . $row['column_name'] . "', '" .  strtolower(label($row['column_name'])) . "', 'trim|required$int');";
        }
    } else {
        $string .= "\n\t\$this->form_validation->set_rules('" . $row['column_name'] . "', '" .  strtolower(label($row['column_name'])) . "', 'trim|required$int');";
    }
}
$string .= "\n\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
                        }";

if ($export_excel == '1') {
    $string .= "\n\n    public function excel()
                            {
                                \$this->load->helper('exportexcel');
                                \$namaFile = \"$table_name.xls\";
                                \$judul = \"$table_name\";
                                \$tablehead = 0;
                                \$tablebody = 1;
                                \$nourut = 1;
                                //penulisan header
                                header(\"Pragma: public\");
                                header(\"Expires: 0\");
                                header(\"Cache-Control: must-revalidate, post-check=0,pre-check=0\");
                                header(\"Content-Type: application/force-download\");
                                header(\"Content-Type: application/octet-stream\");
                                header(\"Content-Type: application/download\");
                                header(\"Content-Disposition: attachment;filename=\" . \$namaFile . \"\");
                                header(\"Content-Transfer-Encoding: binary \");

                                xlsBOF();

                                \$kolomhead = 0;
                                xlsWriteLabel(\$tablehead, \$kolomhead++, \"No\");";
    foreach ($non_pk as $row) {
        $column_name = label($row['column_name']);
        $string .= "\n\txlsWriteLabel(\$tablehead, \$kolomhead++, \"$column_name\");";
    }
    $string .= "\n\n\tforeach (\$this->" . $m . "->get_all() as \$data) {
                                    \$kolombody = 0;

                                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber(\$tablebody, \$kolombody++, \$nourut);";
    foreach ($non_pk as $row) {
        $column_name = $row['column_name'];
        $xlsWrite = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? 'xlsWriteNumber' : 'xlsWriteLabel';
        $string .= "\n\t    " . $xlsWrite . "(\$tablebody, \$kolombody++, \$data->$column_name);";
    }
    $string .= "\n\n\t    \$tablebody++;
                                    \$nourut++;
                                }

                                xlsEOF();
                                exit();
                            }";
}

if ($export_word == '1') {
    $string .= "\n\n    public function word()
                            {
                                header(\"Content-type: application/vnd.ms-word\");
                                header(\"Content-Disposition: attachment;Filename=$table_name.doc\");

                                \$data = array(
                                '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
                                'start' => 0
                                );

                                \$this->load->view('" . $c_url . "/" . $v_doc . "',\$data);
                            }";
}

if ($export_pdf == '1') {
    $string .= "\n\n    function pdf()
                            {
                                \$data = array(
                                '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
                                'start' => 0
                                );

                                ini_set('memory_limit', '32M');
                                \$html = \$this->load->view('" . $c_url . "/" . $v_pdf . "', \$data, true);
                                \$pdf = new \Mpdf\Mpdf();
                                \$pdf->WriteHTML(\$html);
                                \$pdf->Output('" . $table_name . ".pdf', 'D'); 
                            }";
}

$string .= "\n\n}\n\n/* End of file $c_file */
                        /* Location: ./application/modules/$target/controllers/$c_file */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator " . date('Y-m-d H:i:s') . " */
                        /* http://harviacode.com */";

$hasil_controller = createFile($string, $target . $module .  "/controllers/" . $c_file);
