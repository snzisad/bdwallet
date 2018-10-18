
@extends("layouts.generalLayout")

@section('title', "Track Exchange")

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="panel-heading">Exchange Information</div>

                    <div class="panel-body">
                        <div class="confirm_order">

                          @if(isset($new_request))
                            <div class="instruction text-light bg-success text-center"> <i class="fa fa-check"></i> Your exchange request submitted successfully. 
                              Please use the link <a href="{{asset('/track/0/'.$exchange_info->exchange_id)}}">https://bdwallet.com/0/track/{{$exchange_info->exchange_id}}</a> to track your exchange 
                            </div>
                          @endif

                          @if(isset($error))
                            <div class="instruction text-light bg-danger text-center"> <i class="fa fa-close"></i> Sorry no exchange information found with this exchange id
                            </div>
                          @else
                            <div class="gateway">
                              <img src="{{ asset('/picture/icon/'.$exchange_info->send_from_data->icon)}}"> {{ $exchange_info->send_from_data->name }} <i class="fa fa-long-arrow-right"></i> {{ $exchange_info->send_to_data->name}} <img src="{{ asset('/picture/icon/'.$exchange_info->send_to_data->icon)}}">
                            </div>

                            <div class="d-flex">
                                <div class="mr-auto p-2" style="font-weight: bold;">Exchange ID:</div>
                                <div class="p-2">{{ $exchange_info->exchange_id }}</div>
                            </div>
                            <div class="d-flex">
                                <div class="mr-auto p-2">Send: </div>
                                <div class="p-2">{{ $exchange_info->send_amount }} {{ $exchange_info->send_from_data->currency->type }}</div>
                            </div>
                            <div class="d-flex">
                                <div class="mr-auto p-2">Receive: </div>
                                <div class="p-2">{{ $exchange_info->receive_amount }} {{ $exchange_info->send_to_data->currency->type }}</div>
                            </div>
                            <div class="d-flex">
                                <div class="mr-auto p-2">Exchange rate: </div>
                                <div class="p-2">{{ $exchange_info->rate }}</div>
                            </div>
                            <div class="d-flex">
                                <div class="mr-auto p-2">Transaction ID: </div>
                                <div class="p-2">{{ $exchange_info->transaction_number }}</div>
                            </div>
                            <div class="d-flex">
                                <div class="mr-auto p-2">Request Date-Time: </div>
                                <div class="p-2">{{ $exchange_info->created_at }}</div>
                            </div>
                            <div class="d-flex">
                                <div class="mr-auto p-2">Status: </div>
                                 @if($exchange_info->status == "Processing")
                                  <div class="p-2"><span class="bg-primary text-light" style="padding: 5px; border-radius: 3px;"><i class="fa fa-clock-o"></i> Processing</span></div>
                                 @elseif($exchange_info->status == "Accepted")
                                  <div class="p-2"><span class="bg-success text-light" style="padding: 5px; border-radius: 3px;"><i class="fa fa-check"></i> Success</span></div>
                                 @else
                                  <div class="p-2"><span class="bg-danger text-light" style="padding: 5px; border-radius: 3px;"><i class="fa fa-close"></i> Failed</span></div>
                                 @endif
                            </div>
                          @endif

                      </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection