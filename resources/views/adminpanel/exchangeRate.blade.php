@extends("layouts.adminPanelLayout")

@section('title', "Exchange Rate")

@section('content')

    <div class="container">

        <div class="panel">
            <div class="panel_title">
                New Exchange Rate
            </div>
            <div class="panel_content">
                <form class="row" method="post" action="{{route('exchangerate')}}">
                    {{ csrf_field() }}

                    <div class="col-md-2">
                        <h5>From</h5>
                         <select class="form-control" name="from_id" required>
                            @foreach($all_gateway as $gateway)
                                <option value="{{ $gateway->name }}">{{ $gateway->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <h5>To</h5>
                        <select class="form-control" name="to_id" required>
                            @foreach($all_gateway as $gateway)
                                <option value="{{ $gateway->name }}">{{ $gateway->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8" style="text-align: center; background: #f5f5f5; padding: 5px;">
                        <h4>Rate</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="number" class="form-control" name="from_rate" placeholder="From amount" step="0.0001" required>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="from_rate_type" required>
                                    @foreach($balance_type as $type)
                                        <option value="{{ $type->type }}">{{ $type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1"><i class="fa fa-exchange"></i></div>
                            <div class="col-md-3">
                                <input type="number" step="0.0001" class="form-control" name="to_rate" placeholder="To amount" required>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="to_rate_type" required>
                                    @foreach($balance_type as $type)
                                        <option value="{{ $type->type }}">{{ $type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-top: 20px;">
                      <h5>Minimum Transferable</h5>
                        <input type="number" step="0.0001" class="form-control" name="minimum_transfer" placeholder="Enter amount" required>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-primary" value="Save" style="margin-top: 45px;">
                    </div>
                </form>
            </div>
        </div>

        <div class="panel">
            <div class="panel_title">
                Exchange Rates
            </div>
            <div class="panel_content">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">From</th>
                      <th scope="col">To</th>
                      <th scope="col">Rate</th>
                      <th scope="col">Minimum Transferable</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($rates as $rate)
                        <tr>
                              <td style="text-align: center;"> 
                                {{ $rate->from_id }}
                              </td>
                              <td  style="text-align: center;">
                                {{ $rate->to_id }}
                              </td>
                              <td  style="text-align: center;">
                                 {{ $rate->from_rate }} {{ $rate->from_rate_type }} = {{ $rate->to_rate }} {{ $rate->to_rate_type }}
                              </td>
                              <td  style="text-align: center;">
                                 {{ $rate->minimum_transfer }} {{ $rate->to_rate_type }}
                              </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection