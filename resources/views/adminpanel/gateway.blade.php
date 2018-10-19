@extends("layouts.adminPanelLayout")

@section('title', "Gateway")

@section('content')

    <div class="container">

        <div class="panel">
            <div class="panel_title">
                New Gateway
            </div>
            <div class="panel_content">
                <form class="row" method="post" action="{{route('addGateway')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="col-md-2">
                        <h5>Gateway Name</h5>
                        <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="col-md-2">
                        <h5>Reserve</h5>
                        <input type="number" class="form-control" name="reserve" placeholder="Enter amount" required>
                    </div>
                    <div class="col-md-2">
                        <h5>Balance Type</h5>
                        <select class="form-control" name="type" required>
                            @foreach($balance_type as $type)
                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <h5>My Account</h5>
                        <input type="text" class="form-control" name="account" placeholder="Enter Account" required>
                    </div>
                    <div class="col-md-3">
                        <h5>Logo</h5>
                        <input type="file" name="icon" required>
                    </div>
                    <div class="col-md-1">
                        <input type="submit" class="btn btn-success" value="Add" style="margin-top: 20px;">
                    </div>
                </form>
            </div>
        </div>

        <div class="panel">
            <div class="panel_title">
                All Gateway
            </div>
            <div class="panel_content">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Icon</th>
                      <th scope="col">Gateway</th>
                      <th scope="col">Reserve</th>
                      <th scope="col">Type</th>
                      <th scope="col">My Account</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($all_gateway as $gateway)
                        <tr>
                            <form class="row" method="post" action="{{route('editGateway')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $gateway->id }}">

                              <td style="vertical-align: middle; text-align: center;"> 
                                <img src="{{asset('picture/icon/'.$gateway->icon)}}" alt="{{ $gateway->name }}" height="35px" width="35px">
                                <br>
                                <div class="custom-file" style="margin-top: 5px;">
                                  <input type="file" name="icon" id="icon" style="opacity: 0; position: absolute;" />
                                  <label for="icon" class="btn btn-outline-primary btn-sm">Change</label>
                                </div>
                              </td>
                              <td  style="vertical-align: middle;">
                                <input type="text" class="form-control" name="name" placeholder="Enter name" required value="{{ $gateway->name }}">
                              </td>
                              <td  style="vertical-align: middle;">
                                <input type="text" class="form-control" name="reserve" placeholder="Enter name" required value="{{ $gateway->reserve }}">
                              </td>
                              <td  style="vertical-align: middle;">
                                <select class="form-control" name="type" required>
                                    @foreach($balance_type as $type)
                                        @if($type->type == $gateway->type)
                                            <option value="{{ $type->id }}" selected>{{ $type->type }}</option>
                                        @else
                                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                                        @endif
                                    @endforeach
                                </select>
                              </td>
                              <td  style="vertical-align: middle;">
                                <input type="text" class="form-control" name="account" placeholder="Enter Account" required value="{{ $gateway->account }}">
                              </td>
                              <td  style="vertical-align: middle;">
                                <input type="submit" class="btn btn-primary btn-sm" value="Save">                                
                                <!-- <a href="{{asset('/adminpanel/gateway/remove/'.$gateway->id)}}" class="btn btn-danger btn-sm">Delete</a> -->
                              </td>

                            </form>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

<!-- <input type="file" name="icon" id="icon" style="opacity: 0; position: absolute; z-index: -1;" /> -->
                                  <!-- <label class="custom-file-label btn btn-outline-primary btn-sm" for="icon">Change</label> -->