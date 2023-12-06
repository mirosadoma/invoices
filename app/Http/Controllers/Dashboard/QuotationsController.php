<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Quotations\Quotation;
use App\Models\Quotations\QuotationActivities;
use App\Models\Activities\Activity;
use App\Models\Projects\Project;
use App\Models\User;
use App\Support\CreatePdfFile;
// Requests
use App\Http\Requests\Dashboard\Quotations\StoreRequest;
use App\Http\Requests\Dashboard\Quotations\UpdateRequest;

class QuotationsController extends Controller {

    public function index() {
        if (!permissionCheck('quotations.view')) {
            return abort(403);
        }
        $lists = Quotation::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('number') && !empty(request('number'))) {
                $lists->where("number",request('number'));
            }
            // if (request()->has('client_id') && !is_null(request('client_id'))) {
            //     $lists->where('client_id', request('client_id'));
            // }
            // if (request()->has('is_active') && !is_null(request('is_active'))) {
            //     $lists->where('is_active', request('is_active'));
            // }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        // $clients = User::where('type', 'client')->where('is_active', 1)->get();
        return view('admin.quotations.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('quotations.create')) {
            return abort(403);
        }
        $projects = Project::where('is_active', 1)->get();
        $clients = User::where('type','client')->where('is_active', 1)->get();
        $freelancers = User::where('type','freelancer')->where('is_active', 1)->get();
        $activities = Activity::where('is_active', 1)->get();
        return view('admin.quotations.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('quotations.create')) {
            return abort(403);
        }
        $data = $request->all();
        $data['number'] = mt_rand(100000, 999999);
        $data['status'] = 'waiting';
        if (isset($data['is_tax'])) {
            $data['is_tax'] == 1;
        }else{
            $data['is_tax'] = 0;
        }
        if ($request->has('signature') && $request->signature != NULL) {
            $data['signature']  = imageUpload($request->signature, 'quotations');
        }
        $quotation = Quotation::create($data);
        if ($request->has('activities') && !is_null(request('activities'))) {
            foreach ($data['activities']['id'] as $i => $tp) {
                if ($data['activities']['price'][$i] && $data['activities']['price'][$i] != '' && $data['activities']['price'][$i] != ' ') {
                    QuotationActivities::create([
                        'quotation_id'    => $quotation->id,
                        'activity_id'   => $data['activities']['id'][$i],
                        'price'         => $data['activities']['price'][$i],
                        'description'   => $data['activities']['description'][$i],
                    ]);
                }
                $i++;
            }
        }
        return redirect()->route('app.quotations.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit(Quotation $quotation) {
        if (!permissionCheck('quotations.update')) {
            return abort(403);
        }
        $projects = Project::where('is_active', 1)->get();
        $clients = User::where('type','client')->where('is_active', 1)->get();
        $freelancers = User::where('type','freelancer')->where('is_active', 1)->get();
        $activities = Activity::where('is_active', 1)->get();
        return view('admin.quotations.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, Quotation $quotation) {
        if (!permissionCheck('quotations.update')) {
            return abort(403);
        }
        $data = $request->all();
        if (isset($data['is_tax'])) {
            $data['is_tax'] == 1;
        }else{
            $data['is_tax'] = 0;
        }
        if ($request->has('signature') && $request->signature != NULL) {
            $data['signature']      = imageUpload($request->signature, 'quotations', [], false, true, $quotation->signature);
        }else{
            unset($data['signature']);
        }
        $quotation->update($data);
        if ($request->has('activities') && !is_null(request('activities'))) {
            QuotationActivities::where('quotation_id', $quotation->id)->delete();
            foreach ($data['activities']['id'] as $i => $tp) {
                if ($data['activities']['price'][$i] && $data['activities']['price'][$i] != '' && $data['activities']['price'][$i] != ' ') {
                    QuotationActivities::create([
                        'quotation_id'    => $quotation->id,
                        'activity_id'   => $data['activities']['id'][$i],
                        'price'         => $data['activities']['price'][$i],
                        'description'   => $data['activities']['description'][$i],
                    ]);
                }
                $i++;
            }
        }
        return redirect()->route('app.quotations.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy(Quotation $quotation) {
        if (!permissionCheck('quotations.delete')) {
            return abort(403);
        }
        DeleteImage($quotation->signature);
        $quotation->quotation_activities()->delete();
        $quotation->delete();
        return redirect()->route('app.quotations.index')->with('success', __('Data Deleted Successfully'));
    }

    public function print(Quotation $quotation) {
        return view('admin.quotations.print', get_defined_vars());
    }

    public function export_pdf(Quotation $quotation) {
        $html = view('admin.quotations.export', get_defined_vars())->render();
        // $pdf = (new CreatePdfFile())->getPdf($html)->setWaterMark(app_settings()->logo_path);
        $pdf = (new CreatePdfFile())->getPdf($html);
        return $quotation ?$pdf->output('quotations.pdf', "D") : redirect()->back()->with('error', __('No Data Founded'));
    }

    public function remove_signature(Quotation $quotation) {
        DeleteImage($quotation->signature);
        $quotation->update([
            'signature' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }
}
