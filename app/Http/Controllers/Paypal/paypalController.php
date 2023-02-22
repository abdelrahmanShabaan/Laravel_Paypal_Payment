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
         * and i will pass @param $data in object and with response
         */
        $provider = new ExpressCheckout($data);
        $respone = $provider->setExpressCheckout($data);
        $respone = $provider->setExpressCheckout($data,true);
        // After process success we want it to move to paypal link
        return redirect($respone['paypal_link']);

    }
    
    public function cancel() 
    {
        
    }

    
    public function success() 
    {
        
    }
}
