<?php

namespace App\Http\Controllers;

use App\Exports\ExportUsers;
use Excel;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function allUser(){
        $data = User::with('role')->where('roleId','!=',1)->get();
        return view('user.allUser', ['users'=>$data]);
    }
    public function statusUpdate($id){
        if (auth()->user()->roleId==1){
            $user = User::where('id',$id)->first();
            $user->status == 0? $user->status = 1:$user->status = 0;
            $user->update();
            return redirect()->back()->with('message','User Status Updated Successfully!');
        }else{
            return 'Good Try..';
        }
    }
    public function destroy($id){
        if (auth()->user()->roleId==1){
            $user = User::where('id',$id)->first();
            $user->delete();
            return redirect()->back()->with('message','User Deleted Successfully!');
        }else{
            return 'Good Try..';
        }
    }
    public function allAdminUser(){
        $data = User::with('role')->where('roleId','=',1)->get();
        return view('user.allAdminUser', ['users'=>$data]);
    }
    public function exportUsersData()
    {
        $fileName = 'users.xlsx';
        return Excel::download(new ExportUsers, $fileName);
    }
}
