@extends('layouts.app')
@section('title')  Become and influencer on {{config('app.name')}}  @endsection
@section('hero-image') --image-url: linear-gradient(-45deg, rgba(235, 64, 52, .5) 0%, rgba(218, 51, 33, .5) 39%, rgba(239, 117, 40, .5) 55%), url({{asset('backend/images/other-pages.jpg')}}); @endsection
@section('content-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="my-auto mx-auto align-self-center align-center text-center">
                <h1 class="text-light text-bold br-0">Apply to join {{config('app.name')}}</h1>
                <h4 class="text-light text-bold">If you have fans and want to join {{config('app.name')}} as talent, you can enroll here and we will be in touch.</h4>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-12 col-12 mx-auto">
         <div class="card bg-white">
             <div class="card-body">
                <form method="POST" action="{{url('register-influencer')}}">
                    @csrf
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" required placeholder="e.g Will Smith" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required placeholder="e.g email@address.com" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Phone number <small>(never shared)</small></label>
                        <input type="tel" name="phone" required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>The Platform(s) where you have the most active audience find you? </label>
                        <select class="form-control" required name="media">
                            <option value="Twitter">Twitter</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Snapchat">Snapchat</option>
                            <option value="Facebook">Facebook</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Your handle</label>
                        <input type="text" name="media_handle" placeholder="e.g @he_is_unique" required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>How many followers do you have ?</label>
                        <input type="number" name="followers" required class="form-control"/>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
             </div>
         </div>
        </div>
    </div>
@endsection
