
@extends("layouts.adminPanelLayout")

@section('title', "Exchange Request")

@section('content')
	
	<div class="container">

        <div class="panel">
            <div class="panel_title">
                Exchange Requests
            </div>
            <div class="panel_content">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">From</th>
                      <th scope="col">To</th>
                      <th scope="col">Send</th>
                      <th scope="col">Receive</th>
                      <th scope="col">Rate</th>
                      <th scope="col">Transaction Number</th>
                      <th scope="col">User Account</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($requests as $request)

                        <tr>
                              <td style="text-align: center;"> 
                                {{ $request->send_from_data['name'] }}
                              </td>
                              <td  style="text-align: center;">
                                {{ $request->send_to_data['name'] }}
                              </td>
                              <td style="text-align: center;"> 
                                {{ $request->send_amount }} {{ $request->send_from_data['currency']['type'] }}
                              </td>
                              <td  style="text-align: center;">
                                {{ $request->receive_amount }} {{ $request->send_to_data['currency']['type'] }}
                              </td>
                              <td style="text-align: center;"> 
                                {{ $request->rate }}
                              </td>
                              <td  style="text-align: center;">
                                {{ $request->transaction_number }}
                              </td>
                              <td style="text-align: center;"> 
                                {{ $request->user_account }}
                              </td>
                              <td style="text-align: center;"> 
                                {{ $request->user_phone }}
                              </td>
                              <td  style="text-align: center;">
                                <a href="{{asset('/adminpanel/acceptorder/'.$request->exchange_id)}}" class="btn btn-primary btn-sm">Accept</a>
                                <a href="{{asset('/adminpanel/rejectorder/'.$request->exchange_id)}}" class="btn btn-danger btn-sm">Reject</a>
                              </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection