<?php

namespace App\Http\Controllers;

use App\Models\Fire;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class FireController extends Controller
{
    public function index()
    {
        return response(
            Fire::select(
                'NWCG_REPORTING_UNIT_ID as forest_id',
                'NWCG_REPORTING_UNIT_NAME as name',
                DB::raw('COUNT(*) as count')
            )
                ->groupBy('NWCG_REPORTING_UNIT_NAME')
                ->orderBy('name')
                ->paginate(20)
        );
    }

    public function show(string $id)
    {
        return response(
            Fire::select(
                'FPA_ID as fpa_id',
                'FIRE_NAME as name',
                DB::raw('date(DISCOVERY_DATE) as date'),
                'STAT_CAUSE_DESCR as cause'
            )
                ->where('NWCG_REPORTING_UNIT_ID', $id)
                ->orderBy('date', 'desc')
                ->paginate(20)
        );
    }
}
