<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\User;

use Illuminate\Http\Request;

class Admin extends Controller
{

    // Order
    public function getOrder(){
        $bill = Bill::all();
        $order= Order::all();
        $user=User::all(); 
        return view('Admin/order',compact('order','user','bill'));
    }

    public function get_Order(){
        
            return response()->json(Order::get(),200);
    
    }

    public function deleteOrder(Request $request,  $id){
        $order = Order::find($id);
        if(is_null($order)){
            return response()->json(["message"=>"Record Order not found!"],404);
        }
        $order->delete();
        return response()->json(null,204);
    }




    // Promotion
    public function getPromotion(){      
        return response()->json(Promotion::get(),200);
}

    public function deletePromotion(Request $request,  $id){
            $promotion = Promotion::find($id);
            if(is_null($promotion)){
                return response()->json(["message"=>"Record Promotion not found!"],404);
            }
            $promotion->delete();
            return response()->json(null,204);
        }

    public function PromotionByID($id){
        $promotion = Promotion::find($id);
        if(is_null($promotion)){
            return response()->json(["message"=>"Record not found!"],404);
        }
        return response()->json($promotion,200);
    }

        public function PromotionSave( Request $request){
            $promotion = new Promotion([
                'name' => $request->get('name'),
                'code' => $request->get('code'),
                'start_time' => $request->get('start_time'),
                'end_time' => $request->get('end_time'),
                'min_value' =>$request->get('min_value'),
                'max_value' =>$request->get('max_value'),
                'value' => $request->get('value')
            ]);

            $promotion->save();

            return response()->json($promotion,'success');
            echo "abc";
            }
            // }
            // $promotion = Promotion::create($request->all());
            // return response()->json($promotion,201);



        public function PromotionUpdate(Request $request,$id){
            $promotion = Promotion::find($id);
           
            $promotion->name =$request->name;
            $promotion->code=$request->code;
            $promotion->start_time=$request->start_time;
            $promotion->end_time=$request->end_time;
            $promotion->min_value=$request->max_value;
            $promotion->max_value=$request->max_value;
            $promotion->value=$request->value;

            $promotion->save();
      
        // return response()->json($products);
            
            if(is_null($promotion)){
                return response()->json(["message"=>"Record not found!"],404);
            }
            // $promotion->update($request->all());
            return response()->json($promotion,200);
        }



//User
    public function getUser(){  
        return response()->json(User::get(),200);  
    }

    public function deleteUser(Request $request,  $id){
        $user = User::find($id);
        // $user = User::where('account_id', $id)->delete();
        $order= Order::where('id_user', $id)->delete();
        if(is_null($user)){
            return response()->json(["message"=>"Record Promotion not found!"],404);
        }
        $user->delete();
        return response()->json(null,204);
    }




// Count in DASHBOARD

public function getCountAccount(){
    
    $count_account= User::count(); 
    return $count_account;
} 
}
    