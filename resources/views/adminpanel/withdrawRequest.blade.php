
@extends("layouts.adminPanelLayout")

@section('title', "Withdraw Request")

@section('content')
	
	<div class="container">

        <div class="panel">
            <div class="panel_title">
                Withdraw Requests
            </div>
            <div class="panel_content">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">User</th>
                      <th scope="col">From</th>
                      <th scope="col">To</th>
                      <th scope="col">Rate</th>
                      <th scope="col">Send</th>
                      <th scope="col">Receive</th>
                      <th scope="col">Account</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($requests as $request)
                        <tr>
                              <td style="text-align: center;"> 
                                {{ $request->user['name'] }}
                              </td>
                              <td  style="text-align: center;">
                                {{ $request->sent_wallet['name'] }}
                              </td>
                              <td  style="text-align: center;">
                                {{ $request->receive_wallet['name']}}
                              </td>
                              <td  style="text-align: center;">
                                {{ $request->rate }}
                              </td>
                              <td style="text-align: center;"> 
                                {{ $request->send_amount }} {{ $request->sent_wallet['currency']['type'] }}
                              </td>
                              <td style="text-align: center;"> 
                                {{ $request->receive_amount }} {{ $request->receive_wallet['currency']['type'] }}
                              </td>
                              <td style="text-align: center;"> 
                                {{ $request->account }}
                              </td>
                              <td  style="text-align: center;">
                                <a href="{{asset('/adminpanel/acceptwithdraw/'.$request->id)}}" class="btn btn-primary btn-sm">Accept</a>
                                <a href="{{asset('/adminpanel/rejectwithdraw/'.$request->id)}}" class="btn btn-danger btn-sm">Reject</a>
                              </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection