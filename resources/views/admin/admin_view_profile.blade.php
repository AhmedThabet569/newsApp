@extends('admin.admin_master')
@section('content')
 
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <center class="mt-1 mb-3">
                        <img class="rounded-circle avatar-lg " src="{{!empty($data->profile_image)? url('ubload/admin_images/'.$data->profile_image) : url('upload/auth-bg.jpg')}}" 
                        
                        alt="Card image cap">

                    </center>
                    <div class="card-body">
                        <h4 class="card-title mb-2">Name : {{$data->name}}</h4>
                        <h4 class="card-title">Email : {{$data->email}}</h4>

                        <a href="{{route('edit.profile')}}"    class="btn btn-primary btn-rounded waves-effect waves-light">
                            Edit   
                        </a>
                    </div>
                </div>
            </div>

            
 

        </div>
    </div>
</div>
@endsection