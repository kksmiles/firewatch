<?php

namespace KkSmiles\Firewatch\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

class FirewatchErrorController extends Controller
{
    public function index()
    {
        return view('firewatch::errors.index');
    }
}