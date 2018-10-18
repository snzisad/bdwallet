
@extends("layouts.generalLayout")

@section('title', "Profile")

@section('content')

<div class="container">

    <div class="row order_confirm_panel" style="display: all;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="panel-heading">Welcome snzisad</div>

                    <div class="panel-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-history-tab" data-toggle="tab" href="#nav-history" role="tab" aria-controls="nav-history" aria-selected="true"><i class="fa fa-history"></i> Exchange History</a>
                                <a class="nav-item nav-link" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="false"><i class="fa fa-comment"></i> My Review</a>
                                <a class="nav-item nav-link" id="nav-settings-tab" data-toggle="tab" href="#nav-settings" role="tab" aria-controls="nav-settings" aria-selected="false"><i class="fa fa-cog"></i> Settings</a>
                                <a href="{{asset('wallet')}}" class="nav-item nav-link"><i class="fa fa-money"></i> Wallet</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent" style="margin-top: 20px;">
                            
                            <!-- Exchange History tab -->
                            <div class="tab-pane fade show active" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
                                <table class="table exchange_history">
                                    <thead class="thead-light">
                                        <tr>
                                        <th scope="col">From</th>
                                        <th scope="col">To</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Exchange ID</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($exchange_histories as $history)
                                        <tr>
                                            <td>{{ $history->send_from_data->name }}</td>
                                            <td>{{ $history->send_to_data->name }}</td>
                                            <td>{{ $history->receive_amount }} {{ $history->send_to_data->currency->type }}</td>
                                            <td>{{ $history->exchange_id }}</td>
                                            <td>{{ $history->created_at }}</td>
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

                            <!-- Review Tab -->
                            <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                                <form  class="col-md-7" method="post" action="{{route('saveReview')}}">
                                    {{csrf_field()}}
                                    <div class="input-group mb-3">
                                        <label>Review</label>
                                        <div class="input-group-prepend">
                                            <input type="radio" name="status" id="positive" value="positive" checked/>
                                            <label for="positive">Positive</label>
                                        
                                            <input type="radio" name="status" id="negative" value="negative"/>
                                            <label for="negative">Negative</label>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <Textarea class="form-control" name="comment">@if($review!=null){{$review->comment}}@endif</Textarea>
                                    </div>
                                    <input type = 'hidden' name="user_id" value = "{{ Auth::user()->id }}" />
                                    <input type="submit" class="btn btn-success" value="Save"/>
                                </form>
                            </div>

                            <!-- Settings Tab -->
                            <div class="tab-pane fade" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab">
                                 <form class="col-md-7" method="post" action="{{route('changePassword')}}">
                                    {{csrf_field()}}

                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Enter current password" required autofocus/>
                                    </div>

                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter new password" required autofocus/>
                                    </div>

                                    <div class="form-group">
                                        <label>Password Again</label>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Enter password again" required autofocus/>
                                    </div>

                                    <input type="submit" class="btn btn-success" value="Save"/>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
    </div>

</div>

@endsection