<?php
// import library dari REST_Controller
require APPPATH . 'libraries/REST_Controller.php';

// extends class dari REST_Controller
class Catatan extends REST_Controller
{

    // constructor
    public function __construct($config = 'rest')
    {
        parent::__construct($config);

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $this->load->model('M_catatan');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }


    public function catatanGet_get()
    {
        $result = $this->M_catatan->getAll();
        if ($result) {
            $response['code'] = 200;
            $response['status'] = 'success';
            $response['message'] = 'Success get list all catatan';
            $response['data'] = $result;
        } else {
            $response['code'] = 500;
            $response['status'] = 'failed';
            $response['message'] = 'Failed get list all catatan ';
            $response['data'] = array();
        }
        $this->response($response);
    }

    public function catatanMasuk_get()
    {
        $result = $this->M_catatan->getMasuk($this->get('id'));
         
        if ($result) {
            $response['code'] = 200;
            $response['status'] = 'success';
            $response['message'] = 'Success get list catatan masuk';
            $response['data'] = $result;
        } else {
            $response['code'] = $this->get('id') ;
            $response['status'] = 'failed';
            $response['message'] = 'Failed get list catatan masuk';
            $response['data'] = array();
        }

        $this->response($response);
    }
    public function catatanKeluar_get()
    {
        $result = $this->M_catatan->getKeluar($this->get('id'));
         
        if ($result) {
            $response['code'] = 200;
            $response['status'] = 'success';
            $response['message'] = 'Success get list catatan masuk';
            $response['data'] = $result;
        } else {
            $response['code'] = $this->get('id') ;
            $response['status'] = 'failed';
            $response['message'] = 'Failed get list catatan masuk';
            $response['data'] = array();
        }

        $this->response($response);
    }

   
}
