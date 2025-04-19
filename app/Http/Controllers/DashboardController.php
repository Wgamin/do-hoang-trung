<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Phone;
use App\Models\ServiceCard;
use App\Models\ServiceType;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'bannerCount' => Banner::count(),
            'serviceTypeCount' => ServiceType::count(),
            'serviceCardCount' => ServiceCard::count(),
            'phoneCount' => Phone::count(),
        ];

        return view('dashboard.index', $data);
    }
}

