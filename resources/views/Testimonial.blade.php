@extends("layouts.generalLayout")

@section('title', "Reviews")

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="panel-heading">Reviews</div>

                    <div class="panel-body">
                        <div class="testimonials">
                            <h5 class="author">Sharif Noor Zisad</h5>
                            <span class="status text-light bg-success"><i class="fa fa-smile-o"></i> Positive</span>
                            <p class="text">Very good site</p>
                        </div>

                        <div class="testimonials">
                            <h5 class="author">Sharif Noor Zisad</h5>
                            <span class="status text-light bg-danger"><i class="fa fa-frown-o"></i> Negative</span>
                            <p class="text">Service is slow</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection