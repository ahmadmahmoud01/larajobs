<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{

    public function index(Request $request)
    {
        // $jobs = Job::all();

        // dd(request()->tags);

        $jobs = Job::where(function ($q) use ($request) {

            return $q->when(request(['search', 'tag']), function ($query) use ($request) {

                return $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('tags', 'like', '%' . $request->search . '%');
                    // ->orWhere('tags', 'like', '%' . $request->tag . '%');

            });

        })->latest()->paginate(3);
    // })->latest()->simplePaginate(3);

        return view('jobs.index', compact('jobs'));
    }//end of index

    public function create()
    {
        return view('jobs.create');
    }//end of create

    public function store(Request $request)
    {
        // dd($request->user_id);
        $request_data = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('jobs', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);



        if($request->hasFile('logo')) {

            $request_data['logo'] = $request->file('logo')->store('logos', 'public');

        }

        $request_data['user_id'] = auth()->id();

        // dd($request->all());
        Job::create($request_data);

        return redirect(route('jobs.index'))->with('message', 'Job Created Successfully!');

    }//end of store

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }//end of show

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }//end of edit

    public function update(Request $request, Job $job)
    {
        $request_data = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);



        if($request->hasFile('logo')) {

            // $request->file('logo')->delete();

            $request_data['logo'] = $request->file('logo')->store('logos', 'public');

        }

        $job->update($request_data);

        return redirect(route('jobs.index'))->with('message', 'Job Updated Successfully!');
    }//end of update

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect(route('jobs.index'))->with('message', 'Job Deleted Successfully!');


    }//end of destroy

    public function manage() {

        $jobs = auth()->user()->jobs;

        return view('jobs.manage', compact('jobs'));

    }
}
