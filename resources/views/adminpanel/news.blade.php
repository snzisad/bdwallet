@extends("layouts.adminPanelLayout")

@section('title', "News")

@section('content')

	<div class="container">
		<form method="post" action="{{route('news')}}" enctype="multipart/form-data">
	    {{csrf_field()}}
			<div class="row">
				<div class="col-lg-8">
					<div class="form-group">
			            <TEXTAREA name="text" class="form-control" placeholder="Enter News" required autofocus style="height: 150px; width: 400px;">{{ $news->text }}</TEXTAREA>
			        </div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary ">Save</button>
		</form>
	</div>

@endsection