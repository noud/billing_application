<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function stocks(){
        $Prouducts = DB::select("select * from products");
        return view('stocks')->with(array('products'=>$Prouducts));
    }
    public function customer(){

        $customers =DB::select("SELECT area.Area_name,customers.name,customers.area,customers.contact,customers.ID FROM customers RIGHT JOIN area ON area.Area_name = customers.area");
        return view('customer')->with(array('customers'=>$customers));
    }
    public function bill(){
        $Prouducts = DB::select("select * from products");
        return view('bill')->with(array('products'=>$Prouducts));
    }
    public function area(){
        $area = DB::select("select * from area");
      return view('area')->with(array('area'=>$area));
    }
    public function allbill(){

        $bill = DB::select("select * from invoice_detail");
        return view('allbill')->with(array('bill'=>$bill));
      }



    public function add_product(){
        $product_name = $_POST['product_name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $tax = $_POST['tax'];
        $quantity = $_POST['quantity'];
        $status = $_POST['status'];
        DB::select("insert into products (product_name,category,price,tax,quantity,status) values ('$product_name','$category','$price','$tax','$quantity','$status')");
    }

    public function editproduct()
    {
        $id = $_GET['id'];
        $product_details=DB::select("select * from products Where ID=$id");
        return $product_details;
    }

    public function updateproduct()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $tax = $_POST['tax'];
        $quantity = $_POST['quantity'];
        $status = $_POST['status'];
        DB::select("update products set product_name = '$name',category='$category',price='$price',tax='$tax',quantity='$quantity',status='$status' where ID=$id");
    }
    public function deleteproduct()
    {
        $id = $_POST['id'];
        DB::select("delete from products Where ID=$id");
    }

    // customer

    public function add_customer(){
        $customer_name = $_POST['customer_name'];
        $contact = $_POST['contact'];
        $area = $_POST['area'];

        DB::select("insert into customers (name,contact,area) values ('$customer_name','$contact','$area')");
    }

    public function editcustomer()
    {
        $id = $_GET['id'];
        $customer_details=DB::select("select * from customers Where ID=$id");
        return $customer_details;
    }

    public function updatecustomer()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $area = $_POST['area'];
        DB::select("update customers set name = '$name',contact='$contact',area='$area' where ID=$id");
    }

    public function deletecustomer()
    {
        $id = $_POST['id'];
        DB::select("delete from customers Where ID=$id");
    }

    public function findproduct()
    {
        $id = $_POST['product_id'];
        $product_details=DB::select("select * from products Where ID=$id");
        return $product_details;

    }
    public function addinvoice(Request $request)
    {
        $customer_name = $_GET['customer_name'];
        $customer_area = $_GET['area'];
        $customer_contact = $_GET['contact'];
        $count =  $_GET['product'];
        $product_name =  $_GET['product'];
        $available_qty = $_GET['available_qty'];
        $product_price = $_GET['price'];
        $product_qty = $_GET['qty'];
        $item_total =  $_GET['item_total'];
        $sub_total = $_GET['sub_total'];


        $invoice_details = DB::select("insert into invoice_detail (Customer_name,Area,Amount) values ('$customer_name','$customer_area','$sub_total')");
        $id = DB::getPdo()->lastInsertId();
        $num_of_product = count($count);
                for ($i=0; $i <$num_of_product ; $i++) {
                $rem_qty = $available_qty[$i] - $product_qty[$i];
				if ($rem_qty < 0) {
					return "ORDER_FAIL_TO_COMPLETE";
				}else{
					$sql = DB::select("update products SET quantity = '$rem_qty' WHERE ID = '$product_name[$i]'");

				}
				$insert_product =DB::select("INSERT INTO invoice_product_detail (Invoice_ID, Product_name, qty, price,item_total)
				 VALUES ('$id','$product_name[$i]','$product_qty[$i]','$product_price[$i]','$item_total[$i]')");
        }
    }


    public function add_area(){
        $area_name = $_POST['area_name'];

        DB::select("insert into area (Area_name) values ('$area_name')");
    }
}
