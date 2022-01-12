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
                  @if(Auth::user()->role = 1)
                 <div style="display:flex;  justify-content:end; ">
                     <a href="{{ route('add_items')}}" class="btn btn-primary"> <i class="fa fa-plus"></i>Add Item</a>
                 </div>
                 @else
                        <div></div>
                 @endif
                 <table class="table">
                     <thead>
                         <tr>
                             <th scope="col">#</th>
                             <th scope="col">Name</th>
                             <th scope="col">Capacity</th>
                             <th scope="col">Group</th>
                             <th scope="col">Phone Number</th>
                             <th scope="col">ICCID</th>
                            <th scope="col">Source Address</th>
                             <th scope="col">Created At</th>
                             <th scope="col">Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @if(count($items)>0)
                         @foreach($items as $data)
                         <tr>

                             <td>{{$data->id}}</td>
                             <td>{{$data->name}}</td>
                             <td>{{$data->capacity}}</td>
                             <td>{{$data->group}}</td>
                             <td>{{$data->phone_num}}</td>
                             <td>{{$data->iccid}}</td>
                             <td>{{$data->source_address}}</td>
                             <td>{{$data->created_at}}</td>

                             <td>
                               
                                   @if(Auth::user()->role = 1)
                                  <form method="POST" action="{{ route('delete_item', [ 'id'=> $data->id ]) }}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-icon">
                                <i class="fa fa-trash"></i>
                                </button>
                                </form>
                                
                                   @else
                                <button type="submit" data-id="{{$data->id}}" data-name="{{$data->name}}"
                                     class="btn btn-primary btn-icon view">
                                     <i class="fa fa-eye"></i>
                                 </button>
                                   @endif
                             </td>
                         </tr>
                         @endforeach
                         @else
                         <tr>
                             <td colspan="6" class="text-center">No Record Found</td>
                         </tr>

                         @endif
                     </tbody>
                 </table>


                 
             </div>
         </div>
     </div>
 </div>
 <script>
$('.view').click(function() {

    $('#exampleModal').modal('show');
    $('#exampleModalLabel').html('');
    $('#exampleModalLabel').html(`${$(this).attr('data-name').toUpperCase()}`);


    //  $('.modal-body').html('');
    //  $('.modal-body').append(`${$(this).attr('data-id')}`);

})
 </script>
 @endsection