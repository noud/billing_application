<?php

namespace App\Http\Controllers;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Http\Request;
use App;
use App\Company;

use PDF;
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
        $date = date("Y-m-d");
        $recent = DB::select("select product_name,price,quantity from products");
        return view('home')->with(array('recent'=>$recent));
    }
    public function company(){
        $company = Company::first();
        if ($company) {
            return view('company', ['company' => $company->toArray()]);
        } else {            
            return view('company');
        }
    }
    public function settings(){
        return view('setting');
    }
    public function stocks(){
        $categories = DB::select("select * from category");
        $Prouducts = DB::select("select * from products");
        return view('stocks')->with(array('products'=>$Prouducts, 'categories' => $categories));
    }
    public function customer(){

        $customers =DB::select("SELECT * FROM customers");
        $area =DB::select("SELECT * FROM area");
        return view('customer')->with(array('customers'=>$customers,'area'=>$area));
    }
    public function bill(){
        $Prouducts = DB::select("select * from products");
        $area = DB::select("select Area_name from area");
        return view('bill')->with(array('products'=>$Prouducts,'area'=>$area));
    }
    public function area(){
        $area = DB::select("select * from area");
      return view('area')->with(array('area'=>$area));
    }
    public function category(){
        $category = DB::select("select * from category");
      return view('category')->with(array('category'=>$category));
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
        $unit = $_POST['unit'];
        DB::select("insert into products (product_name,category,price,unit,tax,quantity,tax_amount) values ('$product_name','$category','$price',' $unit','$tax','$quantity','$status')");
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
        $unit = $_POST['unit'];
        DB::select("update products set product_name = '$name',category='$category',price='$price',tax='$tax',quantity='$quantity',tax_amount='$status',unit='$unit' where ID=$id");
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
        $product_details=DB::select("select * from products Where product_name='$id'");
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
        $product_unit = $_GET['unit'];
        $product_tax = $_GET['tax'];
        $product_tax_amount = $_GET['tax_amount'];
        $item_total =  $_GET['item_total'];
        $sub_total = $_GET['sub_total'];
        $tax_total = $_GET['tax_total'];
        $date = $_GET['date'];


        $invoice_details = DB::select("insert into invoice_detail (Customer_name,Area,Amount,Tax_amount,Date) values ('$customer_name','$customer_area','$sub_total','$tax_total','$date')");
        $id = DB::getPdo()->lastInsertId();
        DB::select("update invoice_detail set Invoice_ID = '$id' where id = '$id';");
        $num_of_product = count($count);
                for ($i=0; $i <$num_of_product ; $i++) {
                $rem_qty = $available_qty[$i] - $product_qty[$i];
				if ($rem_qty < 0) {
					return "ORDER_FAIL_TO_COMPLETE";
				}else{
					$sql = DB::select("update products SET quantity = '$rem_qty' WHERE product_name = '$product_name[$i]'");

				}
				$insert_product =DB::select("INSERT INTO invoice_product_detail (Invoice_ID, Product_name,tax,tax_amount,qty,unit,price,item_total)
				 VALUES ('$id','$product_name[$i]','$product_tax[$i]','$product_tax_amount[$i]','$product_qty[$i]','$product_unit[$i]','$product_price[$i]','$item_total[$i]')");
        }
    }


    public function add_area(){
        $area_name = $_POST['area_name'];

        DB::select("insert into area (Area_name) values ('$area_name')");
    }
    public function editarea()
    {
        $id = $_GET['id'];
        $area_details=DB::select("select * from area Where area_id=$id");
        return $area_details;
    }
    public function updatearea()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        DB::select("update area set area_name = '$name' where area_id=$id");
    }
    public function deletearea()
    {
        $id = $_POST['id'];
        DB::select("delete from area Where area_id=$id");
    }

    public function add_category(){
        $category_name = $_POST['category_name'];

        DB::select("insert into category (category_name) values ('$category_name')");
    }
    public function editcategory()
    {
        $id = $_GET['id'];
        $category_details=DB::select("select * from category Where category_id=$id");
        return $category_details;
    }
    public function updatecategory()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        DB::select("update category set category_name = '$name' where category_id=$id");
    }
    public function deletecategory()
    {
        $id = $_POST['id'];
        DB::select("delete from category Where category_id=$id");
    }

    public function editbill(Request $request){
        $id = $request->route('item');
        $invoice_details = DB::select("SELECT Invoice_ID,Customer_name,Area,Date,Amount,Tax_amount FROM invoice_detail where Invoice_ID = '$id'");
        $invoice_product_details = DB::select("select * from invoice_product_detail where Invoice_ID = '$id'");
        $product_details = DB::select("select * from products");
        $company = DB::select("select * from company LIMIT 1");
        // $details = DB::select("SELECT * FROM invoice_detail INNER JOIN invoice_product_detail ON invoice_detail.Invoice_ID = invoice_product_detail.Invoice_ID WHERE invoice_product_detail.Invoice_ID ='$id' ");
        // return view('editbill')->with(array('invoice_details'=>$invoice_details->getData()->Data))

        return view('editbill',compact('invoice_details','invoice_product_details','product_details','company'));

    }

    public function graph(){
        $products = DB::select("select product_name,quantity from products");

        return $products;
    }
    public function activity_graph(){
        $activity = DB::select("SELECT Date,Amount FROM `invoice_detail` ORDER BY `invoice_detail`.`Date` DESC");
        return $activity;
    }
    public function tax_graph(){
        $tax = DB::select("select price,tax_amount from products");
        return $tax;
    }
    public function add_company(Request $request){
        $company_name = $_GET['company_name'];
        $tin = $_GET['tin'];
        $address = $_GET['address'];
        $mobile = $_GET['mobile'];
        $phone = $_GET['phone'];
        $city = $_GET['city'];
        $state = $_GET['state'];
        $pin = $_GET['pin'];
        $count = Company::count();    
        if (0 === $count) {
            DB::select("insert into company (company_name,tin,address,mobile,phone,city,state,pin) values('$company_name','$tin','$address','$mobile','$phone','$city','$state','$pin')");
        } else {
            DB::select("update company set company_name='$company_name',tin='$tin',address='$address',mobile='$mobile',phone='$phone',city='$city',state='$state',pin='$pin'");
        }
    }


}
