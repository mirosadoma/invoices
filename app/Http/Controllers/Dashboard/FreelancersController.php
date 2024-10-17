<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\User;
// Requests
use App\Http\Requests\Dashboard\Freelancers\StoreRequest;
use App\Http\Requests\Dashboard\Freelancers\UpdateRequest;
use App\Models\Countries\Country;

class FreelancersController extends Controller {

    public function index() {
        if (!permissionCheck('freelancers.view')) {
            return abort(403);
        }
        $lists = User::query()->where('type', 'freelancer')->where('id', '<>', 1);
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->where('name', 'LIKE', '%'.request('name').'%');
            }
            if (request()->has('email') && !empty(request('email'))) {
                $lists->where('email', 'LIKE', '%'.request('email').'%');
            }
            if (request()->has('phone') && !empty(request('phone'))) {
                $lists->where('phone', 'LIKE', '%'.request('phone').'%');
            }
            if (request()->has('country_id') && !empty(request('country_id'))) {
                $lists->where('country_id', 'LIKE', '%'.request('country_id').'%');
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
            $lists = $lists->orderBy('id', "DESC")->paginate();
        }elseif(request()->has('type')) {
            if (request('type') == "active") {
                $lists = $lists->where('is_active', 1)->orderBy('id', "DESC")->paginate()->appends(['type' => 'active']);
            }else if(request('type') == "unactive"){
                $lists = $lists->where('is_active', 0)->orderBy('id', "DESC")->paginate()->appends(['type' => 'unactive']);
            }else if(request('type') == "deleted"){
                $lists = $lists->onlyTrashed()->orderBy('id', "DESC")->paginate()->appends(['type' => 'deleted']);
            }else{
                $lists = $lists->orderBy('id', "DESC")->paginate();
            }
        }else{
            $lists = $lists->orderBy('id', "DESC")->paginate();
        }
        $countries = Country::all();
        return view('admin.freelancers.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('freelancers.create')) {
            return abort(403);
        }
        $countries = Country::all();
        return view('admin.freelancers.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('freelancers.create')) {
            return abort(403);
        }
        $data = $request->all();
        // if (request()->has('image') && $request->image != NULL) {
        //     $data['image']  = imageUpload($request->image, 'freelancers');
        // }
        // $data['password']   = bcrypt($request->password);
        $data['type']       = 'freelancer';
        $data['is_active']  = 1;
        $freelancer              = User::create($data);
        if (request()->has('role_name')) {
            $freelancer->syncRoles($request->role_name);
        }
        return redirect()->route('app.freelancers.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($freelancer) {
        if (\Auth::guard('admin')->user()->id != $freelancer) {
            if (!permissionCheck('freelancers.update')) {
                return abort(403);
            }
        }
        $freelancer = User::where('type', 'freelancer')->withTrashed()->find($freelancer);
        $countries = Country::all();
        return view('admin.freelancers.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $freelancer) {
        if (\Auth::guard('admin')->user()->id != $freelancer) {
            if (!permissionCheck('freelancers.update')) {
                return abort(403);
            }
        }
        $freelancer = User::where('type', 'freelancer')->withTrashed()->find($freelancer);
        $data = $request->all();
        // if (request()->has('image') && $request->image != NULL) {
        //     $data['image']      = imageUpload($request->image, 'freelancers', [], false, true, $freelancer->image);
        // }else{
        //     unset($data['image']);
        // }
        // if ($request->has("password") && !is_null($request->password)) {
        //     $data['password']   = bcrypt($request->password);
        // }else{
        //     unset($data['password']);
        // }
        $data['type']           = 'freelancer';
        $freelancer->update($data);
        return redirect()->route('app.freelancers.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($freelancer) {
        if (!permissionCheck('freelancers.delete')) {
            return abort(403);
        }
        $freelancer = User::where('type', 'freelancer')->withTrashed()->find($freelancer);
        $freelancer->delete();
        return redirect()->route('app.freelancers.index')->with('success', __('Data Deleted Successfully'));
    }

    public function deleteForever($freelancer) {
        if (!permissionCheck('freelancers.delete')) {
            return abort(403);
        }
        $freelancer = User::where('type', 'freelancer')->withTrashed()->find($freelancer);
        DeleteImage($freelancer->image);
        $freelancer->forceDelete();
        return redirect()->back()->with('success', __('Data Deleted Forever Successfully'));
    }

    public function restore($freelancer) {
        if (!permissionCheck('freelancers.delete')) {
            return abort(403);
        }
        $freelancer = User::where('type', 'freelancer')->withTrashed()->find($freelancer);
        $freelancer->restore();
        return redirect()->back()->with('success', __('Data Restore Successfully'));
    }

    public function is_active($freelancer)
    {
        $freelancer = User::where('type', 'freelancer')->withTrashed()->find($freelancer);
        if ($freelancer->is_active == 0) {
            $freelancer->update(['is_active' => 1]);
        }else{
            $freelancer->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }

    // public function remove_image($freelancer) {
    //     $freelancer = User::where('type', 'freelancer')->withTrashed()->find($freelancer);
    //     DeleteImage($freelancer->image);
    //     $freelancer->update([
    //         'image' => null
    //     ]);
    //     return response()->json([
    //         'message' => __('Image Deleted Successfully'),
    //     ]);
    // }
}
