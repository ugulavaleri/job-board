<?php

    namespace App\Http\Controllers;

    use App\Models\JobApplication;

    class MyJobApplicationController extends Controller
    {
        public function index()
        {
            return view("my_job_applications.index", [
                'applications' => auth()->user()->jobapplications()->latest()->with([
                    'job' => fn($query) => $query->withCount('jobApplications')->withAvg('jobApplications','expected_salary'),
                ])->get()
            ]);
        }

        public function destroy(JobApplication $my_job_application)
        {
            $my_job_application->delete();
            return redirect()->back()->with([
                'success' => 'Application canceled successfully!'
            ]);
        }
    }
