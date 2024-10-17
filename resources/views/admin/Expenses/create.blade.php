@extends('admin.layouts.master')
@section('head_title'){{__('Add Expense')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Expenses'),
        'route' =>  'expenses.index',
    ],
    [
        'name'  =>  __('Add Expense'),
        'route' =>  'expenses.create',
    ],
],'button' => [
        'title' => __('Back To Expenses'),
        'route' =>  'expenses.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Add Expense") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.expenses.store')}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'item', 'Item', 'form-control', old('item')) !!}
                    </div>
                    <div class="form-group row">
                        {!! TextArea('description', 'Description', 'form-control', old('description')) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('number', 'price', 'Price', 'form-control', old('price')) !!}
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2">@lang('Status')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" name="status">
                                <option value="0" selected disabled>@lang('Choose')</option>
                                <option value="on_hold" @if(old('status') == "on_hold") selected @endif>@lang(ucwords(strtolower(str_replace('_',' ','on_hold'))))</option>
                                <option value="paid" @if(old('status') == "paid") selected @endif>@lang(ucwords(strtolower(str_replace('_',' ','paid'))))</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'file', 'File', 'file-input file form-control') !!}
                    </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.expenses.index')) !!}
                    {!! SubmitButton('Save') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Expenses\StoreRequest') !!}
    <script>
        // file
        $(".file").fileinput({
            allowedFileExtensions: ['pdf'],
            initialCaption: "@lang('No File Selected')",
        });
    </script>
@endpush
