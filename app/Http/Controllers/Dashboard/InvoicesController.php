<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Invoices\Invoice;
use App\Models\Invoices\InvoiceActivities;
use App\Models\Activities\Activity;
use App\Models\Projects\Project;
use App\Models\User;
use App\Support\CreatePdfFile;
// Requests
use App\Http\Requests\Dashboard\Invoices\StoreRequest;
use App\Http\Requests\Dashboard\Invoices\UpdateRequest;

class InvoicesController extends Controller {

    public function index() {
        if (!permissionCheck('invoices.view')) {
            return abort(403);
        }
        $lists = Invoice::query();
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
        return view('admin.invoices.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('invoices.create')) {
            return abort(403);
        }
        $projects = Project::where('is_active', 1)->get();
        $clients = User::where('type','client')->where('is_active', 1)->get();
        $freelancers = User::where('type','freelancer')->where('is_active', 1)->get();
        $activities = Activity::where('is_active', 1)->get();
        return view('admin.invoices.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('invoices.create')) {
            return abort(403);
        }
        $data = $request->all();
        $data['number'] = time();
        if (isset($data['is_tax'])) {
            $data['is_tax'] == 1;
        }else{
            $data['is_tax'] = 0;
        }
        if ($request->has('signature') && $request->signature != NULL) {
            $data['signature']  = imageUpload($request->signature, 'invoices');
        }
        $invoice = Invoice::create($data);
        if ($request->has('activities') && !is_null(request('activities'))) {
            foreach ($data['activities']['id'] as $i => $tp) {
                if ($data['activities']['price'][$i] && $data['activities']['price'][$i] != '' && $data['activities']['price'][$i] != ' ') {
                    InvoiceActivities::create([
                        'invoice_id'    => $invoice->id,
                        'activity_id'   => $data['activities']['id'][$i],
                        'price'         => $data['activities']['price'][$i],
                        'description'   => $data['activities']['description'][$i],
                    ]);
                }
                $i++;
            }
        }
        return redirect()->route('app.invoices.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit(Invoice $invoice) {
        if (!permissionCheck('invoices.update')) {
            return abort(403);
        }
        $projects = Project::where('is_active', 1)->get();
        $clients = User::where('type','client')->where('is_active', 1)->get();
        $freelancers = User::where('type','freelancer')->where('is_active', 1)->get();
        $activities = Activity::where('is_active', 1)->get();
        return view('admin.invoices.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, Invoice $invoice) {
        if (!permissionCheck('invoices.update')) {
            return abort(403);
        }
        $data = $request->all();
        if (isset($data['is_tax'])) {
            $data['is_tax'] == 1;
        }else{
            $data['is_tax'] = 0;
        }
        if ($request->has('signature') && $request->signature != NULL) {
            $data['signature']      = imageUpload($request->signature, 'invoices', [], false, true, $invoice->signature);
        }else{
            unset($data['signature']);
        }
        $invoice->update($data);
        if ($request->has('activities') && !is_null(request('activities'))) {
            InvoiceActivities::where('invoice_id', $invoice->id)->delete();
            foreach ($data['activities']['id'] as $i => $tp) {
                if ($data['activities']['price'][$i] && $data['activities']['price'][$i] != '' && $data['activities']['price'][$i] != ' ') {
                    InvoiceActivities::create([
                        'invoice_id'    => $invoice->id,
                        'activity_id'   => $data['activities']['id'][$i],
                        'price'         => $data['activities']['price'][$i],
                        'description'   => $data['activities']['description'][$i],
                    ]);
                }
                $i++;
            }
        }
        return redirect()->route('app.invoices.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy(Invoice $invoice) {
        if (!permissionCheck('invoices.delete')) {
            return abort(403);
        }
        DeleteImage($invoice->signature);
        $invoice->invoice_activities()->delete();
        $invoice->delete();
        return redirect()->route('app.invoices.index')->with('success', __('Data Deleted Successfully'));
    }

    public function print(Invoice $invoice) {
        return view('admin.invoices.print', get_defined_vars());
    }

    public function export_pdf(Invoice $invoice) {
        $html = view('admin.invoices.export', get_defined_vars())->render();
        // $pdf = (new CreatePdfFile())->getPdf($html)->setWaterMark(app_settings()->logo_path);
        $pdf = (new CreatePdfFile())->getPdf($html);
        return $invoice ? $pdf->output('invoices.pdf', "D") : redirect()->back()->with('error', __('No Data Founded'));
    }

    public function remove_signature(Invoice $invoice) {
        DeleteImage($invoice->signature);
        $invoice->update([
            'signature' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }
}
