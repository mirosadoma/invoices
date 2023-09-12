@extends('admin.layouts.master')
@section('head_title'){{__('Add Invoice')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Invoices'),
        'route' =>  'invoices.index',
    ],
    [
        'name'  =>  __('Add Invoice'),
        'route' =>  'invoices.create',
    ],
],'button' => [
        'title' => __('Back To Invoices'),
        'route' =>  'invoices.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Add Invoice") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.invoices.store')}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                <div class="form-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2">@lang('Currance')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" name="currance">
                                <option value="0" selected disabled>@lang('Choose')</option>
                                <option value="USD" @if(old('currance') == "USD") selected @endif>@lang("USD")</option>
                                <option value="EGP" @if(old('currance') == "EGP") selected @endif>@lang("EGP")</option>
                                <option value="SAR" @if(old('currance') == "SAR") selected @endif>@lang("SAR")</option>
                                <option value="AED" @if(old('currance') == "AED") selected @endif>@lang("AED")</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2">@lang('Status')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" name="status">
                                <option value="0" selected disabled>@lang('Choose')</option>
                                <option value="paid" @if(old('status') == "paid") selected @endif>@lang(ucwords(strtolower(str_replace('_',' ','paid'))))</option>
                                <option value="unpaid" @if(old('status') == "unpaid") selected @endif>@lang(ucwords(strtolower(str_replace('_',' ','unpaid'))))</option>
                                <option value="in_process" @if(old('status') == "in_process") selected @endif>@lang(ucwords(strtolower(str_replace('_',' ','in_process'))))</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2">@lang('Projects')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" name="project_id">
                                <option value="0" selected disabled>@lang('Choose')</option>
                                @foreach ($projects as $project)
                                    <option value="{{$project->id}}" @if(old('project_id') == $project->id) selected @endif>{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-2" for="select2-basic">@lang('User Type')</label>
                        <div class="input-icon right col-sm-10">
                            <label for="client" style="margin: 0 7px;">
                                @lang("Client")
                                <input class="choose_user_typr" id="client" type="radio" name="user_type" value="client" @if(old('user_type') == "client") checked @endif>
                            </label>
                            <label for="freelancer" style="margin: 0 7px;">
                                @lang("Freelancer")
                                <input class="choose_user_typr" id="freelancer" type="radio" name="user_type" value="freelancer" @if(old('user_type') == "freelancer") checked @endif>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row show_persons show_clients" style="display: none">
                        <label class="control-label col-sm-2">@lang('Persons')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" name="user_id">
                                <option value="0" selected disabled>@lang('Choose')</option>
                                @foreach ($clients as $client)
                                    <option value="{{$client->id}}" @if(old('user_id')) selected @endif>{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row show_persons show_freelancers" style="display: none">
                        <label class="control-label col-sm-2">@lang('Persons')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" name="user_id">
                                <option value="0" selected disabled>@lang('Choose')</option>
                                @foreach ($freelancers as $freelancer)
                                    <option value="{{$freelancer->id}}" @if(old('user_id')) selected @endif>{{$freelancer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-2" for="select2-basic">@lang('Is Tax')</label>
                        <div class="input-icon right col-sm-10">
                            <label for="is_tax" style="margin: 0 7px;">
                                <input type="checkbox" id="is_tax" name="is_tax" value="1" @if(old('is_tax') == 1) checked @endif>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'signature', 'Signature', 'file-input signature form-control') !!}
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2">@lang('Activities')</label>
                        <div class="input-icon right col-sm-10">
                            <?php $n = rand(1,50); ?>
                            <div class="form-group row social_{{ $n }}">
                                <div class="col-sm-3">
                                    <select class="form-control norselect" name="activities[id][]">
                                        <option selected disabled>@lang("Choose Activity")</option>
                                        @foreach($activities as $activity)
                                            <option value="{{$activity->id}}">
                                                    {{$activity->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control" name="activities[price][]" type="text" placeholder="{{__("Price")}}">
                                </div>
                                <div class="col-sm-4">
                                    <textarea class="form-control" name="activities[description][]" placeholder="{{__("Description")}}"></textarea>
                                </div>
                                <div class="col-sm-1">
                                    <a class="btn btn-danger remove-contact" data-id="{{ $n }}">
                                        <center><b>X</b></center>
                                    </a>
                                </div>
                            </div>
                            <div class="other-contacts"></div>
                            <div class="form-group row">
                                <a class="btn btn-success add-other col-sm-3" style="margin: 10px 40px;"> + @lang("Add Another Activity")</a>
                            </div>
                        </div>
                    </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.invoices.index')) !!}
                    {!! SubmitButton('Save') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Invoices\StoreRequest') !!}
    <script>
        $('.choose_user_typr').on('click', function(){
            $('.show_persons').slideUp();
            if ($(this).val() == 'client') {
                $('.show_clients').slideDown();
            }else if ($(this).val() == 'freelancer') {
                $('.show_freelancers').slideDown();
            }
        });
        // signature
        $(".signature").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
        });
    </script>
    <script>
        $(document).on('click', '.add-other',function () {
            var parent = $(this).data('parent');
            var random = Math.floor(Math.random() * 100) + 1;
            var ct = '<div class="form-group row social_'+random+'">';
            ct += '<div class="col-sm-3">';
            ct += '<select class="form-control norselect" name="activities[id][]">';
            ct += '<option selected disabled>@lang("Choose Activity")</option>';
                @foreach($activities as $activity)
                    ct += '<option value="{{$activity->id}}">';
                    ct += "{{ $activity->name }}";
                    ct += '</option>';
                @endforeach
            ct += '</select>';
            ct += '</div>';
            ct += '<div class="col-sm-4">';
            ct += '<input class="form-control" name="activities[price][]" type="text" placeholder="{{__("Price")}}">';
            ct += '</div><div class="col-sm-4">';
            ct += '<textarea class="form-control" name="activities[description][]" placeholder="{{__("Description")}}"></textarea>';
            ct += '</div><div class="col-sm-1">';
            ct += '<a class="btn btn-danger remove-contact" data-id="'+random+'">';
            ct += '<center><b>X</b></center>';
            ct += '</a>';
            ct += '</div>';
            $('.other-contacts').append(ct);
        });

        $(document).on('click', '.remove-contact',function () {
            var id = $(this).attr('data-id');
            $('.social_'+id+' select').val('');
            $('.social_'+id+' input[name="activities[price][]"]').val('');
            $('.social_'+id+' textarea[name="activities[description][]"]').val('');
            $('.social_'+id).hide();
        });
    </script>
@endpush
