<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //
    public function __construct(){
        $this->middleware(function($request,$next){

            if(auth()->user()->subscribed('main')){
                return redirect('/')->with('message',['warning',__("Actualmente ya estás suscrito a otro plan")]);
            }

            return $next($request);
        })->only(['plans','processSubscription']);
    }
    public function plans(){
        return view('subscriptions.plans');
    }
    public function processSubscription(){
        $token = \request('stripeToken');
        dd($token);
        try{
            if(\request()->has('coupon')){

                \request()->user()->newSubscription('main',\request('type'))
                ->withCoupon(\request('coupon'))->create($token);

            }else{

                \request()->user()->newSubscription('main',\request('type'))
                ->create($token);
            }

            return redirect(route('subscriptions.admin'))->with('message',['success', __("LA suscripción se ha llevado a cabo correctamente")]);

        }catch(\Exception $exception){
            $error = $exception->getMessage();
            return back()->with('message',['danger',$error]);
        }
    }
    public function admin(){
        return view('subscriptions.admin');
    }
}
