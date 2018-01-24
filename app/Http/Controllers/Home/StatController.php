<?php
/**
 * 统计
 */

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatController extends Controller
{
    public function index()
    {
        return view('home.stat.index');
    }
}
