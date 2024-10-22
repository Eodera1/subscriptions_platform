<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Website;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
     // Method to subscribe a user to a website
     public function subscribe(Request $request, Website $website)
     {
         // Validate that an email address is provided
         $request->validate(['email' => 'required|email']);
 
         // Find or create a user based on the email provided in the request
         $user = User::firstOrCreate(
             ['email' => $request->email],
             ['name' => $request->name]
         );
 
         // Create a subscription for the user to the specified website
         $subscription = Subscription::firstOrCreate([
             'user_id' => $user->id,
             'website_id' => $website->id,
         ]);
 
         // Return the subscription as a response with a 201 status code
         return response()->json($subscription, 201);
     }
 }