<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Projects\Project;
// Requests
use App\Http\Requests\Dashboard\Projects\StoreRequest;
use App\Http\Requests\Dashboard\Projects\UpdateRequest;
use App\Models\User;

class ProjectsController extends Controller {

    public function index() {
        if (!permissionCheck('projects.view')) {
            return abort(403);
        }
        $lists = Project::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->whereTranslationLike("name","%".request('name')."%");
            }
            if (request()->has('client_id') && !is_null(request('client_id'))) {
                $lists->where('client_id', request('client_id'));
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        $clients = User::where('type', 'client')->where('is_active', 1)->get();
        return view('admin.projects.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('projects.create')) {
            return abort(403);
        }
        $clients = User::where('type', 'client')->where('is_active', 1)->get();
        return view('admin.projects.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('projects.create')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('logo') && $request->logo != NULL) {
            $data['logo']  = imageUpload($request->logo, 'projects');
        }
        $data['is_active']  = 1;
        Project::create($data);
        return redirect()->route('app.projects.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit(Project $project) {
        if (!permissionCheck('projects.update')) {
            return abort(403);
        }
        $clients = User::where('type', 'client')->where('is_active', 1)->get();
        return view('admin.projects.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, Project $project) {
        if (!permissionCheck('projects.update')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('logo') && $request->logo != NULL) {
            $data['logo']      = imageUpload($request->logo, 'projects', [], false, true, $project->logo);
        }else{
            unset($data['logo']);
        }
        $project->update($data);
        return redirect()->route('app.projects.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy(Project $project) {
        if (!permissionCheck('projects.delete')) {
            return abort(403);
        }
        DeleteImage($project->logo);
        $project->delete();
        return redirect()->route('app.projects.index')->with('success', __('Data Deleted Successfully'));
    }
    public function is_active(Project $project)
    {
        if ($project->is_active == 0) {
            $project->update(['is_active' => 1]);
        }else{
            $project->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }

    public function remove_logo(Project $project) {
        DeleteImage($project->logo);
        $project->update([
            'logo' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }

    /*
    =================================================
    Invoice
    */

    public function create_invoice(Project $project) {
        if (!permissionCheck('projects.invoices')) {
            return abort(403);
        }
        $clients = User::where('type', 'client')->where('is_active', 1)->get();
        return view('admin.projects.invoices.create',get_defined_vars());
    }

    public function store_invoice(Project $project, StoreRequest $request) {
        if (!permissionCheck('projects.invoices')) {
            return abort(403);
        }
        $data = $request->all();
        dd($project, $data);
        Project::create($data);
        return redirect()->route('app.projects.index')->with('success', __('Data Saved Successfully'));
    }
}
