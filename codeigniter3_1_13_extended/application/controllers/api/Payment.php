<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class Payment extends REST_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url'); //elérési út miatt be kell tölteni
        $this->load->database();
    }

    public function index_get($id)
    {
        
        if (!is_numeric($id)) {
            $this->response(["Az azonosítónak számnak kell lennie."], REST_Controller::HTTP_BAD_REQUEST);
        } else if ($id == 0) {
            $adatok = $this->db->get("payments")->result_array();
            $this->response($adatok, REST_Controller::HTTP_OK);
            $this->load->view('payments/listaz', $adatok);
        } else {
            $this->db->where('id', $id);
            $adatok = $this->db->get("payments")->row_array();
            if (empty($adatok)) {
                $this->response(["A megadott azonosítóval nem található adat."], REST_Controller::HTTP_NOT_FOUND);
            } else {
                $this->response($adatok, REST_Controller::HTTP_OK);
                
            }
        }
    }

    

    public function index_delete($id)
    {
        if (!is_numeric($id)) {
            $this->response(["Az azonosítónak számnak kell lennie."], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        $this->db->where('id', $id);
        $adatok = $this->db->get("payments")->row_array();
        if (empty($adatok)) {
            $this->response(["A megadott azonosítóval nem található adat."], REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        $this->db->where('id', $id);
        $this->delete('payments');
        $this->response(NULL,REST_Controller::HTTP_NO_CONTENT);
    }

}

/* End of php */
?>