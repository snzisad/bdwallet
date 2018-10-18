@extends("layouts.generalLayout")

@section('title', "Contact")

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Contact</div>

                <div class="panel-body">
                    <form  class="col-md-10" method="post" action="{{route('sendmessage')}}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" name="name" class="form-control" required autofocus />
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required autofocus />
                        </div>
                        
                        <div class="form-group">
                            <label>Message</label>
                            <Textarea class="form-control" name="message" required autofocus></Textarea>
                        </div>
                        <input type="submit" class="btn btn-success" value="Send"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection