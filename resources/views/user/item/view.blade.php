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
                <!-- <div style="display:flex;  justify-content:end; ">
                    <a href="{{ route('add_items')}}"class="btn btn-primary"> <i class="fa fa-plus"></i>Add Item</a>
                </div> -->
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
                     <tbody>
                    @if(count($items)>0)
                        @foreach($items as $data)
                         <tr>
                        
                            <td>{{$data->id}}</td>
                            <td>{{$data->items->name}}</td>
                            <td>{{$data->items->capacity}}</td>
                             <td>{{$data->items->created_at}}</td>
                            <td>
                               <button type="submit" data-id="{{$data->id}}" data-name="{{$data->items->name}}"
                                     class="btn btn-primary btn-icon view">
                                     <i class="fa fa-eye"></i>
                                 </button>
                            </td>

                         </tr>  
                         @endforeach
                    @else
                        <tr><td colspan="6" class="text-center">No Record Found</td></tr>

                          @endif
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

                                     <div class="row">
                                         <div class="col-md-6">
                                             <a href="#" class="btn btn-primary" style="width:100%"> Output On</a>
                                         </div>
                                         <div class="col-md-6">
                                             <input class="form-control" type="text">
                                         </div>
                                     </div>
                                     <div class="row" style="margin-top: 10px;">
                                         <div class="col-md-6">
                                             <a href="#" class="btn btn-primary" style="width:100%"> Output off</a>
                                         </div>
                                         <div class="col-md-6">
                                             <input class="form-control" type="text">
                                         </div>
                                     </div>

                                     <div class="row" style="margin-top: 10px;">
                                         <div class="col-md-6">
                                             <a href="#" class="btn btn-primary" style="width:100%">Restart</a>
                                         </div>
                                         <div class="col-md-6">
                                             <input class="form-control" type="text">
                                         </div>
                                     </div>

                                     <div class="row" style="margin-top: 10px;">
                                         <div class="col-md-6">
                                             <a href="#" class="btn btn-primary" style="width:100%">Custom sms</a>
                                         </div>
                                         <div class="col-md-6">
                                             <input class="form-control" type="text">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary"
                                         data-bs-dismiss="modal">Close</button>
                                     <button type="button" class="btn btn-primary">Save changes</button>
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

     $('.view').click(function() {

    $('#exampleModal').modal('show');
    $('#exampleModalLabel').html('');
    $('#exampleModalLabel').html(`${$(this).attr('data-name').toUpperCase()}`);


    //  $('.modal-body').html('');
    //  $('.modal-body').append(`${$(this).attr('data-id')}`);

})
 </script>
 @endsection