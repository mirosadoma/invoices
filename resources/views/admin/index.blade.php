@extends('admin.layouts.master')
@section('head_title'){{__('Main')}}@endsection
@push('styles')
    <style>
        span.select2-container.select2-container--default.select2-container--open {
            width: 100px !important;
        }
        svg.feather.feather-calendar {
            height: 23px;
            width: 2rem;
        }
    </style>
@endpush
@section('content')
    @include('admin.layouts.inc.breadcrumb', ['array' => []])
    <div class="row">
        @forelse (getReports() as $item)
            @if (admin_can_any($item['permission']) == "true")
                <div class="col-md-4 col-lg-3 col-sm-6">
                    <a href="{{$item['url']}}" style="color: #5E5873;">
                        <div class="card card-statistics">
                            <div class="card-body statistics-body">
                                <div class="row">
                                    <div class="">
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="avatar bg-light-danger me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="box" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$item['count']}}</h4>
                                                <p class="card-text font-small-3 mb-0">{{$item['title']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @empty
        @endforelse
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-statistics">
                <div class="card-body" style="height: 500px;">
                    <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                        <i data-feather="calendar"></i>
                        <select name="year" class="select2 get_year">
                            @foreach($years as $year)
                                <option value="{{$year}}" @if($this_year == $year) selected @endif>{{$year}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="invoiceChart" style="height: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://cdn.anychart.com/js/latest/anychart.min.js"></script>
<script>
    // columns chart
    var all_data = [];
    @foreach($invoicesCharts as $invoicesChart)
        var values = [
            "{{$invoicesChart['month']}}",
            parseInt("{{ $invoicesChart['invoices_total'] }}"),
            parseInt("{{ $invoicesChart['expense_month'] }}"),
            parseInt("{{ $invoicesChart['net_month'] }}"),
        ];
        all_data.push(values);
    @endforeach
    anychart.onDocumentLoad(function(){
        var dataSet = anychart.data.set(all_data);
        var chart = anychart.column();

        chart.column(dataSet.mapAs({value:1,x:0}))
            .name("Revenue")
            .fill('orange')
            .stroke('orange');
        chart.column(dataSet.mapAs({value:2,x:0}))
            .name("Expenses")
            .fill('red')
            .stroke('red');
        chart.column(dataSet.mapAs({value:3,x:0}))
            .name("Net")
            .fill('green')
            .stroke('green');

        chart.grid(0,{layout:'vertical'})
        chart.barGroupsPadding(3)

        chart.legend(true);
        chart.title("{{__('Invoice Charts')}}")
        chart.yScale().minimum(0);
        chart.container('invoiceChart');
        chart.draw();
    });
</script>
<script>
    $(".get_year").on('change', function () {
        var year = $(this).val();
        var route = _url_+'app?year='+year;
        window.location.href = route;
    });
</script>
@endpush
