<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class CartController extends Controller
{
    public function addToCart(Request $request, $id) 
    {
        $product = DB::table('products')->where('id',$id)->first();

        $check = DB::table('pos')->where('pro_id',$id)->first();

        if($check) {
            DB::table('pos')->where('pro_id',$id)->increment('pro_qty');

            $product = DB::table('pos')->where('pro_id',$id)->first();
        $subtotal = $product->pro_qty * $product->pro_price;
        DB::table('pos')->where('pro_id',$id)->update(['subtotal' =>$subtotal]);

        }else{
            $data = array();

        $data['pro_id'] = $id;
        $data['pro_name'] = $product->product_name;
        $data['pro_qty'] =1;
        $data['pro_price'] = $product->selling_price;
        $data['subtotal'] = $product->selling_price;

        DB::table('pos') ->insert($data);

        }



        

    }

    public function cartProduct()
    {
        $cart = DB::table('pos')->get();
        return response()->json($cart);
    }

    public function removeCart($id) {
        $item = DB::table('pos')->where('id',$id)->delete();
        return response('done');
    }


    public function increment($id){
        $quantity = DB::table('pos')->where('id',$id)->increment('pro_qty');
        $product = DB::table('pos')->where('id',$id)->first();
        $subtotal = $product->pro_qty * $product->pro_price;
        DB::table('pos')->where('id',$id)->update(['subtotal' =>$subtotal]);
        return response('Done');

    }

    public function decrement($id){
        $quantity = DB::table('pos')->where('id',$id)->decrement('pro_qty');

        $product = DB::table('pos')->where('id',$id)->first();
        $subtotal = $product->pro_qty * $product->pro_price;
        DB::table('pos')->where('id',$id)->update(['subtotal' =>$subtotal]);
        return response('Done');

    }

    public function vat(){
        $vat = DB::table('extra')->first();
        return response()->json($vat);
    }

    public function orderdone(Request $request) {
        $validate = $request->validate([
            'customer_id' =>'required',
            'payby'=>'required'
        ]);

        $data =array();

        $data['customer_id'] = $request ->customer_id;
        $data['qty'] = $request ->qty;
        $data['subTotal'] = $request ->subTotal;
        $data['vat'] = $request ->vat;
        $data['total'] = $request ->total;
        $data['pay'] = $request ->pay;
        $data['due'] = $request ->due;
        $data['payby'] = $request ->payby;
        $data['order_date'] = date('d/m/y');
        $data['order_month'] = date('F');
        $data['order_year'] = date('Y');

        $orderID = DB::table('orders')->insertGetId($data);


        $contents = DB::table('pos')->get();
        $odata = array();
        foreach($contents as $content) {
            $odata['order_id'] = $orderID;
            $odata['product_id'] = $content->pro_id;
            $odata['product_qty'] = $content->pro_qty;
            $odata['product_price'] = $content->pro_price;
            $odata['sub_total'] = $content->subtotal;

            DB::table('order_details')->insert($odata);


        }
     


    }
}
