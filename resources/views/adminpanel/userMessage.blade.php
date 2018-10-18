
@extends("layouts.adminPanelLayout")

@section('title', "Messages")

@section('content')
	
	<div class="container">

        <div class="panel">
            <div class="panel_title">
                Messages
            </div>
            <div class="panel_content">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">User</th>
                      <th scope="col">Email</th>
                      <th scope="col">Message</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($messages as $message)
                        <tr>
                              <td style="text-align: center;"> 
                                {{ $message->name }}
                              </td>
                              <td  style="text-align: center;">
                                {{ $message->email }}
                              </td>
                              <td style="text-align: center;"> 
                                {{ $message->message }}
                              </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection