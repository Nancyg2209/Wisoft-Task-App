@extends('layout')

@section('content')

@include('includes.errors')

<form id="centers_form" action="{{ route('center.store') }}" method="POST">
    {{ csrf_field() }}

<label>Create a new Center <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></label>

<div class="row">
    <div class="col-md-8">
		<div class="form-group">
			<input type="text" class="form-control" id="center" name="center">
		</div>
	</div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <input type="text" class="form-control" id="center_location" name="center_location">
            </div>
        </div>




	<div class="col-md-4">
		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="Submit" onclick="return validateForm()">
			<a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">Cancel</a>
		</div>
	</div>
</div>

</form>

@stop

<script>
function validateForm() {
	console.log("VALIDATE FORM CLICKED") ;
	var center = document.forms["center_form"]["center"].value;

	if ( !center.length ) {
		swal("Enter Center Name", "" , "warning") ;
		document.getElementById("center").focus();
		return false;
	}
}

</script>

