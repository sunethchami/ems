@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">               
                <div class="card-header">{{ __('All Employees') }}</div>

                <div class="card-body"> 
                    @include('flash')
                    <a class="btn btn-info add-btn" href="/employee/create">Add</a>                                                          
                    <table class="table table-bordered" id="allTable">
                        <thead>                            
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>                        
                            @foreach ($results as $row)
                                <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->first_name}}</td>
                                <td>{{$row->last_name}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->phone}}</td>
                                <td>
                                    <a class="btn btn-info" href="/employee/{{$row->id}}/edit">Edit</a>
                                    <a href="#" data-id="{{$row->id}}" data-bs-toggle="modal" data-bs-target="#comfirmModal" class="btn btn-danger deleteBtn">Delete</a>
                                </tr>
                            @endforeach                            
                        </tbody>
                    </table>  
                    <div class="d-flex justify-content-center">
                        {!! $results->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="comfirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete a Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Are you sure, do you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="yesBtn">Yes</button>
        <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">No</button>        
      </div>
    </div>
  </div>
</div>
@endsection

@section('post-js')
<script src="/js/jquery.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){                
      
      $('.deleteBtn').click(function(){
          var ID = $(this).data('id');
          //set the data attribute on the modal button
          $('#yesBtn').data('id', ID); 
      });
      

      $('#yesBtn').click(function(){
          var employeeId = $(this).data('id');
          window.location = "/employee/"+employeeId+"/delete";
      });
    
  });
  </script>
  @stop