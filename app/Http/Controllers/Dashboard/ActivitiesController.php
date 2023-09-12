<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Activities\Activity;
// Requests
use App\Http\Requests\Dashboard\Activities\StoreRequest;
use App\Http\Requests\Dashboard\Activities\UpdateRequest;

class ActivitiesController extends Controller {

    public function index() {
        if (!permissionCheck('activities.view')) {
            return abort(403);
        }
        $lists = Activity::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->whereTranslationLike("name","%".request('name')."%");
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.activities.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('activities.create')) {
            return abort(403);
        }
        return view('admin.activities.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('activities.create')) {
            return abort(403);
        }
        $data = $request->all();
        $data['is_active']  = 1;
        Activity::create($data);
        return redirect()->route('app.activities.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($activity) {
        if (!permissionCheck('activities.update')) {
            return abort(403);
        }
        $activity = Activity::find($activity);
        return view('admin.activities.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $activity) {
        if (!permissionCheck('activities.update')) {
            return abort(403);
        }
        $activity = Activity::find($activity);
        $data = $request->all();
        $activity->update($data);
        return redirect()->route('app.activities.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($activity) {
        if (!permissionCheck('activities.delete')) {
            return abort(403);
        }
        $activity = Activity::find($activity);
        $activity->delete();
        return redirect()->route('app.activities.index')->with('success', __('Data Deleted Successfully'));
    }
    public function is_active($activity)
    {
        $activity = Activity::find($activity);
        if ($activity->is_active == 0) {
            $activity->update(['is_active' => 1]);
        }else{
            $activity->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }
}
