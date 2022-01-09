 @extends('layouts.admin')

 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="card" style="margin-bottom:5%">
             <div class="card-body">
                 Add Item
             </div>
         </div>
         <div class="col-md-8">
             <div class="card p-4">
                 @if (count($errors) > 0)
                 <div class="alert alert-danger">
                     <ul>
                         @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                         @endforeach
                     </ul>
                 </div>
                 @endif
                 <form method="POST" action="{{ route('add_items') }}">
                     @csrf
                     <div class="mb-3 mt-3">
                         <label for="name">Name:</label>
                         <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                     </div>
                     <div class="mb-3 mt-3">
                         <label for="capacity">Capacity:</label>
                         <input type="number" class="form-control" id="capacity" placeholder="Enter Capacity" required name="capacity">
                     </div>

                     <div>
                         <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 @endsection