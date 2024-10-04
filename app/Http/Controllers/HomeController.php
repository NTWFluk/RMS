<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Stock;
use App\Models\Food;
use App\Models\Food_type;
use App\Models\Stock_unit;
use App\Models\Stock_type;
use App\Models\Order;
use App\Models\Receipt;
use Illuminate\Support\Facades\DB;
use Session;
use Hash;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevel;
use PDF;

date_default_timezone_set("Asia/Bangkok");
class HomeController extends Controller
{
    //Home view
    public function home(){
        $index = "Home Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        $info['tables'] = DB::table('tables')->select()->get();
        $info['employees'] = DB::table('employees')->select()->get();
        // $url = url('/home');
        // dd($url);
        return view('RMS.employee.home',compact('index','name'),$info);
    }

    //Generat QRCode
    public function qrcode(Request $request){
        $time = date("Y-m-d H:i:s");
        $allprice = 279 * $request->count;
        $infotable = DB::update('update tables set is_active = 2 where table_id = ?', [$request->table_id]);
        $insertoreceipt = DB::insert('insert into receipts (em_id, all_price, count, table_id, created_at, updated_at, is_active) values (?, ?, ?, ?, ?, ?, ?)', [$request->em_id, $allprice, $request->count, $request->table_id, $time, $time, 1]);
        $inforeceipt = Receipt::orderBy('receipt_id', 'desc')->first();
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data(url('/home/'.$inforeceipt->table_id.'/'.$inforeceipt->receipt_id))
            ->encoding(new Encoding('UTF-8'))
            ->size(250)
            ->margin(10)
            ->build();

        $qrcode = base64_encode($result->getString());

        $names = Employee::where('em_id', '=', Session::get('loginId'))->first();
        $pdf = PDF::loadView('RMS.employee.test', compact('names', 'qrcode'));

        return $pdf->download('customer.pdf');
    }

    //Order view
    public function order(){
        $index = "Order Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        $info['orders'] = DB::table('orders as o')->join('food as f','f.food_id','=','o.food_id')->select('f.name','f.img_file','o.*')->where('o.is_active',2)->get();
        return view('RMS.employee.order',compact('index','name'),$info);
    }

    //Submit Order
    public function submitorder($order){
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        $orders = DB::table('orders')->select()->where('order_id','=',$order)->first();
        $food = DB::table('food')->select()->where('food_id','=',$orders->food_id)->first();
        $stock = DB::table('stocks')->select()->where('stock_id','=',$food->stock_id)->first();
        $allcount = $orders->count * $food->amount;
        if ( $stock->amount > $allcount ) {
            $allamount = $stock->amount - $allcount;
            $datastock = DB::update('update stocks set amount = ? where stock_id = ?', [$allamount,$stock->stock_id]);
            $dataorder = DB::update('update orders set is_active = ? where order_id = ?', [3,$orders->order_id]);
            return redirect()->route('order');
        }
        else {
            dd("Hello world");
            return redirect()->route('order');
        }
    }

    //Stock view
    public function stock(){
        $index = "Stock Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        $info['stocks'] = DB::table('stocks')->select()->get();
        return view('RMS.employee.stock',compact('index','name'),$info);
    }

    //Manage Table view
    public function Mtable(){
        $index = "Manage Table Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        $info['tables'] = DB::table('tables')->select()->get();
        return view('RMS.admin.Mtable',compact('index','name'),$info);
    }

    //Function Add table
    public function yesaddtable(Request $request){
        $request->validate([
            "count" => "required",
        ]);
        $is_active = 1;
        $data = DB::insert('insert into tables (count,is_active) values (?,?)',[$request->count,$is_active]);
        return redirect()->route('Mtable');
    }

    //Function Edit table
    public function yesedittable(Request $request){
        $request->validate([
            "count" => "required",
            "table_id" => "required",
        ]);
        $data = DB::update('update tables set count = ? where table_id = ?', [$request->count,$request->table_id]);
        return redirect()->route('Mtable');
    }

