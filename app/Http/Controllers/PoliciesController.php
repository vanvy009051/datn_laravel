<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoliciesController extends Controller
{
    public function term_and_conditions()
    {
        return view('pages.policies.term_conditions');
    }
}
