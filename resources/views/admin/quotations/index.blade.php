@extends('admin.layouts.master')
@section('head_title'){{__('Quotations')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Quotations'),
        'route' =>  'quotations.index',
    ],
],'button' => [
        'title' => __('Add Quotation'),
        'route' =>  'quotations.create',
        'icon'  => 'plus'
]])

<div class="content-body">
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">@lang('Advanced Search')</h4>
                        <div class="card-title">
                            <button class="btn btn-primary btn-round waves-effect waves-float waves-light" title="{{__("Search")}}" style="padding: 10px 25px;" type="button" onclick="$('.dt_adv_search').submit()"><i data-feather="database"></i> @lang("Search")</button>
                            <button class="btn btn-warning btn-round waves-effect waves-float waves-light form-reset" title="{{__("Reset Search Data")}}" style="padding: 10px 25px;" type="button" onclick="resetForm();"><i data-feather="minus-circle"></i> @lang("Reset Search Data")</button>
                        </div>
                    </div>
                    <!--Search Form -->
                    <div class="card-body mt-2">
                        <form class="dt_adv_search" method="GET">
                            <div class="row g-1 mb-md-1">
                                <div class="col-md-4">
                                    <label class="form-label">@lang('Number')</label>
                                    <input type="text" name="number" class="form-control dt-input dt-full-name" value="{{old('number', request('number'))}}" data-column="1" placeholder="{{__('Number')}}" data-column-index="0" />
                                </div>
                                {{-- <div class="col-md-4">
                                    <label class="form-label" for="select2-basic">@lang('Client')</label>
                                    <select class="select-search" id="select2-basic" name="client_id">
                                        <option value="">@lang("Choose")</option>
                                        @foreach ($clients as $client)
                                                <option value="{{$client->id}}" @if (!is_null(request('client_id')) && request('client_id') == $client->id) selected @endif>{{$client->name}}</option>
                                            @endforeach
                                    </select>
                                </div> --}}
                                {{-- <div class="col-md-4">
                                    <label class="form-label" for="select3-basic">@lang('Status')</label>
                                    <select class="select-search" id="select3-basic" name="is_active">
                                        <option value="">@lang("Choose")</option>
                                        <option value="1" @if(!is_null(request('is_active')) && request('is_active') == 1) selected @endif>@lang("Active")</option>
                                        <option value="0" @if(!is_null(request('is_active')) && request('is_active') == 0) selected @endif>@lang("Un Active")</option>
                                    </select>
                                </div> --}}
                                <div class="col-md-4">
                                    <label class="form-label">@lang('Created At')</label>
                                    <input type="date" name="created_at" class="form-control dt-input" data-column="6" value="{{old('created_at', request('created_at'))}}" placeholder="{{__('mm/dd/yy')}}" data-column-index="5" />
                                </div>
                            </div>
                            <input type="hidden" name="filter" value="1"/>
                        </form>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body table-responsive">
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th {!! \table_width_head(1) !!}>#</th>
                                    <th>@lang('Number')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('Signature') </th>
                                    <th {!! \table_width_head(7) !!}>@lang('Total Price') </th>
                                    <th {!! \table_width_head(3) !!}>@lang('Is Tax') </th>
                                    <th {!! \table_width_head(7) !!}>@lang('Currance') </th>
                                    <th {!! \table_width_head(10) !!}>@lang('status') </th>
                                    <th {!! \table_width_head(10) !!}>@lang('Project') </th>
                                    <th {!! \table_width_head(5) !!}>@lang('User Type') </th>
                                    <th {!! \table_width_head(7) !!}>@lang('Person') </th>
                                    <th {!! \table_width_head(8) !!}>@lang('Created At')</th>
                                    <th {!! \table_width_head(15) !!}>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lists->count())
                                @foreach ($lists as $item)
                                    <tr>
                                        <td> {{$item->id}}</td>
                                        <td> {{$item->number ?? '-------'}} </td>
                                        <td> <img src="{{$item->signature_path}}" alt="{{$item->signature_path}}" style="width: 100px !important;">  </td>
                                        <td> {{$item->quotation_activities->sum('price') ?? '-------'}} </td>
                                        <td>
                                            @if($item->is_tax == 0)
                                                <i data-feather="x" stroke-width="7" style="color: red;"></i>
                                            @else
                                                <i data-feather="check" stroke-width="7" style="color: #00b800;"></i>
                                            @endif
                                        </td>
                                        <td> {{$item->currance ?? '-------'}} </td>
                                        <td> @lang(ucwords(strtolower(str_replace('_',' ',$item->status)))) </td>
                                        <td> {{$item->project->name ?? '-------'}} </td>
                                        <td> {{ucfirst($item->user_type) ?? '-------'}} </td>
                                        <td> {{$item->user->name ?? '-------'}} </td>
                                        <td> {{$item->created_at}} </td>
                                        <td>
                                            <?php $link = route('app.quotations.print', $item->id); ?>
                                            <a style="color: blue; border-color: blue !important;" class="btn btn-icon btn-outline-success waves-effect mr-1" onClick="MyWindow=window.open('{!! $link !!}','MyWindow','width=1000,height=500'); return false;"  title="{{__('Print')}}"><i data-feather="printer"></i></a>
                                            <a style="color: gold; border-color: gold !important;" class="btn btn-icon btn-outline-success waves-effect mr-1" href="{{route('app.quotations.export_pdf', $item->id)}}" title="{{__('Download PDF')}}"><i data-feather="file-text"></i></a>
                                            {!! editForm('quotations', $item) !!}
                                            {!! deleteForm('quotations', $item) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="no-records-found" style="text-align: center;">
                                    <td colspan="11">@lang('No Data Founded')</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <!-- start pagination -->
                        <div class="pagination-section">
                            <div class="container">
                                {!! $lists->links() !!}
                            </div>
                        </div>
                        <!-- start pagination -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Advanced Search -->
</div>
@endsection
