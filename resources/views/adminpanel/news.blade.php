@extends("layouts.adminPanelLayout")

@section('title', "News and Notice")

@section('content')

	<div class="container">
		<form method="post" action="{{route('news')}}" enctype="multipart/form-data">
	    {{csrf_field()}}
			<div class="row">
				<div class="col-lg-8">
					<div class="form-group">
						<label>News</label>
			            <TEXTAREA name="text" class="form-control" placeholder="Enter News" required autofocus style="height: 100px; width: 400px;">{{ $news->text }}</TEXTAREA>
			        </div>
					<div class="form-group">
						<label>Notice</label>
			            <input type="text" name="notice" class="form-control" placeholder="Enter Notice" required autofocus style="width: 400px;" value="{{ $notice->text }}">
			        </div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary ">Save</button>
		</form>
	</div>

@endsection