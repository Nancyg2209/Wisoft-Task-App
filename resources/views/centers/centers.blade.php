@extends('layout')

@section('content')


<h1>LIST OF ACTIVE CENTERS</h1>

<div class="new_centers">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add New Center</button>
</div>

<!-- Modal -->
<div id="myModal" class="modalz fade" role="dialog">
  <div class="modal-dialog"></div>

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter New Center</h4>
      </div>
      <div class="modal-body">
        <form id="center_form" action="{{ route('center.store') }}" method="POST">
            {{ csrf_field() }}

        <div class="row">

            <div class="form-group">
                <label class="col-md-12" >Center Name</label>
              <input type="text" class="form-control" id="center" name="center">
            </div>
          </div>
         <br>

          <div class="row">
            <div class="form-group">
          <label class="col-md-12"> Center Location</label>
              <input type="text" class="form-control" id="center_location" name="center_location">
            </div>
          </label>
          </div>

        </div>

        <br>

        <div class="row">
          <div class="form-group">
        <label class="col-md-12"> Center Post Code</label>
            <input type="text" class="form-control" id="center_postcode" name="center_postcode">
          </div>
        </label>
        </div>

      </div>

      <br>

        <div class="row">
          <div class="form-group">
        <label class="col-md-12"> Center Opening date</label>
            <input type="text" class="form-control" id="center_postcode" name="center_postcode">
          </div>
        </label>
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
        <th>Center Name</th>
        <th>Tasks List</th>
        <th>Actions</th>
      </tr>
    </thead>

@if ( !$centers->isEmpty() )
    <tbody>
    @foreach ( $centers  as $center)
      <tr>
        <td>{{ $center->center_name }} </td>
        {{--  <td>
           <a href="{{ route('task.list', [ 'centerid' => $centerid->id ]) }}">List all tasks</a>
        </td>  --}}
        <td>
          <a class="btn btn-primary" href="{{ route('center.edit', [ 'id' => $center->id ]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
          <a class="btn btn-danger" href="{{ route('center.delete', [ 'id' => $center->id ]) }}" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;
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
  var x = confirm("Are you sure? Deleting a Center will also delete all tasks associated with this Center");
  if (x)
      return true;
  else
    return false;
}
</script>
