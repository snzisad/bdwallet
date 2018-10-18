@extends("layouts.generalLayout")

@section('title', "BD Wallet")

@section('content')

    <!-- Breaking News -->
    <div class="d-flex text-light"  style="font-size: 18px; margin-left: 15px;">
        <div class="bg-success p-2" style="padding: 8px;">News:</div>
        <marquee class="bg-primary mr-auto" style="padding: 8px;"> {{ $news->text }}</marquee>
    </div>

    <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Exchange Money</div>

                    <div class="panel-body">
                        <div class="bg-danger text-light text-center error_panel" style="padding: 5px; font-size: 16px; margin-bottom: 10px; display: none;">
                            <i class="fa fa-close"></i> <span class="error_panel_message"></span>
                        </div>
                        <form class="exchange-money text-center " method="POST" action="{{ route('sendexchangerequest') }}">
                            {{ csrf_field() }}

                            <div class="exchange_money_info" action="{{ route('getexchangeinfo') }}"></div>
                            <div class="csrf_exchange_info" data-token='{{ csrf_token() }}'></div>

                            <input type="hidden" class="minimum_transfer" name="minimum_transfer" >

                            <div class="row">
                                <div class="col-md-2" style="margin-bottom: auto;margin-top: auto;">
                                    <img class="from_image" src = "{{asset('/picture/icon/'.$all_gateway[0]->icon)}}" />
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-size: 22px;"><i class="fa fa-arrow-circle-o-up text-primary"></i> From</label>
                                        <select class="form-control form-control-lg from_id" id="from_id" name="from_id">
                                            @foreach($all_gateway as $gateway)
                                                <option value="{{ $gateway->name }}">{{ $gateway->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="send_amount" id="send_amount" class="form-control send_amount" required placeholder="Enter Sending Amount" value="{{ $rate->from_rate}}" />
                                    </div>
                                    <label class="font-weight-bold text-center" style="font-size: 15px;">Rate: 
                                        <span class="exchange_rate_from">{{ $rate->from_rate}}</span> 
                                        <span class="exchange_rate_from_type">{{ $rate->from_rate_type}}</span> = 
                                        <span class="exchange_rate_to"> {{ $rate->to_rate}}</span> 
                                        <span class="exchange_rate_to_type">{{ $rate->to_rate_type}}</span></label>
                                    <input type="hidden" class="exchange_rate" name="rate" value="{{ $rate->from_rate}} {{ $rate->from_rate_type}} = {{ $rate->to_rate}} {{ $rate->to_rate_type}}">
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-size: 22px;"><i class="fa fa-arrow-circle-o-down text-primary"></i> To</label>

                                        <select class="form-control form-control-lg to_id" id="to_id" name="to_id">
                                            @foreach($all_gateway as $gateway)
                                                <option value="{{ $gateway->name }}">{{ $gateway->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="receive_amount" class="form-control receive_amount" id="receive_amount" placeholder="Received Amount" value="{{ $rate->to_rate}}" readonly/>
                                    </div>
                                    <label class="font-weight-bold text-center" style="font-size: 15px;">Reserve: <span class="reserve_amount">{{ $all_gateway[0]->reserve}}</span> <span class="reserve_amount_type">{{$all_gateway[0]->type}}</span></label>
                                </div>

                                <div class="col-md-2" style="margin-bottom: auto;margin-top: auto;">
                                    <img class="to_image"  src = "{{asset('/picture/icon/'.$all_gateway[0]->icon)}}" />
                                </div>
                            </div>

                            <div class="text-center">
                                <Button type="submit" class="btn btn-success text-center btn-lg btn_exchange_money" style="width: 180px; margin-top: 20px;"> 
                                    <i class="fa fa-exchange"></i> Exchange
                                </Button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Reviews</div>

                    <div class="panel-body">
                        @foreach($reviews as $review)
                            <div class="testimonials">
                                <h5 class="author"> {{ $review->user->name }}</h5>
                                @if($review->status == "positive")
                                    <span class="status text-light bg-success"><i class="fa fa-smile-o"></i> Positive</span>
                                @else
                                    <span class="status text-light bg-danger"><i class="fa fa-frown-o"></i> Negative</span>
                                @endif
                                <p class="text"> {{ $review->comment }}</p>
                            </div>
                        @endforeach

                        <div class="text-right"><a href="{{asset('reviews')}}" class="btn btn-primary btn-sm">See All Reviews <i class="fa fa-arrow-right"></i></a></div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Exchange History</div>

                    <div class="panel-body">
                        <table class="table exchange_history">
                          <thead class="thead-light">
                            <tr>
                              <th scope="col">From</th>
                              <th scope="col">To</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($exchange_history as $history)
                                <tr>
                                  <td><img src="{{ asset('/picture/icon/'.$history->send_from_data->icon)}}"> {{ $history->send_from_data->name }}</td>
                                  <td><img src="{{ asset('/picture/icon/'.$history->send_to_data->icon)}}"> {{ $history->send_to_data->name }}</td>
                                  <td>{{ $history->send_amount }} {{ $history->send_to_data->currency->type }}</td>
                                  <td>
                                    @if($history->status == "Processing")
                                      <span class="status text-light bg-primary"><i class="fa fa-clock-o"></i> Processing</span>
                                     @elseif($history->status == "Accepted")
                                      <span class="status text-light bg-success"><i class="fa fa-check"></i> Success</span>
                                     @else
                                      <span class="status text-light bg-danger"><i class="fa fa-close"></i> Failed</span>
                                     @endif
                                  </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Track Exchange</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('track') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="text" class="form-control" name="exchange_id" placeholder="Enter Exchange ID" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <button type="submit" class="btn btn-success btn-block text-bold">
                                        Track
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Gateway & Reserve</div>

                    <div class="panel-body">
                        @foreach($all_gateway as $gateway)
                        <div class="reserve d-flex">
                            <img class="p-2" src="{{asset('picture/icon/'.$gateway->icon)}}">
                            <div class="mr-auto">
                                <h5>{{$gateway->name}}</h5>
                                <span>{{$gateway->reserve}} {{$gateway->currency->type}}</span>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection