<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('shop.checkout');
    }

    public function store(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = Charge::create([
            'amount' => 1000, // Amount in cents
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $request->input('stripeToken'),
        ]);

        // Handle success
        return redirect()->route('shop.index')->with('success', 'Payment successful!');
    }
}
