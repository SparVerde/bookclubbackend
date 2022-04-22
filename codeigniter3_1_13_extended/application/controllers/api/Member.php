<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class Member extends REST_Controller {
    
    public function __construct()
	{
		parent::__construct();
		$this->load->model('book_model');
	}

	public function index_get()
	{
		$members = $this->Member_model->all();
		$data['data'] = $members;
		$this->response($data, 200);
	}

    public function index_post()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|in_list[M,F]');
		$this->form_validation->set_rules('birth_date', 'Birth Date', 'trim|required|date');
		$this->form_validation->set_rules('banned', 'Banned', 'trim');
		if (!$this->form_validation->run()) {
			$message = validation_errors();
			$message = str_replace('<p>', '', $message);
			$message = str_replace('</p>', '', $message);
			$message = str_replace("\n", ' ', $message);
			$this->response(['message' => $message], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			$data = [];
			$data['name'] = $this->post('name');
			$data['gender'] = $this->post('gender');
			$data['birth_date'] = $this->post('birth_date');
			$data['banned'] = $this->post('banned');
			$data['id'] = $this->Member_model->insert($data);
			$this->response($data, REST_Controller::HTTP_CREATED);
		}
	}


    public function index_delete($id)
    {
        if (!is_numeric($id)) {
            $this->response(["Az azonosítónak számnak kell lennie."], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        $this->db->where('id', $id);
        $adatok = $this->db->get("members")->row_array();
        if (empty($adatok)) {
            $this->response(["A megadott azonosítóval nem található adat."], REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        $this->db->where('id', $id);
        $this->delete('members');
        $this->response(NULL,REST_Controller::HTTP_NO_CONTENT);
    }

}

/* End of php */
?>