@extends('layout')

@section('content')


<h1>LIST OF ACTIVE DEPARTMENTS</h1>

<div class="new_departments">

</div>

<!-- Modal -->


    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter New Department</h4>
      </div>
      <div class="modal-body">
        <form id="department_form" action="{{ route('department.store') }}" method="POST">
            {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control" id="department" name="department">
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <input class="btn btn-primary" type="submit" value="Submit" >
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

        </form>
      </div>

    </div>

  </div>
</div>
<!--  END modal  -->



<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Department Name</th>
        <th>Tasks List</th>
        <th>Actions</th>
      </tr>
    </thead>

@if ( !$departments->isEmpty() )
    <tbody>
    @foreach ( $departments  as $department)
      <tr>
        <td>{{ $department->department_name }} </td>
        <td>
           <a href="{{ route('task.list', [ 'departmentid' => $department->id ]) }}">List all tasks</a>
        </td>
        <td>
          <a class="btn btn-primary" href="{{ route('department.edit', [ 'id' => $department->id ]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
          <a class="btn btn-danger" href="{{ route('department.delete', [ 'id' => $department->id ]) }}" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;
        </td>

      </tr>

    @endforeach
    </tbody>
@else
    <p><em>There are no tasks assigned yet</em></p>
@endif


</table>
</div>




@stop


<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a Department will also delete all tasks associated with this department");
  if (x)
      return true;
  else
    return false;
}




</script>
