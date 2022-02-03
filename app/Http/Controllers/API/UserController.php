<?php
namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;

use App\Models\address;
use App\Models\Country;
use App\Models\County;


use App\Http\Controllers\PaymentSchemeController;

class UserController extends Controller{
  public $successStatus = 200;

  /**
   * Get User Info api
   *
   * @return \Illuminate\Http\Response
  */
  public function getUserInfo(Request $request){      
    $data = [];
    $user = User::where("id", $request->user_id)->first();

    $data['user'] = $user;

    return response()->json($data, $this->successStatus);
  }

  /**
   * login api
   *
   * @return \Illuminate\Http\Response
  */
  public function login(){      
    if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
        $data = [];
        $user = Auth::user();

        $data['token'] =  $user->createToken('MyApp')->accessToken;
        $data['user'] = $user;
        $data['success'] = true;

        return response()->json($data, $this->successStatus);
    }
    else{
        return response()->json(['error'=>'Unauthorised'], 401);
    }
  }
  

  /**
   * Register api
   *
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request){
      $validator = Validator::make($request->all(), [
          'fname'        => 'required',
          'lname'         => 'required',
          'email'             => 'required|email|unique:users',
          'password'          => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json(['error'=>$validator->errors()], 401);
      }
      
      $user = new User();
      $user->name = $request->fname . ' '  . $request->lname;
      $user->fname = $request->fname;
      $user->lname = $request->lname;
      $user->email = $request->email;
      $user->phone = $request->phone;
      $user->password = Hash::make($request->password);
      $user->save();
      
      if($user){
        $stripeCustomer = $user->createAsStripeCustomer();
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        
        
        $data = [];
        $data['user'] = $user;
        $data['success'] = true;

        return response()->json($data, $this->successStatus);
      }
  }

/**
 * Get User Info api
 *
 * @return \Illuminate\Http\Response
*/
public function getPaymentMethods(Request $request){      
  $user = User::where("id", $request->user_id)->first();
  // $paymentMethods = PaymentMethod::where("user_id", $request->user_id)->get();    
  
  if(!empty($user)){
    $paymentMethods = $user->paymentMethods();
    $success['paymentMethods'] = $paymentMethods;

    return response()->json(['success' => $success], $this->successStatus);

  } else {
    $error = array(
      'user' => $request->user_id,
      'errorMsg' => "Error retrieving user data", 
    );
    return response()->json($error, $this->successStatus);
  }
}


/**
 * Create new Payment Method
 *
 * @return \Illuminate\Http\Response
*/
public function createPaymentMethod(Request $request){      
  $user = User::where("id", $request->user_id)->first();
  $token = $request->token;

  if(!empty($user)){
    try {
      
      $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

      $pm = $stripe->paymentMethods->create([
        'type' => 'card',
        'card' => $request->card,
      ]);

      $res = $stripe->paymentMethods->attach(
        $pm->id,
        ['customer' => $user->stripe_id]
      );

      $data = array(
        'success' => true
      );
      return response()->json($data, $this->successStatus);

    } catch (\Throwable $th) {
      $data = array(
        'error' => true,
        'errorMsg' => $th->getMessage()
      );
      return response()->json($data, $this->successStatus);
    }
  }
}

/**
 * Remove Payment Method
 *
 * @return \Illuminate\Http\Response
*/
public function removePaymentMethod(Request $request){      
  $user = User::where("id", $request->user_id)->first();
  $token = $request->token;

  if(!empty($user)){

    try {
      $paymentMethod = $user->findPaymentMethod($request->pmid);

      $paymentMethod->delete();

      $data = array(
        'success' => true
      );
      return response()->json($data, $this->successStatus);

    } catch (\Throwable $th) {
      $data = array(
        'error' => true,
        'errorMsg' => $th->getMessage()
      );
      return response()->json($data, $this->successStatus);
    }
  }
}


