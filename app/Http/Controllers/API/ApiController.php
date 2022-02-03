<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Validator;

class ApiController extends Controller{
  public $successStatus = 200;

    /**
     * Products API
     *
     * @return \Illuminate\Http\Response
    */
    public function list(){        
        $products = Product::where('active', true)->with('type')->get();        
        return response()->json(['success' => $products], $this-> successStatus);
    }



    // public function updatePassword(Request $request){
    //     $res = $this->userRepository->updatePassword($request->only('old_password', 'password'));
    //     return response()->json(['success' => $res], $this-> successStatus);
    // }



    // public function updateProfile(Request $request){
    //   $user = Auth::user();

    //   $data = $request->all();

    //   if(!!$request->avatar){
    //     $image = $request->avatar;
    //     $imageName = Str::random(40).'.'.'png';

    //     \File::put(public_path() . '/storage/avatars/' . $imageName, base64_decode($image));
    //     $data['avatar_location'] = 'avatars/' . $imageName;
    //   } else {
    //     $data['avatar_location'] = $user->avatar_location;
    //   }


    //   $jsDateTS = strtotime($data['birthdate']);
    //   if ($jsDateTS !== false) $data['birthdate'] = date('Y-m-d', $jsDateTS );

    //   if(!isset($request->political)){
    //     $request->merge(['political' => 0]);
    //   }

    //   $res = $user->update([
    //       'first_name'        => $data['first_name'],
    //       'last_name'         => $data['last_name'],
    //       'display_name'      => $data['display_name'],
    //       'email'             => $data['email'],
    //       'avatar_location'   => $data['avatar_location'],
    //       'age_range'         => $data['age_range'],
    //       'gender'            => $data['gender'],
    //       'birthdate'         => $data['birthdate'],
    //       'drink_type'        => $data['drink_type'],
    //       'music_type'        => $data['music_type'],
    //       'relationship_type' => $data['relationship_type'],
    //       'cuisine_type'      => $data['cuisine_type'],
    //       'sport_type'        => $data['sport_type'],
    //       'political'         => $data['political'],
    //   ]);

    //   return response()->json(['success' => $user], $this-> successStatus);
    // }



    // public function getUserByUuid(Request $request){

    //   $user = User::select('id', 'first_name', 'last_name', 'display_name', 'email', 'avatar_location')
    //     ->where('uuid', $request->uuid)
    //     ->first()
    //     ->toArray();

    //   return response()->json(json_encode($user));

    // }




}
