<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Expenses\Expense;
// Requests
use App\Http\Requests\Dashboard\Expenses\StoreRequest;
use App\Http\Requests\Dashboard\Expenses\UpdateRequest;

class ExpensesController extends Controller {

    public function index() {
        if (!permissionCheck('expenses.view')) {
            return abort(403);
        }
        $lists = Expense::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('item') && !empty(request('item'))) {
                return $lists->where('item', 'LIKE', '%'.request('item').'%');
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.expenses.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('expenses.create')) {
            return abort(403);
        }
        return view('admin.expenses.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('expenses.create')) {
            return abort(403);
        }
        $data = $request->all();
        $data['number'] = mt_rand(100000, 999999);
        if ($request->has('file') && $request->file != NULL) {
            $data['file']  = fileUpload($request->file, 'expenses');
        }
        $expense = Expense::create($data);
        return redirect()->route('app.expenses.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit(Expense $expense) {
        if (!permissionCheck('expenses.update')) {
            return abort(403);
        }
        return view('admin.expenses.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, Expense $expense) {
        if (!permissionCheck('expenses.update')) {
            return abort(403);
        }
        $data = $request->all();
        if ($request->has('file') && $request->file != NULL) {
            $data['file']      = fileUpload($request->file, 'expenses', true, $expense->file);
        }else{
            unset($data['file']);
        }
        $expense->update($data);
        return redirect()->route('app.expenses.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy(Expense $expense) {
        if (!permissionCheck('expenses.delete')) {
            return abort(403);
        }
        DeleteFile($expense->file);
        $expense->delete();
        return redirect()->route('app.expenses.index')->with('success', __('Data Deleted Successfully'));
    }

    public function remove_file(Expense $expense) {
        DeleteImage($expense->file);
        $expense->update([
            'file' => null
        ]);
        return response()->json([
            'message' => __('File Deleted Successfully'),
        ]);
    }
}
