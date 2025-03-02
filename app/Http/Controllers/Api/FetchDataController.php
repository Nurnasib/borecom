<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad\AdBoost;
use App\Models\Ad\adFormBuilderValue;
use App\Models\Ad\adList;
use App\Models\Ad\BoostPrice;
use App\Models\Category;
use App\Models\FormBuilderInputValue;
use App\Models\Location\Area;
use App\Models\Location\city;
use App\Models\Location\Road;
use App\Models\Location\Zone;
use App\Models\Price;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\SubCategoryFormBuilder;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FetchDataController extends Controller
{
//    public function __construct() {
//        $this->middleware('api',['except' => ['getSubCategory','getInputValue']]);
//    }
    public function getAllUsers()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'message' => 'Fetch Successful',
            'data' => $users,
        ]);
    }
    public function getUser()
    {
        $user = User::where('id', \request('id'))->first();
        if (auth('api')->user()){
            return response()->json([
                'success' => true,
                'message' => 'Fetch Successful',
                'data' => $user,
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
    }
    public function getCategory()
    {
        $categories = Category::all();
        if (auth('api')->user()){
            return response()->json([
                'success' => true,
                'message' => 'Fetch Successful',
                'data' => $categories,
            ]);
        }else{
            return response()->json([
                'success' => true,
                'message' => 'Fetch Successful',
                'data' => $categories,
            ]);
        }
    }
}
