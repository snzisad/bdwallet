
@extends("layouts.generalLayout")

@section('title', "Confirm Order")

@section('content')

<div class="container">

  <form method="post" action="{{route('confirmexchangerequest')}}">
      {{ csrf_field() }}
    <div class="row order_confirm_panel" style="display: all;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="panel-heading">Confirm Order</div>

                    <div class="panel-body">
                        <div class="confirm_order">
                          <div class="gateway">
                            <img src="{{ asset('/picture/icon/'.$send_from->icon)}}"> {{ $send_from->name }} <i class="fa fa-long-arrow-right"></i> {{ $send_to->name }} <img src="{{ asset('/picture/icon/'.$send_to->icon)}}"> 
                          </div>

                          <div class="d-flex">
                              <div class="mr-auto p-2" style="font-weight: bold;">Exchange ID:</div>
                              <div class="p-2">{{ $exchange_id }}</div>
                          </div>
                          <div class="d-flex">
                              <div class="mr-auto p-2">Amount Send: </div>
                              <div class="p-2">{{ $request->send_amount }} {{ $send_from->type }}</div>
                          </div>
                          <div class="d-flex">
                              <div class="mr-auto p-2">Amount Receive: </div>
                              <div class="p-2">{{ $request->receive_amount }} {{ $send_to->type }}</div>
                          </div>

                          <div class="form-group row" style="margin-top: 10px; ">
                            <label class="col-sm-6 col-form-label">Phone Number</label>
                            <div class="col-sm-6">
                              <input type="text" name="user_phone" class="user_phone form-control" placeholder="Enter Your Contact Number" required autofocus>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="account" class="col-sm-6 col-form-label">Your Account</label>
                            <div class="col-sm-6">
                              <input type="text" name="user_account" class="user_account form-control" id="account" placeholder="Enter your account" required autofocus>
                            </div>
                          </div>

                          <div class="text-right" style="margin-top: 10px;">
                            <Button class="btn btn-primary got_to_next_step_btn">Next <i class="fa fa-arrow-right"></i></Button>
                          </div>
                      </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="row exchange_confirm_panel" style="display: none;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="panel-heading">Confirm Exchange</div>

                    <div class="panel-body">
                        <div class="confirm_order">
                          <div class="gateway">
                            <img src="{{ asset('/picture/icon/'.$send_from->icon)}}"> {{ $send_from->name }} <i class="fa fa-long-arrow-right"></i> {{ $send_to->name }} <img src="{{ asset('/picture/icon/'.$send_to->icon)}}">  
                          </div>

                          <div class="instruction text-light bg-info"> <i class="fa fa-info-circle"></i> Please send your amount manually using the following information to our account. Enter the transaction number/ batch in the box to confirm your exchange.
                          </div>

                          <div class="d-flex">
                              <div class="mr-auto p-2" style="font-weight: bold;">Exchange ID:</div>
                              <div class="p-2">{{ $exchange_id }}</div>
                          </div>
                          <div class="d-flex">
                              <div class="mr-auto p-2">Amount: </div>
                              <div class="p-2">{{ $request->send_amount }} {{ $send_from->type }}</div>
                          </div>
                          <div class="d-flex">
                              <div class="mr-auto p-2">Your Phone Number: </div>
                              <div class="p-2 phone_number"></div>
                          </div>
                          <div class="d-flex">
                              <div class="mr-auto p-2">Our Account Number: </div>
                              <div class="p-2">{{ $send_from->account }}</div>
                          </div>

                          <div class="form-group row" style="margin-top: 10px;">
                            <label for="account" class="col-sm-6 col-form-label">Enter Transaction Number/Batch</label>
                            <div class="col-sm-6">
                              <input type="text"  name="transaction_number" class="form-control" id="account" placeholder="Enter transaction number" required autofocus>
                            </div>
                          </div>

                          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                          <input type="hidden" name="exchange_id" value="{{ $exchange_id }}">
                          <input type="hidden" name="from_id" value="{{ $send_from->name }}">
                          <input type="hidden" name="to_id" value="{{ $send_to->name }}">
                          <input type="hidden" name="send_amount" value="{{ $request->send_amount }}">
                          <input type="hidden" name="receive_amount" value="{{ $request->receive_amount }}">
                          <input type="hidden" name="status" value="Processing">
                          <input type="hidden" name="rate" value="{{ $request->rate }}">

                          <div class="text-right" style="margin-top: 10px;">
                            <Button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Confirm</Button>
                            <a href="{{asset('/')}}" class="btn btn-danger"><i class="fa fa-close"></i> Cancel</a>
                          </div>

                      </div>
                    </div>
                </div>
        </div>
    </div>

  </form>
</div>

@endsection