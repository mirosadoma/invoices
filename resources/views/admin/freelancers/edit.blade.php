@extends('admin.layouts.master')
@section('head_title'){{__('Edit Freelancer')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Freelancers'),
        'route' =>  'freelancers.index',
    ],
    [
        'name'  =>  __('Edit Freelancer'),
        'route' =>  'freelancers.edit',
    ],
],'button' => [
        'title' => __('Back To Freelancers'),
        'route' =>  'freelancers.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Freelancer") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.freelancers.update', $freelancer->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'name', 'Name', 'form-control', $freelancer->name) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('email', 'email', 'Email', 'form-control', $freelancer->email) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'phone', 'Phone', 'form-control', $freelancer->phone) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('password', 'password', 'Password', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('password', 'password_confirmation', 'Password Confirmation', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2">@lang('Country')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" name="country_id">
                                <option value="0" selected disabled>@lang('Choose')</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}" @if ($country->id == $freelancer->country_id) selected @endif>{{$country->translate('en')->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        {!! Inputs('file', 'image', 'Image', 'file-input form-control', $freelancer->image_path) !!}
                    </div> --}}
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.freelancers.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Freelancers\UpdateRequest') !!}
    {{-- <script>
        $(".file-input").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$freelancer->image_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$freelancer->image}}", url: _url_+"app/freelancers/remove_image/{{$freelancer->id}}"}
            ],
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                console.log(jqXHR);
                abort = false;
            }
            return abort;
        });
    </script> --}}
@endpush
