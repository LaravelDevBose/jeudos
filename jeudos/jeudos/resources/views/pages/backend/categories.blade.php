@extends('layouts.backend')

@section('title') CATEGORIES @endsection
@section('category') active @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">Manage Influencer Categories</h3>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="media bg-white shadow">
                <div class="media-body">
                    <strong class="media-heading">Manage Influencers Category  <span class='form-status'> <span class="badge badge-success"> Create</span> </span></strong>
                    <form method="post" action="{{url('admin/categories')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="category_id" class="category_id" value=""/>
                            <div class="col-md-4">
                                <input type="text" name="name" required class="form-control name"
                                       placeholder="Category Name (e.g Actor)"/>
                            </div>
                            <div class="col-md-4">
                                <input type="color" name="color" required class="form-control color"
                                       placeholder="Select Color"/>
                            </div>
                            <div class="col-md-4">
                                <input type="file" name="image" class="form-control" placeholder="Select Display Image"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pt-2">
                                <button class="btn btn-primary btn-block" type="submit"> Submit</button>
                            </div>
                            <div class="col-md-4 pt-2">
                                <button class="btn btn-info btn-sm btn-rounded refresh" type="button"> Refresh</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($categories as $serial => $category)
            <div class="col-lg-4 col-md-6 col-12 pt-3 " style="border-radius: 10px">
                <div class="card bg-white pull-up shadow text-center align-center" style="border-radius: 10px">
                    @if(!empty($category->image_url) && !is_null($category->image_url))
                        <img src="{{asset($category->image_url)}}" class="card-img" style="border-radius: 10px;"/>
                    @else
                        <img src="{{asset('backend/images/default.jpg')}}" class="card-img"
                             style="border-radius: 10px"/>
                    @endif

                    <div class="card-img-overlay"
                         style="background-color: {{$category->color}}; opacity: .5; border-radius: 10px">
                        <h5 class="text-white align-middle">{{$category->name}}</h5>
                        <p>
                            <button class="btn btn-dark btn-sm edit" value="{{$category->id}}">Edit</button>
                            <a href="{{url('admin/category-sub/'.encrypt($category->id))}}" class="btn btn-dark btn-sm">Manage Sub Category</a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
           $('.edit').on('click',function(){
               let id = $(this).val();
               axios.get('/admin/category/'+ id)
                   .then((response) => {
                       $('.category_id').val(id)
                       $('.name').val(response.data.data.name)
                       $('.color').val(response.data.data.color)
                       $('.form-status').html('<span class="badge badge-primary"> Update</span>')
                       infoToast('Proceed to editing category', 'Form Populated');
                   })
           });
            $('.refresh').on('click',function(){
                $('.category_id').val('')
                $('.name').val('')
                $('.color').val('#000000')
                $('.form-status').html('<span class="badge badge-success"> Create</span>')
                infoToast('Proceed to creating new category', 'Form Refreshed')
            });
        });
    </script>
@endsection
