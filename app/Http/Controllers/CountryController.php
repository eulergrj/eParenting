<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index(){
        $countries = Country::get();                
        $data = array(
            'countries' => $countries,            
        );
        return view('backend.countries.index')->with($data);
    }

    public function nedit(Request $request){             
        $data = array();

        if(!!$request->id){
            $country = Country::where('id', $request->id)->first();                        
            $data["country"] = $country;          
        } 
        
        return view('backend.countries.nedit')->with($data);
    }

    public function upsert(Request $request){
        $data = array(
            'country_name' => $request->country_name,
            'country_code' => $request->country_code,
            'most_common' => !!$request->most_common ? true : false,
            'active' => !!$request->active ? true : false,
        );

        if(!!$request->id){
            Country::where('id', $request->id)->update($data);
            return redirect()->route('admin.countries')->withFlashSuccess("Country Updated");
        } else {
            Country::create($data);
            return redirect()->route('admin.countries')->withFlashSuccess("Country Added");
        }
        
    }

    public function remove($id){        
        $country = Country::find($id);    
        
        if($certicountryfier->learners()->count() > 0){            
            $msg = "This Country is being used by and therefore cannot be deleted!";
            return redirect()->route('admin.countries')->withFlashDanger($msg);
        } else {
            Certifier::destroy($id); 
            return redirect()->route('admin.countries')->withFlashSuccess("Country Removed");
        }
    }
    
}
