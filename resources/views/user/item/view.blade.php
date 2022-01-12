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
                             <td>{{$data->items->name}}</td>
                             <td>{{$data->items->capacity}}</td>
                             <td>{{$data->items->group}}</td>
                             <td>{{$data->items->phone_num}}</td>
                             <td>{{$data->items->iccid}}</td>
                             <td>{{$data->items->source_address}}</td>
                             <td>{{$data->items->created_at}}</td>
                             <td>
                                 <button type="submit" data-iccid="{{$data->items->iccid}}"  data-source_address="{{$data->items->source_address}}"  data-group="{{$data->items->group}}" data-id="{{$data->id}}"  data-phone="{{$data->items->phone_num}}" data-name="{{$data->items->name}}"
                                     class="btn btn-primary btn-icon view">
                                     <i class="fa fa-eye"></i>
                                 </button>
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

                 <div class="container">

                     <!-- Modal -->
                     <input type="hidden" name="group" id="whichGroup" value="">

                     <input type="hidden" name="source_address" id="source_address" value="">
                   

                     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                         <div class="modal-dialog modal-lg">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel"></h5>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                                         aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                        <input type="hidden" name="phone_num" value="" id="phone_num">

                                        <input type="hidden" name="iccid" value="" id="iccid">
                                     <div class="row">
                                         <div class="col-md-6">
                                             <a href="#" class="btn btn-primary" data-msg="bestpassword S1=1" id="outputOn"
                                                 style="width:100%">Output On</a>
                                         </div>
                                         <div class="col-md-6">
                                             <input class="form-control" id="output"  type="text">
                                         </div>
                                     </div>
                                   
                                     <div class="row" style="margin-top: 10px;">
                                         <div class="col-md-6">
                                             <a href="#" class="btn btn-primary" data-msg="bestpassword S1=0" id="outputOff" style="width:100%"> Output off</a>
                                         </div>
                                         <div class="col-md-6">
                                             <input class="form-control" id="outputOffInput"   type="text">
                                         </div>
                                     </div>

                                     <div class="row" style="margin-top: 10px;">
                                         <div class="col-md-6">
                                             <a href="#" class="btn btn-primary" data-msg="bestpassword R" id="restart" style="width:100%">Restart</a>
                                         </div>
                                         <div class="col-md-6">
                                             <input class="form-control" id="restartOne"    type="text">
                                         </div>
                                     </div>

                                     <div class="row" style="margin-top: 10px;">
                                         <div class="col-md-6">
                                             <a href="#" class="btn btn-primary"  id="customSMS" style="width:100%">Custom sms</a>
                                         </div>
                                         <div class="col-md-6">
                                             <input class="form-control"  id="customSMSVal" type="text" value="">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary"
                                         data-bs-dismiss="modal">Close</button>
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
  
