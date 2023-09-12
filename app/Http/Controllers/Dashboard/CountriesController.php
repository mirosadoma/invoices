<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Countries\Country;
// Requests
use App\Http\Requests\Dashboard\Countries\StoreRequest;
use App\Http\Requests\Dashboard\Countries\UpdateRequest;

class CountriesController extends Controller {

    public function index() {
        if (!permissionCheck('countries.view')) {
            return abort(403);
        }
        $lists = Country::query();
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
        $lists = $lists->paginate();
        return view('admin.countries.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('countries.create')) {
            return abort(403);
        }
        return view('admin.countries.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('countries.create')) {
            return abort(403);
        }
        $data = $request->all();
        $data['is_active']  = 1;
        Country::create($data);
        return redirect()->route('app.countries.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($country) {
        if (!permissionCheck('countries.update')) {
            return abort(403);
        }
        $country = Country::find($country);
        return view('admin.countries.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $country) {
        if (!permissionCheck('countries.update')) {
            return abort(403);
        }
        $country = Country::find($country);
        $country->update($request->all());
        return redirect()->route('app.countries.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($country) {
        if (!permissionCheck('countries.delete')) {
            return abort(403);
        }
        $country = Country::find($country);
        $country->delete();
        return redirect()->route('app.countries.index')->with('success', __('Data Deleted Successfully'));
    }

    public function is_active($country)
    {
        $country = Country::find($country);
        if ($country->is_active == 0) {
            $country->update(['is_active' => 1]);
        }else{
            $country->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }
}
