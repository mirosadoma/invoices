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
use App\Jobs\EmailJob;
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
            if (request()->has('client_name') && !empty(request('client_name'))) {
                $lists->whereHas("user", function($q){
                    return $q->where('name', 'LIKE', '%'.request('client_name').'%');
                });
            }
            // if (request()->has('client_id') && !is_null(request('client_id'))) {
            //     $lists->where('client_id', request('client_id'));
            // }
            // if (request()->has('is_active') && !is_null(request('is_active'))) {
            //     $lists->where('is_active', request('is_active'));
            // }
            if (request()->has('start_date') && !empty(request('start_date'))) {
                $lists->whereDate('created_at', '>=', request('start_date'));
            }
            if (request()->has('end_date') && !empty(request('end_date'))) {
                $lists->whereDate('created_at', '<=', request('end_date'));
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
        $data['number'] = mt_rand(100000, 999999);
        $data['status'] = 'unpaid';
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
            if (isset($data['activities']['id'])) {
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
            if (isset($data['activities']['id'])) {
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

    public function send_invoice_email(Invoice $invoice) {
        // Export PDF
        $destinationPath = 'uploads/invoices/pdf/';
        $html = 'admin/invoices/export';
        // Generate PDF
        $pdf = (new CreatePdfFile())->getPdf($html, get_defined_vars())->setPaper('A4', 'portrait')->build();
        $fileName = 'invoice_' . time() . '_' .  $invoice->id . '.pdf'; // Unique file name
        $pdf_public_path = public_path($destinationPath . $fileName); // Adjust the storage path if necessary

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        // Save PDF to the file system
        $pdf->save($pdf_public_path);
        // Email
        $client = $invoice->user;
        $data['user_name'] = $client->name;
        $data['user_email'] = $client->email;
        $data['project_name'] = __("Themarkrise");
        $data['welcome_msg'] = __("Welcome");
        $data['project_link'] = env('FRONT_URL', 'https://themarkrise.com/');
        $data['content'] = 'Pdf File : ' . url($destinationPath . $fileName);
        dispatch(new EmailJob($data, $client));
        return redirect()->back()->with('success', __('Invoice Send Successfully'));
    }

    public function export_pdf(Invoice $invoice) {
        // Export PDF
        $html = 'admin/invoices/export';
        // Generate PDF
        $pdf = (new CreatePdfFile())->getPdf($html, get_defined_vars())->setPaper('A4', 'portrait')->build();
        $fileName = 'invoice_' . time() . '_' .  $invoice->id . '.pdf'; // Unique file name
        return $invoice ? $pdf->download($fileName) : redirect()->back()->with('error', __('No Data Founded'));
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
