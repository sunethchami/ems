@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('All Companies') }}</div>

                <div class="card-body">  
                    
                    @include('flash')
                                        
                    <a class="btn btn-info add-btn" href="/company/create">Add</a>                                                           
                    <table class="table table-bordered" id="allTable">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Logo</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        
                            @foreach ($results as $row)
                                <tr>                                
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->website}}</td>
                                <td>
                                    @if( $row->logo != null )
                                    <img src="{{ asset('storage/'.$row->logo) }}" alt="Logo" width="100" height="100">
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="/company/{{$row->id}}/edit">Edit</a>
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
<script>
$(document).ready(function(){                
      
      $('.deleteBtn').click(function(){
          var ID = $(this).data('id');
          //set the data attribute on the modal button
          $('#yesBtn').data('id', ID); 
      });
      

      $('#yesBtn').click(function(){
          var companyId = $(this).data('id');
          window.location = "/company/"+companyId+"/delete";
      });
    
  });

  </script>
  @stop