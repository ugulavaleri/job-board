<?php

namespace App\Http\Controllers;

class MyJobApplicationController extends Controller
{
    public function index()
    {
        return view('my_job_application.index',[
            'applications' => auth()->user()->jobApplications()->with('job.employee')->get()
        ]);
    }
    public function destroy(string $id)
    {
        //
    }
}
