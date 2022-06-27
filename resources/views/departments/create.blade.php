@extends('layout')

@section('content')

@include('includes.errors')

<form id="department_form" action="{{ route('department.store') }}" method="POST">
    {{ csrf_field() }}

<label>Create a new Department <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></label>

<div class="row">
    <div class="col-md-8">
		<div class="form-group">
			<input type="text" class="form-control" id="department" name="department">
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
	var department = document.forms["department_form"]["department"].value;

	if ( !department.length ) {
		swal("Enter Departmet Name", "" , "warning") ;
		document.getElementById("department").focus();
		return false;
	}
}

</script>

