<?php

namespace App\Http\Controllers\Paypal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class paypalController extends Controller
{
    

    public function payment() 
    {
        // Here i will make array Have data of purshising
        $data = [];
        $data['items'] =
        [   
           [
            // name of product and value with associative aray
            'name' => 'Apple',
            'price' => 100,
            'description' => 'Macbook pro 14 inch',
            'qty' =>1

           ] 
        ];

        /**
         * Here the client will select product one and this is description like with it and what is route will gone 
         * after this process is done or he cancel
         */
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        // Here is total of salary
        $data['total'] = 100;

        /**
         * Here i will make object from ExpressCheckout
         * and i will pass @-param $data in object and with response
         */
        $provider = new ExpressCheckout($data);
        $respone = $provider->setExpressCheckout($data);
        $respone = $provider->setExpressCheckout($data,true);
        // After process success we want it to move to paypal link
        return redirect($respone['paypal_link']);

    }
    
    public function cancel() 
    {
        /**
         * Here i will make back to left page
         */
        dd('You are cancelled this payment');
    }

    
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function success(Request $request) 
    {
        $provider = new ExpressCheckout();
        // but here i will using get not set (to get details of data)
        $respone = $provider->getExpressCheckoutDetails($request->token);
        // Here i will make in array have stroupper that have small leter and ACK thats Meaning information 
        if(in_array(strtoupper($respone['ACK']) , ['SUCCESS' , 'SUCCESSWITHWARNING']))
        {
            dd('Your payment was successfully , Thanks');

        }
        
        // if failed return this like else of if
        dd('Please try again letter'); 
    }


    public function goPayment() 
    {
         return view('products.welcome');
    }
}
