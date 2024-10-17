@extends('admin.layouts.master')
@section('head_title'){{__('Expenses')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Expenses'),
        'route' =>  'expenses.index',
    ],
],'button' => [
        'title' => __('Add Expense'),
        'route' =>  'expenses.create',
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
                            <button class="btn btn-primary btn-round waves-effect waves-float waves-light search_button" title="{{__("Search")}}" style="padding: 10px 25px;" type="button"> @lang("Search") <i data-feather="search"></i></button>
                            <button class="btn btn-warning btn-round waves-effect waves-float waves-light form-reset" title="{{__("Reset Search Data")}}" style="padding: 10px 25px;" type="button" onclick="resetForm();"> @lang("Reset Search Data") <i data-feather="minus-circle"></i></button>
                        </div>
                    </div>
                    <!--Search Form -->
                    <div class="card-body mt-2">
                        <form class="dt_adv_search" method="GET">
                            <div class="row g-1 mb-md-1">
                                <div class="col-md-4">
                                    <label class="form-label">@lang('Client Name')</label>
                                    <input type="text" name="client_name" class="form-control dt-input dt-full-name" value="{{old('client_name', request('client_name'))}}" data-column="1" placeholder="{{__('Client Name')}}" data-column-index="0" />
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
                                    <input type="date" name="created_at" class="form-control dt-input" data-column="6" min="2022-01-01" max="{{\Carbon\Carbon::now()->addYear()->format('Y')}}-01-01" value="{{old('created_at', request('created_at'))}}" placeholder="{{__('mm/dd/yy')}}" data-column-index="5" />
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
                                    <th {!! \table_width_head(7) !!}>@lang('Item') </th>
                                    <th {!! \table_width_head(7) !!}>@lang('Description') </th>
                                    <th {!! \table_width_head(3) !!}>@lang('Price') </th>
                                    <th {!! \table_width_head(10) !!}>@lang('status') </th>
                                    <th {!! \table_width_head(8) !!}>@lang('Created At')</th>
                                    <th {!! \table_width_head(15) !!}>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lists->count())
                                @foreach ($lists as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td> {{$item->number ?? '-------'}} </td>
                                        <td> {{$item->item ?? '-------'}} </td>
                                        <td> {{$item->description ?? '-------'}} </td>
                                        <td> {{$item->price ?? '-------'}} </td>
                                        <td>
                                            @if ($item->status == "on_hold")
                                                <span class="badge bg-label-warning">@lang(ucwords(strtolower(str_replace('_',' ',$item->status))))</span>
                                            @elseif($item->status == "paid")
                                                <span class="badge bg-label-success">@lang(ucwords(strtolower(str_replace('_',' ',$item->status))))</span>
                                            @endif
                                        </td>
                                        <td> {{$item->created_at}} </td>
                                        <td>
                                            {!! editForm('expenses', $item) !!}
                                            {!! deleteForm('expenses', $item) !!}
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
