<table>
    <thead>
    <tr>
        <th>#</th>
        <th>@lang('Full Name')</th>
        <th>@lang('Company Name')</th>
        <th>@lang('Phone')</th>
        <th>@lang('Email')</th>
        <th>@lang('Message')</th>
        <th>@lang('Created At')</th>
    </tr>
    </thead>
    <tbody>
        @php
            $n = 1;
        @endphp
        @foreach($all_data as $value)
            <tr>
                <td>
                    {{ $n }}
                </td>
                <td>
                    {{ $value['full_name']??"-----"}}
                </td>
                <td>
                    {{ $value['company_name']??"-----"}}
                </td>
                <td>
                    {{ $value['phone']??"-----"}}
                </td>
                <td>
                    {{ $value['email']??"-----"}}
                </td>
                <td>
                    {{ $value['message']??"-----"}}
                </td>
                <td>
                    {{ $value['created_at']??"-----"}}
                </td>
            </tr>
            @php
                $n++;
            @endphp
        @endforeach
    </tbody>
</table>
