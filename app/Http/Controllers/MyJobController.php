<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = auth()->user()->employer->jobs()
            ->with(['employee','jobApplications','jobApplications.user'])
            ->withTrashed()
            ->latest()
            ->get();

        return view('my_job.index',[
            'jobs' => $jobs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'location',
            'salary',
            'description',
            'experience',
            'category'
        ]);

        auth()->user()->employer->jobs()->create($data);

        return redirect()->route('my-job.index')->with('success','added job successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $myJob)
    {
        return view('my_job.edit',[
            'job' => $myJob
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $myJob)
    {
        $data = $request->only([
            'title',
            'location',
            'salary',
            'description',
            'experience',
            'category'
        ]);
        $myJob->update($data);

        return redirect()
            ->route('my-job.index')
            ->with('success','edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob)
    {
        $myJob->delete();

        return redirect()
            ->route('my-job.index')
            ->with('success','Removed Successfully!');
    }
}
