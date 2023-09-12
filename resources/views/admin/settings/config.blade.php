@extends('admin.layouts.master')
@section('head_title'){{__('General Settings')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('General Settings'),
        'route' =>  ['settings.index','config'],
    ],
]])

<form role="form" action="{{route('app.settings.update','config')}}" method="post" enctype="multipart/form-data" Files>
    @csrf
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"> @lang("Edit General Settings") </h5>
            <ul class="nav nav-tabs" role="tablist">
                @foreach(app_languages() as $key=>$one)
                    <li class="nav-item {{ $key == app()->getLocale() ? 'active' : '' }} tab-lang" data-id="tab-{{$key}}">
                        <a class="nav-link {{$errors->first($key.'.*') ? 'text-danger' : ''}}"  data-toggle="tab" href="#" role="tab">
                            <span class="hidden-sm-up"></span> <span class="hidden-xs-down">@lang($one['name'])</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-body table-responsive">
            <fieldset>
                @foreach(app_languages() as $key=>$one)
                    <div class="tab-pane {{ $key == app()->getLocale() ? 'active' : '' }}" id="tab-{{$key}}" role="tabpanel">
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-lg-2 control-label text-semibold">@lang('Title')</label>
                                <div class="col-lg-10">
                                    <input type="text" name="{{$key.'[title]'}}" value="{{old($key.'.title', $setting->translate($key)->title??'')}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 control-label text-semibold">@lang('Company Name')</label>
                                <div class="col-lg-10">
                                    <input type="text" name="{{$key.'[company_name]'}}" value="{{old($key.'.company_name', $setting->translate($key)->company_name??'')}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! TextArea($key.'[terms_and_conditions]', 'Terms And Conditions', 'form-control ', old($key.'.terms_and_conditions', $setting ? $setting->translate($key)->terms_and_conditions:''), true, $key.'_terms_and_conditions') !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                <hr/>
                <div class="form-body">
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Email')</label>
                        <div class="col-lg-10">
                            <input type="email" name="email" value="{{$setting->email??''}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Phone')</label>
                        <div class="col-lg-10">
                            <input type="number" name="phone" value="{{$setting->phone??''}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Tax')</label>
                        <div class="col-lg-10">
                            <input type="number" name="tax" value="{{$setting->tax??''}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Logo')</label>
                        <div class="col-lg-10">
                            <input type="file" name="logo" value="{{$setting->logo_path??''}}" class="file-input logo">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </div>
    </div>
</form>
@endsection
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.11.4/standard-all/ckeditor.js"></script>
    <script>
        @foreach(app_languages() as $key=>$one)
            CKEDITOR.replace("{{$key}}"+'_terms_and_conditions', {
                colorButton_colors: '000,800000,8B4513,2F4F4F,008080,000080,4B0082,696969,' +
                    'B22222,A52A2A,DAA520,006400,40E0D0,0000CD,800080,808080,' +
                    'F00,FF8C00,FFD700,008000,0FF,00F,EE82EE,A9A9A9,' +
                    'FFA07A,FFA500,FFFF00,00FF00,AFEEEE,ADD8E6,DDA0DD,D3D3D3,' +
                    'FFF0F5,FAEBD7,FFFFE0,F0FFF0,F0FFFF,F0F8FF,E6E6FA,FFF',
                extraPlugins: 'colorbutton,justify',
                language: "{{$key}}",
                height:700,
            });
        @endforeach
    </script>
    {{-- Logo --}}
    <script>
        $(".logo").fileinput({
            allowedFileExtensions: ['jpg', 'png', 'gif', 'svg'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$setting->logo_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$setting->logo}}", url: _url_+"app/settings/remove_logo/{{$setting->id}}"}
            ],
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                abort = false;
            }
            return abort;
        });
    </script>
@endpush
