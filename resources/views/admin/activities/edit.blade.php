@extends('admin.layouts.master')
@section('head_title'){{__('Edit Activity')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Activities'),
        'route' =>  'activities.index',
    ],
    [
        'name'  =>  __('Edit Activity'),
        'route' =>  'activities.edit',
    ],
],'button' => [
        'title' => __('Back To Activities'),
        'route' =>  'activities.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Activity") </h5>
        @if (count(app_languages()) > 1)
            <ul class="nav nav-tabs" role="tablist">
                @foreach(app_languages() as $key=>$one)
                    <li class="nav-item {{ $key == app()->getLocale() ? 'active' : '' }} tab-lang" data-id="tab-{{$key}}">
                        <a class="nav-link {{$errors->first($key.'.*') ? 'text-danger' : ''}}"  data-toggle="tab" href="#" role="tab">
                            <span class="hidden-sm-up"></span> <span class="hidden-xs-down">@lang($one['name'])</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.activities.update', $activity->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                @foreach(app_languages() as $key=>$one)
                    <div class="tab-pane {{ $key == app()->getLocale() ? 'active' : '' }}" id="tab-{{$key}}" role="tabpanel">
                        <div class="form-body">
                            <div class="form-group row">
                                {!! Inputs('text', $key.'[name]', 'Name', 'form-control', old($key.'.name', $activity->translate($key)->name??'')) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="text-right">
                    {!! BackButton('Back', route('app.activities.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Activities\UpdateRequest') !!}
@endpush
