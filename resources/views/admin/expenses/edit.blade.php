@extends('admin.layouts.master')
@section('head_title'){{__('Edit Expense')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Expenses'),
        'route' =>  'expenses.index',
    ],
    [
        'name'  =>  __('Edit Expense'),
        'route' =>  'expenses.edit',
    ],
],'button' => [
        'title' => __('Back To Expenses'),
        'route' =>  'expenses.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Expense") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.expenses.update', $expense->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'item', 'Item', 'form-control', old('item', $expense->item??'-----')) !!}
                    </div>
                    <div class="form-group row">
                        {!! TextArea('description', 'Description', 'form-control', old('description', $expense->description??'-----')) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('number', 'price', 'Price', 'form-control', old('price', $expense->price??'-----')) !!}
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2">@lang('Status')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" name="status">
                                <option value="0" selected disabled>@lang('Choose')</option>
                                <option value="on_hold" @if(old('status',$expense->status) == "on_hold") selected @endif>@lang(ucwords(strtolower(str_replace('_',' ','on_hold'))))</option>
                                <option value="paid" @if(old('status',$expense->status) == "paid") selected @endif>@lang(ucwords(strtolower(str_replace('_',' ','paid'))))</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'file', 'File', 'file-input file form-control', $expense->file_path) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.expenses.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Expenses\UpdateRequest') !!}
    {{-- file --}}
    <script>
        $(".file").fileinput({
            allowedFileExtensions: ['pdf'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$expense->file_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'file',
            initialPreviewConfig: [
                {caption: "{{$expense->file}}", url: _url_+"app/expenses/remove_file/{{$expense->id}}"}
            ],
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                console.log(jqXHR);
                abort = false;
            }
            return abort;
        });
    </script>
@endpush
