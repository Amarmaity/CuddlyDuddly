<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function vendorDashboard(Request $request, $id){
        $data = "Welcome to Vendor Dash board". $id;
        return view('Pages.Vendor.VendorDashboard', compact('data'));
    }
}
