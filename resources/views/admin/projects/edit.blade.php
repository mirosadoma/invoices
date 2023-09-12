@extends('admin.layouts.master')
@section('head_title'){{__('Edit Project')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Projects'),
        'route' =>  'projects.index',
    ],
    [
        'name'  =>  __('Edit Project'),
        'route' =>  'projects.edit',
    ],
],'button' => [
        'title' => __('Back To Projects'),
        'route' =>  'projects.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Project") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.projects.update', $project->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                <div class="form-group row">
                    {!! Inputs('text', 'name', 'Name', 'form-control', old('name', $project->name??'')) !!}
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2">@lang('Client')</label>
                    <div class="input-icon right col-sm-10">
                        <select class="select-search form-control" name="client_id">
                            <option value="0" selected disabled>@lang('Choose')</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}" @if($client->id == $project->client_id) selected @endif>{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    {!! TextArea('details', 'Details', 'form-control ', old('details', $project->details??'')) !!}
                </div>
                <div class="form-group row">
                    {!! Inputs('file', 'logo', 'Logo', 'file-input form-control', $project->logo_path) !!}
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.projects.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Projects\UpdateRequest') !!}
    {{-- Logo --}}
    <script>
        $(".file-input").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$project->logo_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$project->logo}}", url: _url_+"app/projects/remove_logo/{{$project->id}}"}
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
