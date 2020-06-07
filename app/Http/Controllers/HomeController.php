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
        $customers =DB::select("select * from customers");
        return view('customer')->with(array('customers'=>$customers));
    }
    public function bill(){
        return view('bill');
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
}
