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
		redirect("shop/show/1/1/1");
	}

	public function show()
	{
		$data =  array();
		$data['products'] = $this->picModel->getAllProductList();


		$data['allCarts'] = $this->picModel->getAllCart($this->uri->segment(5));
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
		

		$this->load->view('v_pic', $data);
	}

	public function productName($pID){
		$data = array();
		$data['productDetail'] = $this->picModel->getProduct($pID);
		return $data['productDetail'][0]->product_name;
	}

	public function productPrice($pID){
		$data = array();
		$data['productDetail'] = $this->picModel->getProduct($pID);
		return $data['productDetail'][0]->product_price;
	}
}

/* End of file shop.php */
/* Location: ./application/controllers/shop.php */