/**
 * Pay
 *
 * @return \Illuminate\Http\Response
*/
public function pay(Request $request){   
  $user = User::where("id", $request->user_id)->first();
  $order = Order::where("id", $request->order_id)->first();

  if(!empty($user) && !empty($order)){
    try {

      \Stripe\Stripe::setApiKey( env('STRIPE_SECRET') );

      if (isset($request->payment_method)) {
        $intent = \Stripe\PaymentIntent::create([
          'amount' => $order->total_price * 100,
          'currency' => 'eur',
          'payment_method' => $request->payment_method,
          'customer' => $user->stripe_id,
          'confirmation_method' => 'manual',
          "confirm" => true,
        ]);
      }

      if (isset($request->payment_intent_id)) {
        $intent = \Stripe\PaymentIntent::retrieve( $request->payment_intent_id );
        $intent->confirm();
      }

      return $this->generateResponse($intent, $order);

    } catch (\Throwable $th) {

      if(!!$request->payment_intent_id){
        $order->order_statuses_id = OrderStatus::where("adminStatusIdentifier", 3)->first()->id;
        $order->save();
      }  

      $data = array(
        'error' => true,
        'errorMsg' => $th->getMessage()
      );
      return response()->json($data, $this->successStatus);
    }
  }
}

function generateResponse($intent, $order) {
  if ($intent->status == 'requires_action' && $intent->next_action->type == 'use_stripe_sdk') {
    
    $order->payment_id = $intent->id;
    $order->order_statuses_id = OrderStatus::where("adminStatusIdentifier", 2)->first()->id;
    $order->save();

    $data = array(
      'requires_action' => true,
      'payment_intent_client_secret' => $intent->client_secret
    );
    return response()->json($data, $this->successStatus);
    
  } else if ($intent->status == 'succeeded') {

    $order->payment_id = $intent->id;
    $order->order_statuses_id = OrderStatus::where("adminStatusIdentifier", 4)->first()->id;
    $order->save();

    $data = array(
      'success' => true
    );
    return response()->json($data, $this->successStatus);

  } else {
    
    $order->order_statuses_id = OrderStatus::where("adminStatusIdentifier", 3)->first()->id;
    $order->save();

    # Invalid status
    http_response_code(500);
    $data = array(
      'error' => true,
      "errorMsg" => "Invalid PaymentIntent status"
    );
    return response()->json($data, $this->successStatus);
  }
}


  /**
   * Get User Addresses
   *
   * @return \Illuminate\Http\Response
  */
  public function getAddresses(Request $request){      
    $user = User::where("id", $request->user_id)->first();
    
    if(!empty($user)){
      $addresses = $user->addresses()->get();

      $data = array(
        'success' => true,
        'addresses' => $addresses
      );
      return response()->json($data, $this->successStatus);
  

    } else {
      $error = array(
        'user' => $request->user_id,
        'errorMsg' => "Error retrieving user data", 
      );
      return response()->json($error, $this->successStatus);
    }
  }
  
  
  /**
   * Get getAddressesFormData
   *
   * @return \Illuminate\Http\Response
  */
  public function getAddressesFormData(Request $request){      

    try {
      $countries = Country::where("active", true)->get(["id", "country_name"]);
      $counties = County::where("active", true)->get(["id", "name"]);

      $data = array(
        'success' => true,
        'countries' => $countries,
        'counties' => $counties
      );
      return response()->json($data, $this->successStatus);

    } catch (\Throwable $th) {

      $data = array(
        'error' => true,
        'errorMsg' => "Error retrieving Addresses Form Data"
      );
      return response()->json($data, $this->successStatus);
    }
    
  }
  
  
  
  /**
   * POST Save Address
   *
   * @return \Illuminate\Http\Response
  */
  public function saveAddress(Request $request){     
    
    $return = [];

    $validator = Validator::make($request->all(), [
      'addressNickname' => 'required',
      'address1' => 'required',
      'country' => 'required',
      'city' => 'required',
      'postcode' => 'required',
    ]);

    if ($validator->fails()) {
      $return["validationError"] = true;
      $return["errors"] = $validator->errors();
      return response()->json($return, 401);
    }

    if($request->id){
      $address = address::where("id", $request->id)->first();
    } else {
      $address = new address();
    }

    $address->user_id         = $request->user_id;
    $address->addressNickname = $request->addressNickname;
    $address->address1        = $request->address1;
    $address->address2        = $request->address2;
    $address->address3        = $request->address3;
    $address->country_id      = $request->country;
    $address->county_id       = $request->county;
    $address->city            = $request->city;
    $address->postcode        = $request->postcode;

    try {
      $address->save();

      if($address){
        $return['success'] = true;
        $return["address"] = $address;
        return response()->json($return, $this->successStatus);
      }

    } catch (\Throwable $th) {
      if($address){
        $return['error'] = true;
        $return["errorMsg"] = $th->getMessage();
        return response()->json($return, $this->successStatus);
      }
    } 
    
    
  }




}