let token =  "Bearer eyJpZHRva2VuIjoiZXlKcmFXUWlPaUpVWlVkeWVqbExkbEJRWTNKYVdURXljRXBWUXpod2NYVjRVbnAxSzAxRU1HdENlRzh6Ukc1bFlXTkJQU0lzSW1Gc1p5STZJbEpUTWpVMkluMC5leUp6ZFdJaU9pSXdOV1UxWmpJd1lTMWxZakE1TFRSa1lUSXRPV0ppWkMwMU1tVmlaRFl3TWpneE1HWWlMQ0pqYjJkdWFYUnZPbWR5YjNWd2N5STZXeUpQZDI1bGNpSmRMQ0psYldGcGJGOTJaWEpwWm1sbFpDSTZkSEoxWlN3aWFYTnpJam9pYUhSMGNITTZYQzljTDJOdloyNXBkRzh0YVdSd0xtVjFMV05sYm5SeVlXd3RNUzVoYldGNmIyNWhkM011WTI5dFhDOWxkUzFqWlc1MGNtRnNMVEZmWW5Nd2FuQk9NMWhsSWl3aVkyOW5ibWwwYnpwMWMyVnlibUZ0WlNJNklqTXlNakUxTkRVMU5USWlMQ0p2Y21sbmFXNWZhblJwSWpvaU9URm1aVGhqTmpZdFlUQmxNeTAwWm1WakxUZzJNR1V0T1Rrd09USXhZVFF4WXpWa0lpd2lZWFZrSWpvaU56aDJNbXR6YldGeGNYVTJPSEpxWkcxdE1ta3liamhyWkc0aUxDSmpkWE4wYjIwNlkzVnpkRzl0WlhKSlpDSTZJak15TWpFMU5EVTFORGdpTENKbGRtVnVkRjlwWkNJNkltUTJNVGhtTkdFNUxXSTBOelF0TkRnMk1DMDVaREJtTFRoak1HTm1aR0l4TlRsbU1DSXNJblJ2YTJWdVgzVnpaU0k2SW1sa0lpd2lZWFYwYUY5MGFXMWxJam94TmpReE9ETTFOekF5TENKbGVIQWlPakUyTkRFNE16a3pNRElzSW1saGRDSTZNVFkwTVRnek5UY3dNaXdpYW5ScElqb2lZekExWXpRMlpqa3RZalU0TmkwMFpEazBMV0ZoTmpjdE1UUTVZMkl4T0dFNE5EQmxJaXdpWlcxaGFXd2lPaUpwYm1adlFITnRZWEowYTI5emIzWmhMbU52YlNKOS5iMlRmOE9kb1g1c1F5NkFVcjlyUGVoQldieU03cHphT1l5dGlpcmlrUjU1UGR6N0ZNRHFiOUZqUEgzSDBOUEpsU1FINXhKam1LMnNjNi1FODQ1MnhXYUViUFpELVRmUEFYUmdzVWtkUmJfM0FucEZ3VHpyOEp5QlpBZEJKcFFPdFlLajNoY2JtN3g5dUFBS2tZUkF0ck9tNDU1clFUeVN0dlZObHZaTVFjNU9zZ25walJCVjFuZmlUdGV1VzBhTGc0YURsQ1NHX1BDa05lTWJGbEVzUFpnbmFrNjBWVkpRNUV4YndfbEhWcUFYaEVtaGZpNi0zLW43QV9IYnU1LW1pREVwVUF4VEE1Ri1Jb092S0ZWYmRqcmpmZ0dkbzM1TnNISm1OU25oWXdzd1pPUFk3NkpGQ2FTbDF0SHk2bFhQRjdHT1ZwdUVUalNsSXZsY3RHd2dtMVEiLCJhY2Nlc3N0b2tlbiI6ImV5SnJhV1FpT2lKVGRGbFZSWGx3VmpWaE1HeEdkazVaTUZ3dmJGcFFZVkY0UzNwT1lqTm9RemRjTDA5a1VFSnlPRXBOY21NOUlpd2lZV3huSWpvaVVsTXlOVFlpZlEuZXlKemRXSWlPaUl3TldVMVpqSXdZUzFsWWpBNUxUUmtZVEl0T1dKaVpDMDFNbVZpWkRZd01qZ3hNR1lpTENKamIyZHVhWFJ2T21keWIzVndjeUk2V3lKUGQyNWxjaUpkTENKcGMzTWlPaUpvZEhSd2N6cGNMMXd2WTI5bmJtbDBieTFwWkhBdVpYVXRZMlZ1ZEhKaGJDMHhMbUZ0WVhwdmJtRjNjeTVqYjIxY0wyVjFMV05sYm5SeVlXd3RNVjlpY3pCcWNFNHpXR1VpTENKamJHbGxiblJmYVdRaU9pSTNPSFl5YTNOdFlYRnhkVFk0Y21wa2JXMHlhVEp1T0d0a2JpSXNJbTl5YVdkcGJsOXFkR2tpT2lJNU1XWmxPR00yTmkxaE1HVXpMVFJtWldNdE9EWXdaUzA1T1RBNU1qRmhOREZqTldRaUxDSmxkbVZ1ZEY5cFpDSTZJbVEyTVRobU5HRTVMV0kwTnpRdE5EZzJNQzA1WkRCbUxUaGpNR05tWkdJeE5UbG1NQ0lzSW5SdmEyVnVYM1Z6WlNJNkltRmpZMlZ6Y3lJc0luTmpiM0JsSWpvaVlYZHpMbU52WjI1cGRHOHVjMmxuYm1sdUxuVnpaWEl1WVdSdGFXNGlMQ0poZFhSb1gzUnBiV1VpT2pFMk5ERTRNelUzTURJc0ltVjRjQ0k2TVRZME1UZ3pPVE13TWl3aWFXRjBJam94TmpReE9ETTFOekF5TENKcWRHa2lPaUkzWWpBMlkyRmpaaTB5TjJOaUxUUXlOVGN0WVdFek5pMWpaVGc1Tnpka01qVmtNMklpTENKMWMyVnlibUZ0WlNJNklqTXlNakUxTkRVMU5USWlmUS5tSGxySDN6bWUtb3hDTm1WUE9TWDZ3MzE1SEZVVm5vREFFU20yVjBBcFlqSE82THhpOVUwWFpoTHlUNXRTc3BTQ3JSNGV4UllZekRhY2xEMkwwOE1tZ1lscTQ5ZjJIVjEzb0hYVEJWX09sdFFZZVdMQ2VxNXFLU3F3ejFyczRhNEtLbTFsSU8zOVFfMWFtUFo5T1ZyMThfdmVqR210WWpsZE1UNFZkMG0wRTRnYVMxXzhiN2tnOVhtaXRpNW1xVEVjQ0UxVFpOSzVTSGFHbzdaUm1iWGVkTXBsaDYwTVhPZVB0ZGYwUlhiLVE2NVB0MW9SYVlFeDBXdklrYzN0NXlMU0RoWGlpd19Ndm5rT3RkOC1wanJ0RWFINkN0bk10NzM2TlotRGN2ci0yMVBTQ1lSNXVmaEJpNzFvbGhMTmlLR19KZE5CMDVTeXBual9VNUJWMzNUeGcifQ"
 