    //Function Delete table
    public function deltable($id){
        $is_active = 3;
        $data = DB::update('update tables set is_active = ? where table_id = ?', [$is_active,$id]);
        return redirect()->route('Mtable');
    }

    //Manage Menu view
    public function Mmenu(){
        $index = "Manage Menu Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        $info['food'] = DB::table('food')->select()->get();
        return view('RMS.admin.Mmenu',compact('index','name'),$info);
    }

    //Add Menu view
    public function addmenu(){
        $index = "Add Menu Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        $info['food_types'] = DB::table('food_types')->select()->get();
        $info['stocks'] = DB::table('stocks as s')->join('stock_units as su','su.s_unit_id','=','s.s_unit_id')->select('s.stock_id','s.name','su.name as suname')->get();
        return view('RMS.admin.addmenu',compact('index','name'),$info);
    }

    //Function Add menu
    public function yesaddmenu(Request $request){
        $request->validate([
            "name" => "required",
            "stock_id" => "required",
            "f_type_id" => "required",
            "amount" => "required",
        ]);
        // dd($request);
        $num = DB::table('food')->select(DB::raw('COUNT(food_id) AS numrowid'))->first();
        $data = new Food;
        $time = date("Y-m-d H:i:s");
        $is_active = 1;
        if ($request->img_file != null) {
            $newnum =$num->numrowid+1;
            $name = $request->file('img_file');
            $newname = $newnum.'.'.$name->getClientOriginalExtension();
            if ($name->storeAs('food',$newname,'public')){
                $nameimg = '/storage/'.$name->storeAs('food',$newname,'public');
                // dd($nameimg);
                $data = DB::insert('insert into food (stock_id ,name ,img_file ,f_type_id ,amount ,created_at ,updated_at ,is_active) values (?, ?, ?, ?, ?, ?, ?, ?)', [$request->stock_id,$request->name,$nameimg,$request->f_type_id,$request->amount,$time,$time,$is_active]);
            }
            }
        else {
            $data = DB::insert('insert into food (stock_id ,name ,f_type_id ,amount ,created_at ,updated_at ,is_active) values (?, ?, ?, ?, ?, ?, ?)', [$request->stock_id,$request->name,$request->f_type_id,$amount,$time,$time,$is_active]);
        }
        return redirect()->route('Mmenu');
    }
    //Function Add type menu
    public function yesaddtypemenu(Request $request){
        $request->validate([
            "f_type_id" => "required",
        ]);
        $data = new Food_type;
        $data = DB::insert('insert into food_types (name) values (?)', [$request->f_type_id]);
        return redirect()->route('addmenu');
    }

    //Function Delete type menu
    public function yesdeltypemenu(Request $request){
        foreach ($request->f_type_id as $type) {
            $data = new Food_type;
            $data = DB::delete('delete from food_types where f_type_id = ?', [$type]);
        }
        return redirect()->route('addmenu');
    }

    //Manage Stock view
    public function Mstock(){
        $index = "Manage Stock Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        $info['stocks'] = DB::table('stocks')->select()->get();
        return view('RMS.admin.Mstock',compact('index','name'),$info);
    }
    //Add Stock view
    public function addstock(){
        $index = "Add Stock Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        $info['stock_units'] = DB::table('stock_units')->select()->get();
        $info['stock_types'] = DB::table('stock_types')->select()->get();
        return view('RMS.admin.addstock',compact('index','name'),$info);
    }

    //Edit Stock view
    public function editstock($stock){
        $index = "Add Stock Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        $stock = DB::table('stocks as s')->join('stock_units as u','u.s_unit_id','=','s.s_unit_id')->join('stock_types as t','t.s_type_id','=','s.s_type_id')->select('s.*','u.name as uname','t.name as tname')->where('s.stock_id','=',$stock)->first();
        $info['stock_units'] = DB::table('stock_units')->select()->get();
        $info['stock_types'] = DB::table('stock_types')->select()->get();
        return view('RMS.admin.editstock',compact('index','name','stock'),$info);
    }

