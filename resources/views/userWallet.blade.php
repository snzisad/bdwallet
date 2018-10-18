
@extends("layouts.generalLayout")

@section('title', "Wallet")

@section('content')

<div class="container">

    <div class="row order_confirm_panel" style="display: all;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="panel-heading">Welcome to your Wallet</div>

                    <div class="panel-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-balance-tab" data-toggle="tab" href="#nav-balance" role="tab" aria-controls="nav-balance" aria-selected="true"><i class="fa fa-money"></i> Balance</a>
                                <a class="nav-item nav-link" id="nav-exchange-tab" data-toggle="tab" href="#nav-exchange" role="tab" aria-controls="nav-exchange" aria-selected="true"><i class="fa fa-refresh"></i> Exchange</a>
                                <a class="nav-item nav-link" id="nav-deposit-tab" data-toggle="tab" href="#nav-deposit" role="tab" aria-controls="nav-deposit" aria-selected="false"><i class="fa fa-arrow-circle-down"></i> Deposit</a>
                                <a class="nav-item nav-link" id="nav-withdraw-tab" data-toggle="tab" href="#nav-withdraw" role="tab" aria-controls="nav-withdraw" aria-selected="false"><i class="fa fa-arrow-circle-up"></i> Withdraw</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent" style="margin-top: 20px;">

                            <div class="exchange_money_info" action="{{ route('getexchangeinfo') }}"></div>
                            <div class="withdraw_money_link" action="{{ route('getwalletinfo') }}"></div>
                            <div class="wallet_balance_link" action="{{ route('getwalletbalance') }}"></div>
                            <div class="csrf_exchange_info" data-token='{{ csrf_token() }}'></div>
                            
                            <!-- Balance Tab -->
                            <div class="tab-pane fade show active" id="nav-balance" role="tabpanel" aria-labelledby="nav-balance-tab">

                                <div class="form-group">
                                    <label>Wallet</label>
                                    <select class="form-control form-control-lg my_wallet">
                                        @foreach($all_gateway as $gateway)
                                            <option value="{{ $gateway->name }}">{{ $gateway->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Balance</label>
                                    <input type="text" class="form-control my_wallet_balance"  value="{{ $rate->to_rate}}" readonly/>
                                </div>
                            </div>
                            
                            <!-- Exchange tab -->
                            <div class="tab-pane fade" id="nav-exchange" role="tabpanel" aria-labelledby="nav-exchange-tab">
                                <form class="col-md-10" method="post" action="{{route('walletexchange')}}">
                                    {{csrf_field()}}

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                                    <div class="form-group">
                                        <label>From Wallet</label>
                                        <select class="form-control form-control-lg from_id" id="from_wallet_id" name="from_id">
                                            @foreach($all_gateway as $gateway)
                                                <option value="{{ $gateway->name }}">{{ $gateway->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>To Wallet</label>
                                        <select class="form-control form-control-lg to_id" id="to_wallet_id" name="to_id">
                                           @foreach($all_gateway as $gateway)
                                                <option value="{{ $gateway->name }}">{{ $gateway->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" class="form-control send_amount" id="send_amount" name="send_amount"  required autofocus value="{{ $rate->from_rate}}"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Wll receive</label>
                                        <input type="number" class="form-control receive_amount" id="receive_amount" name="receive_amount" value="{{ $rate->to_rate}}" readonly/>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label class="font-weight-bold text-center" style="font-size: 15px;">Rate: 
                                            <span class="exchange_rate_from">{{ $rate->from_rate}}</span> 
                                            <span class="exchange_rate_from_type">{{ $rate->from_rate_type}}</span> = 
                                            <span class="exchange_rate_to"> {{ $rate->to_rate}}</span> 
                                            <span class="exchange_rate_to_type">{{ $rate->to_rate_type}}</span></label>
                                        <input type="hidden" class="exchange_rate" name="rate" value="{{ $rate->from_rate}} {{ $rate->from_rate_type}} = {{ $rate->to_rate}} {{ $rate->to_rate_type}}">
                                    </div>
                                    
                                    <input type="submit" class="btn btn-success" value="Exchange"/>
                                </form>
                            </div>

                            <!-- Deposit Tab -->
                            <div class="tab-pane fade" id="nav-deposit" role="tabpanel" aria-labelledby="nav-deposit-tab">
                                <form class="col-md-10" method="post" action="{{route('walletdeposit')}}">
                                    {{csrf_field()}}

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                                    <div class="form-group">
                                        <label>Deposit via</label>
                                        <select class="form-control form-control-lg wallet_id" id="wallet_id" gateway="{{ $all_gateway }}" name="wallet_id">
                                            @foreach($all_gateway as $gateway)
                                                <option value="{{ $gateway->name }}">{{ $gateway->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" name="amount"  required autofocus/>
                                    </div>

                                    <div class="instruction text-light bg-info"> <i class="fa fa-info-circle"></i> Please send your amount to our following merchant account. Enter the transaction number/ batch in the box to confirm your deposit.</div>

                                    <div class="form-group">
                                        <label>Our Merchant Account</label>
                                        <input type="text" class="form-control marchant_account" id="marchant_account" value="{{ $all_gateway[0]->account }}" readonly/>
                                    </div>

                                    <div class="form-group">
                                        <label>Transaction ID/Batch</label>
                                        <input type="text" class="form-control" name="transaction_id" required autofocus/>
                                    </div>

                                    <input type="submit" class="btn btn-success" value="Add Deposit"/>
                                </form>
                            </div>

                            <!-- Withdraw Tab -->
                            <div class="tab-pane fade" id="nav-withdraw" role="tabpanel" aria-labelledby="nav-withdraw-tab">
                                <div class="bg-danger text-light text-center error_panel" style="padding: 5px; font-size: 16px; margin-bottom: 10px; display: none;">
                                    <i class="fa fa-close"></i> <span class="error_panel_message"></span>
                                </div>
                                <form class="col-md-10" method="post" action="{{route('walletwithdraw')}}">
                                    {{csrf_field()}}
                                    
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="user_id"/>

                                    <div class="form-group">
                                        <label>From Wallet</label>
                                        <select class="form-control form-control-lg from_wallet_id" id="from_id" name="from_id">
                                            @foreach($all_gateway as $gateway)
                                                <option value="{{ $gateway->name }}">{{ $gateway->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>To</label>
                                        <select class="form-control form-control-lg to_wallet_id" id="to_id" name="to_id">
                                            @foreach($all_gateway as $gateway)
                                                <option value="{{ $gateway->name }}">{{ $gateway->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold text-center" style="font-size: 15px;">Rate: 
                                            <span class="wallet_exchange_rate_from">{{ $rate->from_rate}}</span> 
                                            <span class="wallet_exchange_rate_from_type">{{ $rate->from_rate_type}}</span> = 
                                            <span class="wallet_exchange_rate_to"> {{ $rate->to_rate}}</span> 
                                            <span class="wallet_exchange_rate_to_type">{{ $rate->to_rate_type}}</span></label>
                                        <input type="hidden" class="wallet_exchange_rate" name="rate" value="{{ $rate->from_rate}} {{ $rate->from_rate_type}} = {{ $rate->to_rate}} {{ $rate->to_rate_type}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" class="form-control amount_send" id="send_amount"  name="send_amount" value="{{ $rate->from_rate}}"  required autofocus/>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold text-center" style="font-size: 15px;">Balance: <span class="wallet_balance">{{ $all_gateway[0]->reserve}}</span> <span class="wallet_balance_type">{{$all_gateway[0]->type}}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Wll receive</label>
                                        <input type="text" class="form-control amount_receive" id="receive_amount" name="receive_amount" value="{{ $rate->to_rate}}" readonly/>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold text-center" style="font-size: 15px;">Reserve: <span class="gateway_reserve_amount">{{ $all_gateway[0]->reserve}}</span> <span class="gateway_reserve_amount_type">{{$all_gateway[0]->type}}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Your Account</label>
                                        <input type="text" class="form-control" name="account" required autofocus/>
                                    </div>

                                    <input type="submit" class="btn btn-success btn_withdraw_money" value="Send Request"/>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
    </div>

</div>

@endsection