$('#outputOn').click(function(){

  let message =$(this).attr('data-msg')
  let whichGroup =$('#whichGroup').val();
    let key ='6020ea856f45a81f1c07e8c0362707c8592048cf'
    let phone = $('#phone_num').val()
    let iccid = $('#iccid').val()
    let source_address = $('#source_address').val()
    if (whichGroup == "1") {
         $.ajax({
        url: `https://api.smartkosova.com/api/send?key=${key}&phone=${phone}&message=${message}`,
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            $('#output').val(data.message);
        },
        error: function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
        });
    }
    else{
        $.ajax({
        url: `https://api.1nce.com/management-api/v1/sims/${iccid}/sms`,
        type: 'POST',
         headers: {
            'Authorization': token,
          },
        dataType: 'json',
        data:{
             "source_address":source_address,
              "payload":message
        },
        success: function(data1) {
            $('#output').val(data1.message);
        },
        error: function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
        });
    }
    
})

$('#outputOff').click(function(){
  let whichGroup =$('#whichGroup').val();
    let key ='6020ea856f45a81f1c07e8c0362707c8592048cf'
    let phone = $('#phone_num').val()
    let iccid = $('#iccid').val()
    let source_address = $('#source_address').val()
    let message =$(this).attr('data-msg')
    
   if (whichGroup == "1") {
         $.ajax({
        url: `https://api.smartkosova.com/api/send?key=${key}&phone=${phone}&message=${message}`,
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            $('#outputOffInput').val(data.message);
        },
        error: function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
        });
    }
    else{
        $.ajax({
        url: `https://api.1nce.com/management-api/v1/sims/${iccid}/sms`,
        type: 'POST',
      
          headers: {
            'Authorization': token,
          },
        dataType: 'json',
        data:{
             "source_address":source_address,
              "payload":message
        },
        success: function(data1) {
            $('#outputOffInput').val(data.message);
        },
        error: function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
        });
    }
})
$('#restart').click(function(){
    let message =$(this).attr('data-msg')
      let whichGroup =$('#whichGroup').val();
    let key ='6020ea856f45a81f1c07e8c0362707c8592048cf'
    let phone = $('#phone_num').val()
    let iccid = $('#iccid').val()
    let source_address = $('#source_address').val()
 
  if (whichGroup == "1") {
         $.ajax({
        url: `https://api.smartkosova.com/api/send?key=${key}&phone=${phone}&message=${message}`,
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            $('#restartOne').val(data.message);
        },
        error: function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
        });
    }
    else{
        $.ajax({
        url: `https://api.1nce.com/management-api/v1/sims/${iccid}/sms`,
        type: 'POST',
          headers: {
            'Authorization': token,
          },
        dataType: 'json',
        data:{
             "source_address":source_address,
              "payload":message
        },
        success: function(data1) {
            $('#restartOne').val(data1.message);
        },
        error: function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
        });
    }
})

$('#customSMS').click(function(){
     let whichGroup =$('#whichGroup').val();
    let key ='6020ea856f45a81f1c07e8c0362707c8592048cf'
    let phone = $('#phone_num').val()
    let iccid = $('#iccid').val()
    let source_address = $('#source_address').val()
    let message =$('#customSMSVal').val()
        
  if (whichGroup == "1") {
         $.ajax({
        url: `https://api.smartkosova.com/api/send?key=${key}&phone=${phone}&message=${message}`,
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            $('#customSMSVal').val(data.message);
        },
        error: function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
        });
    }
    else{
        $.ajax({
        url: `https://api.1nce.com/management-api/v1/sims/${iccid}/sms`,
        type: 'POST',
       
         headers: {
            'Authorization': token,
          },
          
        dataType: 'json',
        data:{
             "source_address":source_address,
              "payload":message
        },
        success: function(data1) {
            $('#customSMSVal').val(data1.message);
        },
        error: function(request, error) {
            alert("Request: " + JSON.stringify(request));
        }
        });
    }
})


$('.view').click(function() {
    $('#output').val('')
    $('#outputOffInput').val('')
    $('#restartOne').val('')
$('#customSMSVal').val('')
    
    $('#exampleModal').modal('show');
    $('#exampleModalLabel').html('');
    $('#exampleModalLabel').html(`${$(this).attr('data-name').toUpperCase()}`);
    
    $('#phone_num').val($(this).attr('data-phone'));
    $('#iccid').val($(this).attr('data-iccid'));
    $('#source_address').val($(this).attr('data-source_address'));
    $('#whichGroup').val(`${$(this).attr('data-group')}`);
 
       
    //  $('.modal-body').html('');
    //  $('.modal-body').append(`${$(this).attr('data-id')}`);

})
 </script>
 @endsection