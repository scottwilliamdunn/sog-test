<?php

namespace App\Http\Controllers;

use App\Models\Fire;
use Illuminate\Routing\Controller;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function view($id)
    {
        $forest = Fire::where('NWCG_REPORTING_UNIT_ID', $id)->firstOrFail()->NWCG_REPORTING_UNIT_NAME;
        return view('view', compact('id', 'forest'));
    }
}
