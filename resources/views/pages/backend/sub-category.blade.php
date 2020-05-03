@extends('layouts.backend')

@section('title') {{strtoupper($category->name)}} SUB CATEGORIES @endsection
@section('category') active @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">Manage {{ucfirst($category->name)}} Sub Categories</h3>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-12">

        </div>
    </div>
    <div class="row">
            <div class="col-lg-4" style="border-radius: 10px">
                <a href="{{url('admin/categories')}}">
                <div class="card bg-white pull-up shadow text-center align-center" style="border-radius: 10px">
                    @if(!empty($category->image_url) && !is_null($category->image_url))
                        <img src="{{asset($category->image_url)}}" class="card-img" style="border-radius: 10px;"/>
                    @else
                        <img src="{{asset('backend/images/default.jpg')}}" class="card-img"
                             style="border-radius: 10px"/>
                    @endif

                    <div class="card-img-overlay"
                         style="background-color: {{$category->color}}; opacity: .5; border-radius: 10px">
                        <h1 class="text-white align-middle">{{$category->name}}</h1>
                    </div>
                </div>
                </a>
            </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="media bg-white shadow">
                        <div class="media-body">
                            <strong class="media-heading">Manage Sub Category  <span class='form-status'> <span class="badge badge-success"> Create</span> </span></strong>
                            <form method="post" action="{{url('admin/sub-category')}}">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="category_id" value="{{$id}}"/>
                                    <input type="hidden" name="sub_category_id" class="sub_category_id" value=""/>
                                    <div class="col-md-4">
                                        <input type="text" name="name" required class="form-control name"
                                               placeholder="Sub Category Name (e.g Hollywood, Basketball, Action)"/>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary btn-block" type="submit"> Submit</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-info btn-sm btn-rounded refresh" type="button"> Refresh</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-12 pt-3">
                    <div class="media bg-white shadow">
                        <div class="media-body">
                            <strong class="media-heading">Sub Categories</strong>
                          <div class="table-responsive">
                       <table class="table table-striped">
                           <thead>
                           <tr>
                               <th>(S/N)</th>
                               <th>Name</th>
                               <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($subCategories as $serial => $subCategory)
                           <tr>
                               <td>{{$serial + 1}}</td>
                               <td>{{ucfirst($subCategory->name)}}</td>
                               <td><button class="btn btn-dark edit" value="{{$subCategory->id}}">Edit</button></td>
                           </tr>
                           @endforeach
                           </tbody>
                       </table>
                   </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
           $('.edit').on('click',function(){
               let id = $(this).val();
               axios.get('/admin/sub-category/'+ id)
                   .then((response) => {
                       $('.sub_category_id').val(id)
                       $('.name').val(response.data.data.name)
                       $('.form-status').html('<span class="badge badge-primary"> Update</span>')
                       infoToast('Proceed to editing sub category', 'Form Populated');
                   })
           });
            $('.refresh').on('click',function(){
                $('.sub_category_id').val('')
                $('.name').val('')
                $('.form-status').html('<span class="badge badge-success"> Create</span>')
                infoToast('Proceed to creating new sub category', 'Form Refreshed')
            });
        });
    </script>
@endsection
