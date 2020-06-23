<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeCustomers extends Controller
{
    public function index()
    {
        return view('stripe-customer.create');
   }

    public function store(Request $request)
    {

        $options = [
            'email'             => $request->email,
            'name'              => $request->name,
            'description'       => 'Customer Via API',
            'phone'             => $request->phone,
            'address'           => [
                'line1'         => $request->street_address,
                'city'          => $request->city,
                'country'       => $request->country,
                'postal_code'   => $request->postal_code,
                'state'         => $request->state,
            ]
        ];
        try{
            auth()->user()->createAsStripeCustomer($options);
            return redirect()->back()->withMessage('Customer Created Successfully.');
        }
        catch(\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }


   }

    public function Update(Request $request)
    {
        $stripe = new StripeClientAlias(
            env('STRIPE_SECRET')
        );

        return $stripe->customers->update('cus_HVjwYpjQcW2EDG',
            [
                'email'             => $request->email,
                'name'              => $request->name,
                'description'       => 'Customer Via API',
                'phone'             => $request->phone,
                'address'           => [
                    'line1'         => $request->street_address,
                    'city'          => $request->city,
                    'country'       => $request->country,
                    'postal_code'   => $request->postal_code,
                    'state'         => $request->state,
                ]
            ]);

    }
}
