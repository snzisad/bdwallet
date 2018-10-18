@extends("layouts.generalLayout")

@section('title', "Reviews")

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="panel-heading">Reviews</div>

                    <div class="panel-body">
                        @foreach($reviews as $review)
                            <div class="testimonials">
                                <h5 class="author"> {{ $review->user->name }}</h5>
                                @if($review->status == "positive")
                                    <span class="status text-light bg-success"><i class="fa fa-smile-o"></i> Positive</span>
                                @else
                                    <span class="status text-light bg-danger"><i class="fa fa-frown-o"></i> Negative</span>
                                @endif
                                <p class="text"> {{ $review->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection