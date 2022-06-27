@extends('layout')

@section('content')

@include('includes.errors')

<form id="department_form" action="{{ route('department.update', [ 'id' => $edit_department->id ]) }}" method="POST">
    {{ csrf_field() }}

<label>Edit Department <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></label>

<div class="row">
    <div class="col-md-8">
		<div class="form-group">
			<input type="text" class="form-control" id="department" name="name" value="{{ $edit_department->department_name }}">
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


