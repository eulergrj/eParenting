<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\FamilyMember;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request){        
        $user = \Auth::user();

        $Hour = date('G');
        $greeting = '';

        if ( $Hour >= 5 && $Hour <= 11 ) {
            $greeting = "Good Morning";
        } else if ( $Hour >= 12 && $Hour <= 18 ) {
            $greeting = "Good Afternoon";
        } else if ( $Hour >= 19 || $Hour <= 4 ) {
            $greeting = "Good Evening";
        }

        $fmembers = FamilyMember::where("user_id", $user->id)->get();

        $data = array(
            'greeting' => $greeting,
            'fmembers' => $fmembers
        );
        
        return view('backend.dashboard')->with($data);
    }

    public function account(Request $request){        
        return view('backend.user.account');
    }
}
