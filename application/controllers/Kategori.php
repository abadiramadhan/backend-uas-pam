<?php
// import library dari REST_Controller
require APPPATH . 'libraries/REST_Controller.php';

// extends class dari REST_Controller
class Kategori extends REST_Controller
{

    // constructor
    public function __construct($config = 'rest')
    {
        parent::__construct($config);

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $this->load->model('M_kategori');
        $this->load->model('M_catatan');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }


    public function kategoriGet_get()
    {
        $result = $this->M_kategori->get();
        if ($result) {
            $response['code'] = 200;
            $response['status'] = 'success';
            $response['message'] = 'Success get list Kategori';
            $response['data'] = $result;
        } else {
            $response['code'] = 500;
            $response['status'] = 'failed';
            $response['message'] = 'Failed get list Kategori';
            $response['data'] = array();
        }
        $this->response($response);
    }

    public function kategoriGetById_get()
    {
        $result = $this->M_kategori->get_where($this->get('id'));
        // if (!$this->get('id')) {
        //     $response['status']['code'] = 404;
        //     $response['status']['response'] = 'not found';
        //     $response['status']['message'] = 'Not found get list kategori by id kategori';
        //     $response['result']['data'] = array();
        // } else {

        //     if ($result) {
        //         $response['status']['code'] = 200;
        //         $response['status']['response'] = 'success';
        //         $response['status']['message'] = 'Success get list kategori by id kategori';
        //         $response['result']['data'] = $result;
        //     } else {
        //         $response['status']['code'] = 500;
        //         $response['status']['response'] = 'failed';
        //         $response['status']['message'] = 'Failed get list kategori by id kategori';
        //         $response['result']['data'] = array();
        //     }
        // }
        $this->response($result);
    }

    public function kategoriAdd_post()
    {
        $data = array(
            "nama_kategori" => $this->post('nama_kategori'),
            "nominal" => $this->post("nominal")
        );

        $result = $this->M_kategori->add($data);

        if ($result) {
            $response['code'] = 200;
            $response['status'] = 'success';
            $response['message'] = 'Success save new data kategori';
        } else {
            $response['code'] = 500;
            $response['status'] = 'failed';
            $response['message'] = 'Failed save new data kategori';
        }
        $this->response($response);
    }

    public function kategoriUpdate_put()
    {
        $id = $this->put("id_kategori");

        $data = array(
            "nama_kategori" => $this->put('nama_kategori'),
            "nominal" => $this->put("nominal")
        );

        $data2 = array(
            "id_kategori" => $this->put("id_kategori"),
            "tanggal" => date('d-m-Y'),
            "nominal" => $this->put("nominal"),
            "jenis" => $this->put("jenis")
        );

        $result = $this->M_kategori->update($id, $data);
        $result2 = $this->M_catatan->add($data2);

        if ($result && $result2) {
            $response['code'] = 200;
            $response['status'] = 'success';
            $response['message'] = 'Success update data kategori by id ' . $id;
        } else {
            $response['code'] = 500;
            $response['status'] = 'failed';
            $response['message'] = 'Failed update data kategori by id ' . $id;
            // }
        }

        // $response['result']['data'] = array();
        $this->response($response);
    }

    public function kategoriDelete_post()
    {
        $id = $this->post("id_kategori");
        // if (!$id) {
        //     $response['status']['code'] = 404;
        //     $response['status']['response'] = 'not found';
        //     $response['status']['message'] = 'Id not found, cannot delete data kategori';
        // }else{
        $result = $this->M_kategori->delete($id);

        if ($result) {
            $response['code'] = 200;
            $response['status'] = 'success';
            $response['message'] = 'Success delete data kategori by id ' . $id;
        } else {
            $response['code'] = 500;
            $response['status'] = 'failed';
            $response['message'] = 'Failed delete data kategori by id ' . $id;
        }
        // }

        // $response['result']['data'] = array();
        $this->response($response);
    }
}
