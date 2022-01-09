 @extends('layouts.admin')

 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="card" style="margin-bottom:5%">
             <div class="card-body">
                 List Of User
             </div>
         </div>
         <div class="col-md-12">
             <div class="card p-4">
                 @if(session()->has('message'))
                 <div class="alert alert-success">
                     {{ session()->get('message') }}
                 </div>
                 @endif
                 <div style="display:flex;  justify-content:end; ">
                     <a href="{{ route('users')}}" class="btn btn-primary"> <i class="fa fa-plus"></i>Add User</a>
                 </div>
                 <table class="table">
                     <thead>
                         <tr>
                             <th scope="col">#</th>
                             <th scope="col">Name</th>
                             <th scope="col">Email</th>
                             <th scope="col">Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <!-- {{$user}}   -->
                         @foreach($user as $data)
                         <tr>

                             <td>{{$data->id}}</td>
                             <td>{{$data->name}}</td>
                             <td>{{$data->email}}</td>
                             <td style="display:flex;">
                                 @if($data->role == 1)
                                 <div>-</div>
                                 @else
                                 <div>
                                     <form method="POST" action="{{ route('delete_user', [ 'id'=> $data->id ]) }}">
                                         @csrf
                                         <input type="hidden" name="_method" value="DELETE">
                                         <button type="submit" class="btn btn-danger btn-icon">
                                             <i class="fa fa-trash"></i>
                                         </button>
                                     </form>
                                 </div>

                                 <div style="margin-left: 5px;">
                                     <button data-id="{{$data->id}}" class="btn btn-primary btn-icon assign">
                                         <i class="fa fa-plus"></i>
                                     </button>
                                 </div>

                                 @endif
                             </td>

                         </tr>
                         @endforeach

                     </tbody>
                 </table>


                 <div class="container">

                     <!-- Modal -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                         <div class="modal-dialog">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel"></h5>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                                         aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     <form method="POST" action="{{route('assign_items')}}">
                                         @csrf
                                         <div style="display:flex; justify-content:space-between">
                                         <div class="p-2">
                                             <input type="hidden" name="user_id" id="user_id" value="">
                                             <select class="selectpicker" name="item_id[]" multiple
                                                 aria-label="size 3 select example">
                                                 <option value="">Select Items</option>
                                                 @foreach($items as $item)
                                                 <option value="{{$item->id}}">{{$item->name}}</option>
                                                 @endforeach
                                             </select>
                                         </div>
                                         <div class="mt-2">
                                             <button type="submit" class="btn btn-primary">Assign</button>
                                         </div>
                                         </div>
                                     </form>
                                     <div class="modalBody">

                                     </div>
                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>
 </div>
 <script>
$('.assign').click(function() {

    $('#exampleModal').modal('show');
    $('#exampleModalLabel').html('');
    $('#exampleModalLabel').html(`Assign Items`);

    $('#user_id').val(`${$(this).attr('data-id')}`)

    $.ajax({

        url: 'http://localhost:8000/view-assign-items',
        type: 'POST',
      
        data: {
              "_token": "{{ csrf_token() }}",
            'id': $(this).attr('data-id')
        },
        dataType: 'json',
        success: function(data) {
            $('.modalBody').html('');
            $('.modalBody').append(` 
        <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Capacity</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody class="tbody">
        </tbody>
     </table>`);


  $.each(data, function(i, order){
     $('.tbody').append(`
     <tr>
        <td>${order.id}</td>
        <td>${order.items.name}</td>
        <td>${order.items.capacity}</td>
        <td>${order.items.created_at}</td>

        <td>
        <form method="POST" action="{{ route('delete_user_item')}}">
                                         @csrf
                                         <input type="hidden" name="id" value="${order.id}">
                                         <input type="hidden" name="_method" value="DELETE">
                                         <button type="submit" class="btn btn-danger btn-icon">
                                             <i class="fa fa-trash"></i>
                                         </button>
                                     </form>
        </td>

     </tr>
     `)
  });  
     
        },
        error: function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });
})
 </script>
 @endsection