    //Function Add Stock
    public function yesaddstock(Request $request){
        $request->validate([
            "name" => "required",
            "amount" => "required",
            "s_unit_id" => "required",
            "s_type_id" => "required",
        ]);
        $data = new Stock;
        $time = date("Y-m-d H:i:s");
        $data = DB::insert('insert into stocks (name, s_unit_id ,amount ,s_type_id ,created_at ,updated_at) values (?, ? ,? ,? ,? ,?)', [$request->name,$request->s_unit_id,$request->amount,$request->s_type_id,$time,$time]);
        return redirect()->route('Mstock');
    }
    //Function Edit Stock
    public function yeseditstock(Request $request){
        $request->validate([
            "name" => "required",
            "amount" => "required",
            "s_unit_id" => "required",
            "s_type_id" => "required",
            "stock_id" => "required",
        ]);
        $data = new Stock;
        $time = date("Y-m-d H:i:s");
        $data = DB::update('update stocks set name = ? , s_unit_id = ? , amount = ? , s_type_id = ? , updated_at = ? where stock_id = ?', [$request->name,$request->s_unit_id,$request->amount,$request->s_type_id,$time,$request->stock_id]);
        return redirect()->route('Mstock');
    }
    //Function Add Unit Stock
    public function yesaddstockunit(Request $request){
        $request->validate([
            "s_unit_id" => "required",
        ]);
        $data = new Stock_unit;
        $data = DB::insert('insert into stock_units (name) values (?)', [$request->s_unit_id]);
        return redirect()->route('addstock');
    }
    //Function Delete Unit Stock
    public function yesdelstockunit(Request $request){
        foreach ($request->s_unit_id as $unit) {
            $data = new Stock_unit;
            $data = DB::delete('delete from stock_units where s_unit_id = ?', [$unit]);
        }
        return redirect()->route('addstock');
    }
    //Function Add Type Stock
    public function yesaddstocktype(Request $request){
        $request->validate([
            "s_type_id" => "required",
        ]);
        $data = new Stock_type;
        $data = DB::insert('insert into stock_types (name) values (?)', [$request->s_type_id]);
        return redirect()->route('addstock');
    }
    //Function Delete Type Stock
    public function yesdelstocktype(Request $request){
        foreach ($request->s_type_id as $type) {
            $data = new Stock_unit;
            $data = DB::delete('delete from stock_types where s_type_id = ?', [$type]);
        }
        return redirect()->route('addstock');
    }
    //Manage Account view
    public function Maccount(){
        $index = "Manage Account Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        return view('RMS.admin.Maccount',compact('index','name'));
    }
    //Manage Employee view
    public function Memployee(){
        $index = "Manage Employee Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        $info['employees'] = DB::table('employees')->select()->get();
        return view('RMS.admin.Memployee',compact('index','name'),$info);
    }
    //Profile view
    public function profile($id){
        $index = "Profile Page";
        $name = Employee::where('em_id' , '=' , $id )->first();
        return view('RMS.employee.profile',compact('index','name'));
    }
    //Edit Profile view
    public function editprofile($id){
        $index = "Edit Profile Page";
        $name = Employee::where('em_id' , '=' , $id )->first();
        return view('RMS.employee.editprofile',compact('index','name'));
    }
    //Menage Member view
    public function Mmember(){
        $index = "Manage Member Page";
        $name = Employee::where('em_id' , '=' , Session::get('loginId') )->first();
        return view('RMS.employee.editprofile',compact('index','name'));
    }
    //Login view
    public function login(){
        $index = "Login Page";
        return view('RMS.employee.login',compact('index'));
    }
    // Function Login
    public function gologin(Request $request){
        $request->validate([
            "username" => "required",
            "password" => "required",
        ]);
        $data = Employee::where('username' , '=' , $request->username )->first();
        // $pass="1234";
        // dd(Hash::make($pass));
        if ( $data ){          
            if ( Hash::check($request->password, $data->password) ){
                $request->session()->put('loginId',$data->em_id);
                $request->session()->put('position',$data->position);
                return redirect()->route('home');
            }
            else{
                return back();
            }
        }
        else{
            return back();
        }
    }
    //Log Out
    public function gologout() {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect()->route('login');
        }
    }
    //Forgetpassword view
    public function forgetpassword(){
        $index = "Forget Password Page";
        return view('RMS.employee.forgetpassword',compact('index'));
    }
    //Add Employee View
    public function addemployee(){
        $index = "Add Employee Page";
        return view('RMS.admin.addemployee',compact('index'));
    }

    //Function Add Employee 
    public function yesaddemployee(Request $request){
        $request->validate([
            "prefix" => "required",
            "frist_name" => "required",
            "last_name" => "required",
            "username" => "required",
            "password" => "required",
            "address" => "required",
            "line_id" => "required",
            "facebook" => "required",
            "email" => "required",
            "birthday" => "required",
            "gender" => "required",
            "phone_number" => "required",
            "position" => "required",
        ]);
        $num = DB::table('employees')->select(DB::raw('COUNT(em_id) AS numrowid'))->first();
        $data = new Employee;
        $prefix = $request->prefix;
        $frist_name = $request->frist_name;
        $last_name = $request->last_name;
        $username = $request->username;
        $password = Hash::make($request->password);
        $address = $request->address;
        $line_id = $request->line_id;
        $facebook = $request->facebook;
        $email = $request->email;
        $birthday = $request->birthday;
        $gender = $request->gender;
        $phone_number = $request->phone_number;
        $position = $request->position;
        $time = date("Y-m-d H:i:s");
        $is_active = 1;
        if ($request->img_file != null) {
            $newnum =$num->numrowid+1;
            $name = $request->file('img_file');
            $newname = $newnum.'.'.$name->getClientOriginalExtension();
            if ($name->storeAs('employees',$newname,'public')){
                $nameimg = '/storage/'.$name->storeAs('employees',$newname,'public');
                $data = DB::insert('insert into employees (prefix,frist_name,last_name,username,password,address,line_id,facebook,email,birthday,gender,img_file,phone_number,position,created_at,updated_at,is_active) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$prefix,$frist_name,$last_name,$username,$password,$address,$line_id,$facebook,$email,$birthday,$gender,$nameimg,$phone_number,$position,$time,$time,$is_active]);
            }
            }
        else {
            $data = DB::insert('insert into employees (prefix,frist_name,last_name,username,password,address,line_id,facebook,email,birthday,gender,img_file,phone_number,position,created_at,updated_at,is_active) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$prefix,$frist_name,$last_name,$username,$password,$address,$line_id,$facebook,$email,$birthday,$gender,$nameimg,$phone_number,$position,$time,$time,$is_active]);
        }
        return redirect()->route('Memployee');
    }

    //Edit Employee View
    public function editemployee($id){
        $index = "Edit Employee Page";
        $info['employee'] = DB::table('employees')->where('em_id',$id)->select()->get();
        return view('RMS.admin.editemployee',compact('index'),$info);
    }

    //Function Edit Employee 
    public function yeseditemployee(Request $request , $id){
        $request->validate([
            "prefix" => "required",
            "frist_name" => "required",
            "last_name" => "required",
            "username" => "required",
            "address" => "required",
            "line_id" => "required",
            "facebook" => "required",
            "email" => "required",
            "birthday" => "required",
            "gender" => "required",
            "phone_number" => "required",
            "position" => "required",
        ]);
        $num = DB::table('employees')->select(DB::raw('COUNT(em_id) AS numrowid'))->first();
        $data = new Employee;
        $prefix = $request->prefix;
        $frist_name = $request->frist_name;
        $last_name = $request->last_name;
        $username = $request->username;
        $address = $request->address;
        $line_id = $request->line_id;
        $facebook = $request->facebook;
        $email = $request->email;
        $birthday = $request->birthday;
        $gender = $request->gender;
        $phone_number = $request->phone_number;
        $position = $request->position;
        $time = date("Y-m-d H:i:s");
        $is_active = 1;
        if ($request->img_file != null) {
            $newnum =$id;
            $name = $request->file('img_file');
            $newname = $newnum.'.'.$name->getClientOriginalExtension();
            if ($name->storeAs('employees',$newname,'public')){
                $nameimg = '/storage/'.$name->storeAs('employees',$newname,'public');
                $data = DB::update('update employees set prefix = ?,frist_name = ?,last_name = ?,username = ?,address = ?,line_id = ?,facebook = ?,email = ?,birthday = ?,gender = ?,img_file = ?,phone_number = ?,position = ?,updated_at = ? where em_id = '.$id.'',[$prefix,$frist_name,$last_name,$username,$address,$line_id,$facebook,$email,$birthday,$gender,$nameimg,$phone_number,$position,$time]);
            }
            }
        else {
            $data = DB::update('update employees set prefix = ?,frist_name = ?,last_name = ?,username = ?,address = ?,line_id = ?,facebook = ?,email = ?,birthday = ?,gender = ?,phone_number = ?,position = ?,updated_at = ? where em_id = '.$id.'',[$prefix,$frist_name,$last_name,$username,$address,$line_id,$facebook,$email,$birthday,$gender,$phone_number,$position,$time]);
        }
        return redirect()->route('Memployee');
    }

    //Customer Home View
    public function customer($tables,$customers){
        $index = "Customer Home Page";
        $customer = $customers;
        $table = DB::table('tables')->select('*')->where('table_id',$tables)->first();
        $info['foods'] = DB::table('food')->select()->get();
        return view('RMS.customer.home',compact('index','table','customer'),$info);
    }

    //Add Order
    public function addtocart(Request $request)
    {
        $food = $request->food_id;
        $count = $request->count;
        $receipt = $request->receipt_id;
        $table = $request->table_id;
        $is_active = 1;
        $cart = Order::where('receipt_id', $receipt)->where('food_id', $food)->where('is_active', $is_active)->first();
        if ($cart) {
            // ถ้ามีสินค้าอยู่แล้ว เพิ่มจำนวน
            $new = $cart->count + $count;
            $data = DB::update('update orders set count = ? where order_id = ?', [$new,$cart->order_id]);
        } else {
            // ถ้าไม่มีสินค้า สร้างรายการใหม่
            $time = date("Y-m-d H:i:s");
            $data = DB::insert('insert into orders (receipt_id,food_id,is_active,count,table_id,created_at,updated_at) values (?,?,?,?,?,?,?)',[$receipt,$food,$is_active,$count,$table,$time,$time]);
        }
        return redirect()->route('customer', ['tables' => $table, 'customers' => $receipt]);
    }

    // View Order
    public function viewcart($tables,$customers)
    {
        $receipt = $customers;
        $table = $tables;
        $index = "Customer Order Page";
        $info['foods'] = DB::table('orders as o')->join('food as f','f.food_id','=','o.food_id')->select('f.name','f.img_file','o.*')->where('o.is_active',1)->where('o.receipt_id',$receipt)->where('o.table_id',$table)->get();
        return view('RMS.customer.food',compact('index','table','receipt'),$info);
        // return view('RMS.customer.food', compact('info'));
    }

    // Delete Order
    public function removefromcart($tables,$customers,$id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem && $cartItem->user_id == $customers) {
            $cartItem->delete();
        }
        return redirect()->route('customer');
    }
    //Submit Order Customer
    public function addorder(Request $request)
    {
        $receipt = $request->receipt_id;
        $table = $request->table_id;
        $is_active = 2;
        $time = date("Y-m-d H:i:s");
        $data = DB::update('update orders set is_active = ? where receipt_id = ? and table_id = ? and is_active = 1', [$is_active,$receipt,$table]);
        return redirect()->route('customer', ['tables' => $table, 'customers' => $receipt]);
    }
}
