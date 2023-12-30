@extends('admin.admin_master')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Edit Profile </h4>
                        <form method="post" action="{{route('store.profile')}}" enctype="multipart/form-data">
                             @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name" value="{{$data->name}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" name="email"   value="{{$data->email}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="profile_image"    id ="image">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <img class="rounded  avatar-lg"  id="showImage" src="{{!empty($data->profile_image)? url('ubload/admin_images/'.$data->profile_image) : url('upload/auth-bg.jpg')}}"
                        alt="Header Avatar">
                                </div>
                            </div> 
                                <input type="submit" class="btn btn-info" value="Edit Profile" name="submit"/>
                            </div>
                        </form>
                       
                       
                      
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script> 
     $(document).ready(function(){
         $('#image').change(function(e){
            var reader = new FileReader();
            console.log(reader);
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result)
            };
            reader.readAsDataURL(e.target.files['0']);
         })
     })
    </script>
@endsection