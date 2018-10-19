
@extends("layouts.adminPanelLayout")

@section('title', "Deposit Request")

@section('content')
	
	<div class="container">

        <div class="panel">
            <div class="panel_title">
                Deposit Requests
            </div>
            <div class="panel_content">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">User</th>
                      <th scope="col">Wallet</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Transaction Number</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($requests as $request)
                        <tr>
                              <td style="text-align: center;"> 
                                {{ $request->user["name"] }}
                              </td>
                              <td  style="text-align: center;">
                                {{ $request->wallet['name'] }}
                              </td>
                              <td style="text-align: center;"> 
                                {{ $request->amount }} {{ $request->wallet['currency']['type'] }}
                              </td>
                              <td style="text-align: center;"> 
                                {{ $request->transaction_id }}
                              </td>
                              <td  style="text-align: center;">
                                <a href="{{asset('/adminpanel/acceptdeposit/'.$request->id)}}" class="btn btn-primary btn-sm">Accept</a>
                                <a href="{{asset('/adminpanel/rejectdeposit/'.$request->id)}}" class="btn btn-danger btn-sm">Reject</a>
                              </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection