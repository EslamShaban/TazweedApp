<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WashRequest;
use App\Models\CaptainRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
       
    public function __construct()
    {
        $this->middleware('permission:reports-read');
    }

    public function index()
    {           
        $wash_requests = WashRequest::get();

        return view('admin.reports.index', compact('wash_requests'));
    }

    public function bw_dates_report(Request $request)
    {

        $wash_requests = WashRequest::query();

        if ($request->status !== null) {
            $wash_requests->where('status', $request->status);
        }

        if ($request->from_date !== null) {
            $wash_requests->where('created_at', '>=', $request->from_date);
        }

        if ($request->to_date !== null) {
            $wash_requests->where('created_at', '<=', $request->to_date);
        }

        $wash_requests = $wash_requests->get();

        return view('admin.reports.index', compact('wash_requests'));
    }

    public function captain_reports(Request $request)
    {
        $wash_requests = collect();

        if($request->captain_id)
            $wash_requests = DB::table('wash_requests')
                            ->join('captain_requests', 'wash_requests.id', '=', 'captain_requests.wash_request_id')
                            ->where('captain_requests.captain_id', '=', $request->captain_id)
                            ->select('wash_requests.*', 'captain_requests.status as captain_response', 'captain_requests.distance')
                            ->get();

        return view('admin.reports.captain_reports', compact('wash_requests'));
    }

    public function captain_requests_statistics(Request $request)
    {
        $captain_statistics = array();
        
        if($request->captain_id){
            $captain_statistics['requests'] = WashRequest::where('captain_id', $request->captain_id)->count();
            $captain_statistics['approved_requests'] = DB::table('wash_requests')
                                                        ->join('captain_requests', 'wash_requests.id', '=', 'captain_requests.wash_request_id')
                                                        ->where('captain_requests.status', 'approve')
                                                        ->where('wash_requests.captain_id', '!=', $request->captain_id)
                                                        ->count();
            $captain_statistics['rejected_requests'] = CaptainRequest::where('captain_id', $request->captain_id)->where('status', 'reject')->count();
            $captain_statistics['no_action_requests'] = CaptainRequest::where('captain_id', $request->captain_id)->where('status', null)->count();

            $captain_statistics['tips'] = WashRequest::where('captain_id', $request->captain_id)->sum('tip');
                    
        }

        return view('admin.reports.captain_requests_statistics', compact('captain_statistics'));
    }

        
    public function bw_dates_orders_report(Request $request)
    {

        $orders = Order::query();

        if ($request->from_date !== null) {
            $orders->where('created_at', '>=', $request->from_date);
        }

        if ($request->to_date !== null) {
            $orders->where('created_at', '<=', $request->to_date);
        }

        $orders = $orders->get();

        return view('admin.reports.bw_dates_orders_report', compact('orders'));
    }
}
