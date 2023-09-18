<!DOCTYPE html>
<html class="no-js" lang="{{app()->getLocale() == 'ar' ? 'ar' : 'en'}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ThemeMarch">
    <base href="/">
    <!-- Site Title -->
    <title>@lang("Order Number : ") {{ $quotation->id }}</title>
    <link rel="stylesheet" href="{{url('/')}}/assets/envoice_template/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        @page {
            size: auto;
            margin: 0;
        }
    </style>
</head>
    <body class="bg-gray-100">
        <div class="py-20 relative">
            <div class="cs-container">
                <div class="cs-invoice p-12 rounded-3xl" style="height: 100% !important;">
                    <div class="cs-invoice_in">
                        <div class="cs-table cs-style2">
                            <table>
                                <tbody>
                                    <tr class="cs-table_baseline">
                                        <td class="cs-width_5 cs-primary_color cs-bold cs-f16 ">
                                            {{-- <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16"><b class="cs-primary_color">@lang("Quotation No:")</b> {{$order->number}}#</p>
                                            <p class="cs-invoice_date cs-primary_color cs-m0"><b class="cs-primary_color">@lang("Date:") </b>{{$order->created_at->format('Y/m/d')}}</p> --}}
                                            <h2 class="text-2xl font-semibold">@lang('Quotation')</h2>
                                        </td>
                                        <td class="cs-width_2 cs-primary_color cs-bold cs-primary_color cs-f16 text-end">
                                            <img src="{{app_settings()->logo_path}}" alt="Logo">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cs-table cs-style2" style="border-top: 1px solid;">
                            <table>
                                <tbody>
                                    <tr class="cs-table_baseline">
                                        <td class="cs-width_5 cs-primary_color cs-bold cs-f16 ">
                                            <p>
                                                <h6 class="text-base font-normal"><span class="font-bold">@lang('Date:')</span> {{$quotation->created_at->format('Y/m/d')}}</h6>
                                            </p>
                                        </td>
                                        <td class="cs-width_2  cs-primary_color cs-bold cs-primary_color cs-f16 text-end">
                                            <p>
                                                <h6 class="text-base font-normal"><span class="font-bold">@lang('Quotation No:')</span> #{{$quotation->number}}</h6>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cs-table cs-style2" style="border-top: 1px solid;">
                            <table>
                                <tbody>
                                    <tr class="cs-table_baseline">
                                        <td class="cs-width_5 cs-primary_color cs-bold cs-f16 " style="padding-right:15%">
                                            <b class="cs-primary_color">@lang("Quotation From:")</b>
                                            <p>
                                                <span style="color: #777777;font-weight:normal;">{{ app_settings()->translate('en')->company_name ?? "" }}</span> <br>
                                                <span style="color: #777777;font-weight:normal;">{{ app_settings()->phone ?? "" }}</span> <br>
                                                <span style="color: #777777;font-weight:normal;">{{ app_settings()->email ?? "" }}</span> <br>
                                            </p>

                                        </td>
                                        <td class="cs-width_2  cs-primary_color cs-bold cs-primary_color cs-f16 text-end">
                                            <b class="cs-primary_color">@lang("Quotation To:")</b>
                                            <p>
                                                <span style="color: #777777;font-weight:normal;">{{ $quotation->user->name ?? "" }}</span> <br>
                                                <span style="color: #777777;font-weight:normal;">{{ $quotation->user->phone ?? "----------" }}</span> <br>
                                                <span style="color: #777777;font-weight:normal;">{{ $quotation->user->email ?? "----------" }}</span> <br>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        @if ($quotation->quotation_activities->count())
                            <div class="cs-table cs-style2">
                                <div class="cs-table_responsive">
                                    <table class="border-collapse table-auto w-full text-sm mb-12 whitespace-pre">
                                        <thead>
                                            <tr class="bg-primary text-white text-center">
                                                <th class="p-4 uppercase text-base font-semibold border-white border-style">@lang('Activities')</th>
                                                <th class="p-4 uppercase text-base font-semibold border-s-2 border-white border-style">@lang('Description')</th>
                                                <th class="p-4 uppercase text-base font-semibold border-s-2 border-white border-style">@lang('Price')</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @if($quotation->quotation_activities)
                                                @foreach ($quotation->quotation_activities as $key => $quotation_activity)
                                                    <tr class="{{ $key%2 == 0 ? 'bg-gray-100' : '' }} text-center">
                                                        <td class="p-5 text-base font-medium border-style">{{$quotation_activity->activity->name}}</td>
                                                        <td class="p-5 text-base font-medium border-s-2 border-white border-style">{{$quotation_activity->description}}</td>
                                                        <td class="p-5 text-base font-medium border-s-2 border-white border-style">{{$quotation_activity->price}}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="cs-width_2" colspan="3">@lang("No Data No Data Founded")</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                        <div class="cs-table cs-style2">
                            <table>
                                <tbody>
                                    <tr class="cs-table_baseline border_dashed_bottom">
                                        <td class="cs-width_9 cs-primary_color cs-bold cs-f16 ">@lang('Sub Total:')</td>
                                        <td class="cs-width_2  cs-primary_color cs-bold cs-primary_color cs-f16 text-end">{{$quotation->invoice_activities->sum('price') ?? 0}} {{$quotation->currance}}</td>
                                    </tr>
                                    @if ($quotation->is_tax)
                                        <tr class="cs-table_baseline border_dashed_bottom">
                                            <td class="cs-width_9 cs-primary_color cs-bold cs-f16 ">@lang('Tax:')</td>
                                            <td class="cs-width_2  cs-primary_color cs-bold cs-primary_color cs-f16 text-end">{{app_settings()->tax ?? 0}} {{$quotation->currance}}</td>
                                        </tr>
                                    @endif
                                    <tr class="cs-table_baseline border_solid_top border_solid_bottom">
                                        <td class="cs-width_9 cs-primary_color cs-bold cs-f16 ">@lang('Total:')</td>
                                        <td class="cs-width_2  cs-primary_color cs-bold cs-primary_color cs-f16 text-end">{{ ($quotation->is_tax ? $quotation->invoice_activities->sum('price') + ($quotation->invoice_activities->sum('price')*app_settings()->tax / 100) : $quotation->invoice_activities->sum('price') ?? 0) }} {{$quotation->currance}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="cs-mb10 text-start">
                            <b class="cs-primary_color">@lang("Terms And Conditions:")</b>
                            <div>
                                {!!app_settings()->translate('en')->terms_and_conditions!!}
                            </div>
                        </div>
                        <div class="cs-mb10 text-start">
                            <b class="cs-primary_color">@lang("Signature")</b>
                            <div>
                                <img src="{{$quotation->signature_path}}" alt="{{__('Signature')}}" style="height: 100px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
