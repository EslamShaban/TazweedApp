<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\WashRequestRepository;

class WashRequestController extends Controller
{
        
    private $washRequestRepository;
    
    public function __construct(WashRequestRepository $washRequest)
    {
        $this->middleware('permission:wash_requests-read')->only(['index', 'show']);

        $this->washRequestRepository = $washRequest;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wash_requests = $this->washRequestRepository->latest();

        return view('admin.wash_requests.index', compact('wash_requests'));
    }

    public function show($id)
    {
        $wash_request = $this->washRequestRepository->find($id);

        return view('admin.wash_requests.show' , compact('wash_request'));
    }
}
