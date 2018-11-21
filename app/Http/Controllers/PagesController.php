<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;

class PagesController extends Controller
{
    public function __construct()
    {
        //  $this->middleware('auth');
    }

    public function home(){

        $products = DB::select('select p.*, 
                                (select price from product_size where product_id = p.id order by price asc limit 1) as price 
                                from product as p 
                                where p.active=1 and p.new = 1 
                                order by p.id desc limit 8');
        $data = array(
            'products' => $products
        );
        return view("pages.home")->with($data);
    }

    public function productsDetail($id){
        //$product = DB::select('select * from product where id = '.$id); // must add $product[0] bcs it will return array not 1 object
        $product = DB::table('product as p')
            ->select(DB::raw('p.*, (select price from product_size where product_id = p.id order by price asc limit 1) as price'))
            ->where('p.id',$id)
            ->first();

        $relatedProducts = DB::table('product as p')
            ->select(DB::raw('p.*, (select price from product_size where product_id = p.id order by price asc limit 1) as price'))
            ->where('p.category_id',$product->category_id)
            ->where('p.active',1)
            ->inRandomOrder()
            ->limit(8)
            ->get();

        $productSize = DB::select('select ps.size_id, s.name, ps.price,p.id as product_id 
                                   from product as p 
                                   inner join product_size as ps on p.id=ps.product_id 
                                   inner join size as s on s.id=ps.size_id 
                                   where p.id = '.$id.' order by ps.price asc ');

        $additionalInformation = DB::select('select s.name as size_name, ps.dimension as dimension, ps.flower_amount as flower_amount 
                                             from product as p 
                                             inner join product_size as ps on p.id=ps.product_id 
                                             inner join size as s on ps.size_id=s.id 
                                             where p.id = '.$id.' order by s.id asc');

        $productImage =  DB::select('select *
                                    from product_image
                                    where product_id = '.$id);

        $data = array(
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'additionalInformation' => $additionalInformation,
            'productSize' => $productSize,
            'productImage' => $productImage
        );

        if($product->active==1){
            return view("pages.products_detail")->with($data);
        }else{
            return redirect('/shop/');
        }
    }

    public function shop($show = null,$sortBy = null,$categoryId = null){
        // $products = DB::select('select * from product order by id desc');
        $where = '1';
        $sortByColumn = 'p.id';
        $sortByValue =  'p.desc';
        if($categoryId != null){
            $where = 'p.category_id = '.$categoryId;
        }
        if($show==null){
            $show = 9;
        }
        if($sortBy!=null){
            switch ($sortBy){
                case 'newest':
                    $sortByColumn = 'p.id';
                    $sortByValue =  'desc';
                    break;
                case 'priceLow':
                    $sortByColumn = 'p.price';
                    $sortByValue =  'asc';
                    break;
                case 'priceHigh':
                    $sortByColumn = 'p.price';
                    $sortByValue =  'desc';
                    break;
                case 'nameAsc':
                    $sortByColumn = 'p.name';
                    $sortByValue =  'asc';
                    break;
                case 'nameDesc':
                    $sortByColumn = 'p.name';
                    $sortByValue =  'desc';
                    break;
                case 'stock':
                    $sortByColumn = 'p.stock';
                    $sortByValue =  'desc';
                    break;

            }

        }else{

            $sortBy = 'newest';
        }

        $products = DB::table('product as p')
            ->select(DB::raw('p.*, (select price from product_size where product_id = p.id order by price asc limit 1) as price'))
            ->whereRaw($where)
            ->where('p.active',1)
            ->orderBy($sortByColumn,$sortByValue)
            ->paginate($show);

        $categories = DB::select('select c.id, c.name, count(p.category_id) as total 
                                from category as c 
                                left join product as p on c.id=p.category_id 
                                where p.active = 1 
                                group by p.category_id,c.id,c.name');

        $data = array(
            'products' => $products,
            'show' => $show,
            'sortBy' => $sortBy,
            'categories' => $categories

        );

        return view("pages.shop")->with($data);
    }

    public function contact(){
        return view("pages.contact");
    }

    public function about(){
        return view("pages.about");
    }

    public function shoppingCart(){
        return view("pages.shopping_cart");
    }

    public function checkout(){
        return view("pages.checkout");
    }

    public function logout(){
        Auth::logout();
        return $this->home();
    }

    public function myaccount(){

        return view("pages.myaccount");

    }

    public function addToCart(Request $request){
        $obj = $request->post();

        if($request->session()->get('cart')==null){
            $products = array();
            array_push($products,$obj);
            $request->session()->put('cart', $products);

        }else{
            $products=$request->session()->get('cart');

            $addAllow = true;

            for($i=0;$i<count($products);$i++){

                if($products[$i]["product_id"]==$obj["product_id"] && $products[$i]["size_id"]==$obj["size_id"]){
                    $products[$i]["quantity"] = ((int)$products[$i]["quantity"])+((int)$obj["quantity"]);
                    $addAllow = false;
                }
            }

            if($addAllow){
                array_push($products,$obj);
            }
            $request->session()->put('cart', $products);

        }
        //  $request->session()->remove('cart');

        return $request->session()->get('cart');
    }

    public function removeItemCart(Request $request)
    {
        $obj = $request->post();
        if($request->session()->get('cart')!=null){
            $products = $request->session()->get('cart');

            for($i=0;$i<count($products);$i++){

                if($obj["size_id"]=="null"){
                    unset($products[$i]);
                    $products2 = array_values($products); // 'reindex' array
                    $request->session()->put('cart',$products2);
                    break;
                }

                if($products[$i]["product_id"]==$obj["product_id"] && $products[$i]["size_id"]==$obj["size_id"]){
                    unset($products[$i]);

                    $products2 = array_values($products); // 'reindex' array
                    $request->session()->put('cart',$products2);
                    break;
                }

            }


        }

        return $request->session()->get('cart');
    }

    public function fetchItemCart(Request $request)
    {
        return $request->session()->get('cart');

    }

    public function changeQuantityItemCart(Request $request)
    {
        $obj = $request->post();
        $num = $obj["num"];
        if($request->session()->get('cart')!=null){
            $products = $request->session()->get('cart');

            for($i=0;$i<count($products);$i++){

                if($products[$i]["product_id"]==$obj["product_id"] && $products[$i]["size_id"]==$obj["size_id"]){
                    $products[$i]["quantity"] = ((int)$products[$i]["quantity"])+$num;
                    $request->session()->put('cart',$products);
                    break;
                }
            }
        }

        return $request->session()->get('cart');
    }


    public function confirmOrder(Request $request)
    {
        $this->validate($request, [
            'country' => 'required',
            'fullname' => 'required',
            'phone' => 'required',
            'province' => 'required',
            'city' => 'required',
            'address' => 'required',
            'poscode' => 'required|Numeric',
            'shipping_method' => 'required'
        ]);
        $obj = $request->post();
        $currentTime = Carbon::now();
        $id = base_convert(time(), 10, 36);
        // $currentTime->timestamp;
        $email = null;
        $fullName = null;
        $phone = null;
        $address = null;
        $country = null;
        $province = null;
        $city = null;
        $poscode = null;
        $statusId = 1;
        $createdAt = $currentTime;
        $methodId = 1;
        $description = null;
        $promoCode = null;

        if (isset($obj['email'])) {
            $email = $obj['email'];
        }
        if (isset($obj['fullname'])) {
            $fullName = $obj['fullname'];
        }
        if (isset($obj['phone'])) {
            $phone = $obj['phone'];
        }
        if (isset($obj['address'])) {
            $address = $obj['address'];
        }
        if (isset($obj['description'])) {
            $description = $obj['description'];
        }
        if (isset($obj['promo_code'])) {
            $promoCode = $obj['promo_code'];
        }
        if (isset($obj['country'])) {
            $country = $obj['country'];
        }
        if (isset($obj['province'])) {
            $province = $obj['province'];
        }
        if (isset($obj['city'])) {
            $city = $obj['city'];
        }
        if (isset($obj['poscode'])) {
            $poscode = $obj['poscode'];
        }

        /*  while(true){
              $count = DB::table('user_orders')
                  ->select('*')
                  ->where('id' ,$id)->count();

              if($count>0){
                  $id =
             }

          }*/
        if($request->session()->get('cart')!=null) {
            $products = $request->session()->get('cart');

            if (count($products) == 0) {
                return redirect('/shop');
            }

        }else{
            return redirect('/shop');
        }

        while(true){

            try {
                // insert user order
                DB::table('user_orders')->insert(
                    ['id' => $id, 'email' => $email, 'fullname' => $fullName, 'phone_number' => $phone, 'address' => $address,
                        'status_id' => $statusId, 'created_at' => $createdAt, 'method_id' => $methodId, 'description' => $description,
                        'promo_code' => $promoCode, 'country' => $country, 'province' => $province, 'city' => $city, 'postal_code' => $poscode]
                );
                //
                break;
            }catch (\Exception $ex){
                $id = base_convert(time(), 10, 36);
            }
        }
        // insert order detail
        $totalBill = 0;
        if($request->session()->get('cart')!=null) {
            $products = $request->session()->get('cart');

            if(count($products)==0){
                return redirect('/shop');
            }

            for ($i = 0; $i < count($products); $i++) {
                $orderId = $id;
                $productId = $products[$i]["product_id"];
                $productName = $products[$i]["product_name"];
                $imageName = $products[$i]["image_name"];
                $size = $products[$i]["size_name"];
                $price = $products[$i]["price"];
                $quantity = $products[$i]["quantity"];
                DB::table('order_detail')->insert(
                    ['order_id'=> $orderId,'product_name'=> $productName,'image_name'=>$imageName,'size'=> $size,'price'=> $price,'quantity'=> $quantity]
                );
                $totalBill += (((int)$products[$i]["price"])*((int)$products[$i]["quantity"]));

            }
        }else{
            return redirect('/shop');
        }
        //


        //remove cart session
        $request->session()->remove('cart');
        //

        //send email to customer

        //

        //send email to seller

        //

        $data = array(
            'total_bill' => $totalBill,
            'order_id' => $id

        );


        return view("pages.checkout_success")->with($data);
    }

    public function checkoutSuccess()
    {
        $orderId = "null";
        $totalBill = 0;

        $data = array(
            'total_bill' => $totalBill,
            'order_id' => $orderId

        );
        return view("pages.checkout_success")->with($data);
    }

    public function confirmPayment(){

        $data = array(
            'successMessage' => '',
            'errorMessage' => ''
        );

        return view("pages.confirm_payment")->with($data);
    }


    public function confirmPaymentSubmit(Request $request){

        $this->validate($request, [
            'order_id' => 'required',
            'transfered_to' => 'required',
            'payment_account_number' => 'required',
            'payment_account_name' => 'required',
            'payment_amount' => 'required|Numeric',
            'pay_day' => 'required|Numeric',
            'pay_month' => 'required|Numeric',
            'pay_year' => 'required|Numeric'
        ]);
        $successMessage = "";
        $errorMessage = "";

        $obj = $request->post();

        $select = DB::table('user_orders')
            ->select('*')
            ->where('id' ,$obj["order_id"])->first();

        if(count($select)==1) {
            $newFileName = $select->proof_image;
            if( $request->hasFile('proof_image') ) {
                $file = $request->file('proof_image');

                $ext = $file->getClientOriginalExtension();

                $newFileName = $obj['order_id'] . '.' . $ext;
            }
            $update = DB::table('user_orders')
                ->where('id', $obj["order_id"])
                ->where(function ($query) {
                    $query->where('status_id', 1)
                        ->orWhere('status_id', 2);
                })
                ->update([
                    'transfered_to' => $obj["transfered_to"],
                    'customer_bank_account_name' => $obj["payment_account_name"],
                    'customer_bank_account_number' => $obj["payment_account_number"],
                    'customer_payment_amount' => $obj["payment_amount"],
                    'customer_transfer_date' => $obj["pay_year"] . "-" . $obj["pay_month"] . "-" . $obj["pay_day"],
                    'status_id' => 2,
                    'proof_image' => $newFileName
                ]);

            if($update ==true){
                $successMessage = "Confirm Payment Success";

                if( $request->hasFile('proof_image') ) {
                    $file = $request->file('proof_image');

                    $ext = $file->getClientOriginalExtension();

                    $newFileName = $obj['order_id'].'.'.$ext;

                    $file->storeAs('/public/proof/',$newFileName);
                    // $file->store('proof/');
                }
            }

        }else{
            $errorMessage = "Can't find order id";
        }
        $data = array(
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage
        );

        return view("pages.confirm_payment")->with($data);
    }


    public function trackOrder(Request $request){

        $data = array(
            'successMessage' => '',
            'errorMessage' => ''
        );

        return view("pages.track_order")->with($data);
    }


    public function trackOrderSubmit(Request $request){
        if(!$this->isUserAdmin()){

            return redirect('/admin');
        }
        $this->validate($request, [
            'order_id' => 'required'
        ]);
        $obj = $request->post();
        $errorMessage = '';
        $userOrders = array(1);
        $orderDetails = '';

        $select = DB::table('user_orders')
            ->select('*')
            ->where('id' ,$obj["order_id"])->first();


        if(count($select)==1) {
            $userOrders = DB::select("select 
                                      uo.id, uo.fullname, uo.phone_number, uo.postal_code, uo.address, uo.country, uo.province, uo.city, 
                                      uo.status_id, s.name as status_name 
                                      from user_orders as uo 
                                      inner join status as s on uo.status_id = s.id 
                                      where uo.id='" . $obj['order_id'] . "'");

            $orderDetails = DB::select("select 
                                      order_id, product_name, `size`, price, quantity, image_name 
                                      from order_detail as od 
                                      where order_id='" . $obj['order_id'] . "'");

        }else{

            $errorMessage = "Can't find order id";
        }

        $data = array(
            'errorMessage' => $errorMessage,
            'userOrders' => $userOrders[0],
            'orderDetails' => $orderDetails
        );

        if(count($select)==1) {
            return view("pages.track_order_submit")->with($data);
        }else{
            return view("pages.track_order")->with($data);
        }

    }

    public function isUserAdmin()
    {
        $isAdmin = false;
        if(Auth::check()){
            if(Auth::user()->role_group_id == 1){
                $isAdmin = true;
            }
        }

        return $isAdmin;
    }
    public function adminLogin(){
        if($this->isUserAdmin()){
            return redirect('/admin/order');
        }

        $data = array(

        );
        return view("admin.pages.adminlogin")->with($data);
    }

    public function adminLogout(){

        Auth::logout();
        return redirect('/admin');
    }

    public function adminLoginPost(Request $request){


        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(auth()->attempt(['email'=>$request->email,'password'=>$request->password])){

            return redirect('/admin/order');
        }else {
            $data = array(
                'warning' =>  'Address email or/and password are incorrect.'

            );

            return view("admin.pages.adminlogin")->with($data);
        }

    }

    public function adminOrder(){
        if(!$this->isUserAdmin()){

            return redirect('/admin');
        }

        $userOrders = DB::select('select uo.id, uo.fullname, uo.status_id, uo.customer_bank_account_number, 
                                  uo.customer_bank_account_name, uo.transfered_to, s.name as status_name 
                                  from user_orders as uo 
                                  inner join status as s on uo.status_id=s.id 
                                  order by id desc ');


        $data = array(
            "userOrders" => $userOrders
        );

        return view("admin.pages.order")->with($data);

    }

    public function adminOrderDetails($userOrderId){
        if(!$this->isUserAdmin()){

            return redirect('/admin');
        }
        $userOrder = DB::select("select uo.*, s.name as status_name 
                                 from user_orders as uo inner join status as s on uo.status_id=s.id 
                                 where uo.id='".$userOrderId."'");

        $orderDetails = DB::select("select 
                                      order_id, product_name, `size`, price, quantity, image_name 
                                      from order_detail as od 
                                      where order_id='".$userOrderId."'");
        $data = array(
            "userOrder" => $userOrder[0],
            'orderDetails' => $orderDetails

        );

        return view("admin.pages.order_details")->with($data);
    }



    public function adminOrderProceed($userOrderId){
        if(!$this->isUserAdmin()){

            return redirect('/admin');
        }
        $data = array(
            'orderId' => $userOrderId
        );

        return view("admin.pages.order_proceed")->with($data);
    }

    public function adminOrderProceedSubmit(Request $request){
        if(!$this->isUserAdmin()){

            return redirect('/admin');
        }
        $this->validate($request, [
            'pay_day' => 'required|Numeric',
            'pay_month' => 'required|Numeric',
            'pay_year' => 'required|Numeric'
        ]);

        $obj = $request->post();

        $update = DB::table('user_orders')
            ->where('id', $obj["order_id"])
            ->update([
                'status_id' => 3,
                'finished_at' => $obj["pay_year"] . "-" . $obj["pay_month"] . "-" . $obj["pay_day"],
            ]);

        $data = array(

        );
        return redirect('/admin/order-details/'.$obj['order_id']);
    }

    public function adminOrderComplete($userOrderId){
        if(!$this->isUserAdmin()){

            return redirect('/admin');
        }
        $data = array(
            'orderId' => $userOrderId
        );

        return view("admin.pages.order_complete")->with($data);
    }
    public function adminOrderCompleteSubmit(Request $request){
        if(!$this->isUserAdmin()){

            return redirect('/admin');
        }
        $obj = $request->post();

        $update = DB::table('user_orders')
            ->where('id', $obj["order_id"])
            ->update([
                'status_id' => 4,
                'courir' => $obj['courir'],
                'no_resi' => $obj['no_resi']
            ]);

        $data = array(

        );
        return redirect('/admin/order-details/'.$obj['order_id']);
    }

    public function adminProducts(){

        if(!$this->isUserAdmin()){

            return redirect('/admin');
        }

        $products = DB::select('select *
                                    from product as uo 
                                    order by id desc ');


        $data = array(
            "products" => $products
        );

        return view("admin.pages.products")->with($data);

    }

    public function adminProductCreate(){

        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $categories = DB::select('select *
                                    from category as c');

        $data = array(
            "categories"=>$categories
        );

        return view("admin.pages.product_create")->with($data);

    }

    public function adminProductCreateSubmit(Request $request){

        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'image_1' => 'required'
        ]);

        $obj = $request->post();

        if($request->hasFile('image_1')) {

            $file = $request->file('image_1');

            $ext = $file->getClientOriginalExtension();

            $image1Name =  uniqid().'.'.$ext;

            // insert product
            $insertProduct = DB::table('product')->insert(
                ['category_id' => $obj["category"], 'name' => $obj['name'], 'description' => $obj['description'],'image_name' => $image1Name]
            );
            //
            $productId = DB::getPdo()->lastInsertId();

            if($insertProduct) {
                // insert product image
                $insertProductImage1 = DB::table('product_image')->insert(
                    ['product_id' => $productId, 'name' => $image1Name]
                );
                //
                if($insertProductImage1) {
                    $file->storeAs('/public/products/', $image1Name);
                }
            }
        }


        return redirect('/admin/products/');

    }

    public function adminProductUpdate($productId){

        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $product = DB::select("select p.*, c.name as category_name 
                                    from product as p 
                                    inner join category as c on p.category_id = c.id where p.id = '".$productId."'");

        $categories = DB::select('select *
                                    from category as c');


        $data = array(
            "product" => $product[0],
            "categories"=>$categories

        );
        return view("admin.pages.product_update")->with($data);
    }

    public function adminProductUpdateSubmit(Request $request){

        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $this->validate($request, [
            'name' => 'required',
            'category' => 'required'
        ]);

        $obj = $request->post();


        if($request->hasFile('image')) {
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();

            $imageName =  uniqid().'.'.$ext;

            $update = DB::table('product')
                ->where('id', $obj["product_id"])
                ->update([
                    'category_id' => $obj["category"],'name' => $obj["name"],
                    'description' => $obj["description"], 'image_name' => $imageName
                ]);
            if($update) {
                $file->storeAs('/public/products/', $imageName);
            }
        }else{

            $update = DB::table('product')
                ->where('id', $obj["product_id"])
                ->update([
                    'category_id' => $obj["category"],'name' => $obj["name"],
                    'description' => $obj["description"]
                ]);

        }

        return redirect('/admin/products/');
    }


    public function adminProductDetails($productId,$tab)
    {
        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $product = DB::select('select p.*, c.name as category_name 
                                    from product as p 
                                    inner join category as c on p.category_id = c.id where p.id = '.$productId);

        $productSize =  DB::select('select ps.*, s.name as size_name 
                                    from product_size as ps
                                    inner join `size` as s on ps.size_id = s.id where ps.product_id = '.$productId);

        $productImage =  DB::select('select *
                                    from product_image
                                    where product_id = '.$productId);

        $data = array(
            "product" => $product[0],
            "productSize" => $productSize,
            "productImage" => $productImage,
            "tab" => $tab
        );


        return view("admin.pages.product_details")->with($data);
    }


    public function adminProductDelete(Request $request){
        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $obj = $request->post();
        DB::table('product')
            ->where('id', $obj["product_id"])
            ->update([
                'active' => 0
            ]);

        return redirect('/admin/products');
    }

    public function adminProductActivate(Request $request){
        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $obj = $request->post();
        DB::table('product')
            ->where('id', $obj["product_id"])
            ->update([
                'active' => 1
            ]);

        return redirect('/admin/product-details/'.$obj["product_id"].'/1');
    }
    public function adminProductDeactivate(Request $request){
        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $obj = $request->post();
        DB::table('product')
            ->where('id', $obj["product_id"])
            ->update([
                'active' => 0
            ]);

        return redirect('/admin/product-details/'.$obj["product_id"].'/1');
    }
    public function adminProductSizeCreate($productId){

        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $size =  DB::select('select s.* from `size` as s');

        $data = array(
            "productId" => $productId,
            "size" => $size
        );
        return view("admin.pages.product_size_create")->with($data);
    }

    public function adminProductSizeCreateSubmit(Request $request){
        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $this->validate($request, [
            'size' => 'required',
            'dimension' => 'required',
            'flower_amount' => 'required',
            'price' => 'required|Numeric'
        ]);

        $obj = $request->post();

        // insert product size
        DB::table('product_size')->insert(
            ['product_id' => $obj["product_id"], 'size_id' => $obj['size'], 'dimension' => $obj['dimension'],
                'flower_amount' => $obj['flower_amount'], 'price' => $obj['price']]
        );
        //

        return redirect('/admin/product-details/'.$obj["product_id"].'/1');
    }

    public function adminProductSizeDelete(Request $request){
        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $obj = $request->post();
        DB::table('product_size')->where('id', '=', $obj["product_size_id"])->delete();


        return redirect('/admin/product-details/'.$obj["product_id"].'/1');
    }

    public function adminProductImageCreate($productId){
        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $data = array(
            "productId" => $productId,
        );
        return view("admin.pages.product_image_create")->with($data);
    }
    public function adminProductImageCreateSubmit(Request $request){
        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $this->validate($request, [
            'image' => 'required'
        ]);

        $obj = $request->post();

        if($request->hasFile('image')) {

            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();

            $imageName = uniqid() . '.' . $ext;

            // insert product size
            $insert = DB::table('product_image')->insert(
                ['product_id' => $obj["product_id"], 'name' => $imageName]
            );
            //
            if($insert) {
                $file->storeAs('/public/products/', $imageName);
            }
        }

        return redirect('/admin/product-details/'.$obj["product_id"].'/2');
    }

    public function adminProductImageDelete(Request $request){
        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $obj = $request->post();
        $delete = DB::table('product_image')->where('id', '=', $obj["product_image_id"])->delete();

        if($delete) {
            // File::delete(public_path().'/storage/products/'.$obj["image_name"]);
        }

        return redirect('/admin/product-details/'.$obj["product_id"].'/2');
    }

    public function adminProductSetNewOld(Request $request){
        if(!$this->isUserAdmin()){
            return redirect('/admin');
        }

        $obj = $request->post();
        DB::table('product')
            ->where('id', $obj["product_id"])
            ->update([
                'new' => $obj["new"]
            ]);

        return redirect('/admin/products');
    }
}
