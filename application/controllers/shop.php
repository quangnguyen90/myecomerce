<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model("picModel");
	}
	public function index()
	{
		redirect("shop/show/0/x");
	}

	//======================================================================================================================================
	public function show()
	{
		$sg3 = $this->uri->segment(3);
		$sg4 = $this->uri->segment(4);

		$data =  array();
		$data['products'] = $this->picModel->getAllProductList();
		if($sg4 == 'x' || !$sg4){
			$data['cart'] = ' ';
			$data['total'] = '';
		}
		else {
			$data['allCarts'] = $this->picModel->getAllCart($sg4);
			$json = $data['allCarts'][0]->json;
			$json = explode(',', $json);
			$json = array_count_values($json);
			$cart=[];
			$total= 0;
			foreach ($json as $p_id => $count) {
				$obj['product_id'] = $p_id;
				$obj['product_name'] = $this->productName($p_id);
				$obj['product_price'] = $this->productPrice($p_id);
				$obj['count'] = $count;
				$obj['sub_total'] = $count*$obj['product_price'];
				$total += $obj['sub_total'];
				$cart[] = $obj; 
			}

			$data['total'] = $total;
			$data['cart'] = $cart;
			
		}
		$this->load->view('v_pic', $data);
	}

	//======================================================================================================================================
	public function productName($pID){
		$data = array();
		$data['productDetail'] = $this->picModel->getProduct($pID);
		return $data['productDetail'][0]->product_name;
	}

	//======================================================================================================================================
	public function productPrice($pID){
		$data = array();
		$data['productDetail'] = $this->picModel->getProduct($pID);
		return $data['productDetail'][0]->product_price;
	}

	//======================================================================================================================================
	public function addCart(){
		$sg3 = $this->uri->segment(3);
		$sg4 = $this->uri->segment(4);

		if($sg4 == 'x'){
			$obj = array(
				'json' => $sg3
			);
			$this->db->insert('carts', $obj);
			$id=$this->db->insert_id();
			redirect('http://localhost/myecommerce/index.php/shop/show/'.$this->p_pic($sg3).'/'.$id,'refresh');
		}
		else {
			$this->db->where('id', $sg4);
			$json = $this->db->get('carts')->result()[0]->json;
			$obj = array(
				'json' => $json.','.$sg3
			);
			$this->db->update('carts', $obj);
			redirect('http://localhost/myecommerce/index.php/shop/show/'.$this->p_pic($sg3).'/'.$sg4,'refresh');
		}
	}

	//======================================================================================================================================
	public function p_pic($id){
		$data = array();
		$data['products'] = $this->picModel->getAllProductList();

		foreach ($data['products'] as $key => $p) {
			if($p->product_id == $id){
				return $key;
			}
		}
	}
}

/* End of file shop.php */
/* Location: ./application/controllers/shop.php */