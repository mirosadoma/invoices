<table>
    <thead>
    <tr>
        <th>@lang("ID")</th>
        <th>@lang("Number")</th>
        <th>@lang("User")</th>
        <th>@lang("Address")</th>
        <th>@lang("Coupon")</th>
        <th>@lang("Payment Method")</th>
        <th>@lang("Status")</th>
        <th>@lang("Sub Total")</th>
        <th>@lang("Tax")</th>
        <th>@lang("Grand Total")</th>
        <th>@lang("Discount")</th>
        <th>@lang("Payment Total")</th>
        <th>@lang("Points")</th>
        <th>@lang("Delivery Charge")</th>
        <th>@lang("Final Total")</th>
        <th>@lang("Cancel Reson")</th>
        <th>@lang("Created At")</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_data as $value)
        <tr>
            <td>{{ $value['id'] }}</td>
            <td>{{ $value['number'] }}</td>
            <td>{{ $value['user'] }}</td>
            <td>
                <ul>
                    @foreach ($value['address'] as $address)
                        <li>{{$address}}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                @if ($value && isset($value['coupon']))
                    <ul>
                        <li>@lang("Start Date") : {{$value['coupon']['start_date']}}</li>
                        <li>@lang("End Date") : {{$value['coupon']['end_date']}}</li>
                        <li>@lang("Code") : {{$value['coupon']['code']}}</li>
                        <li>@lang("Type") : {{$value['coupon']['type']}}</li>
                        <li>@lang("Value") : {{$value['coupon']['value']}}</li>
                    </ul>
                @else
                    @lang("No Data Found")
                @endif
            </td>
            <td>{{ $value['payment_method'] }}</td>
            <td>{{ $value['status'] }}</td>
            <td>{{ $value['sub_total'] }}</td>
            <td>{{ $value['tax'] }}</td>
            <td>{{ $value['grand_total'] }}</td>
            <td>{{ $value['discount'] }}</td>
            <td>{{ $value['payment'] }}</td>
            <td>{{ $value['points'] }}</td>
            <td>{{ $value['delivery_charge'] }}</td>
            <td>{{ $value['final_total'] }}</td>
            <td>{{ $value['cancel_reson'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
