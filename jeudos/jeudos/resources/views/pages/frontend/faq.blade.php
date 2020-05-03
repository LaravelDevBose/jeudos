@extends('layouts.app')
@section('title')  FAQ  @endsection
@section('hero-image') --image-url: linear-gradient(-45deg, rgba(235, 64, 52, .5) 0%, rgba(218, 51, 33, .5) 39%, rgba(239, 117, 40, .5) 55%), url({{asset('backend/images/other-pages.jpg')}}); @endsection
@section('content-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="my-auto mx-auto align-self-center align-center text-center">
                <h1 class="text-light text-bold br-0">FAQ</h1>
                <h5 class="text-light text-bold">Frequently Asked Questions</h5>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-12 col-12 mx-auto">
            <div class="box shadow">
                <div class="box-body">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="navpills-1" class="tab-pane active">
                            <!-- Categroy 1 -->
                            <div class=" tab-pane animation-fade active" id="category-1" role="tabpanel">
                                <div class="panel-group panel-group-simple panel-group-continuous" id="accordion2"
                                     aria-multiselectable="true" role="tablist">
                                    <!-- Question 1 -->
                                    @forelse($faqs as $serial => $faq)
                                    <div class="panel">
                                        <div class="panel-heading" id="question-{{$serial+1}}" role="tab">
                                            <a class="panel-title" aria-controls="answer-{{$serial+1}}" aria-expanded="true" data-toggle="collapse"
                                               href="#answer-{{$serial+1}}" data-parent="#accordion2">
                                                {{$faq->question}}
                                            </a>
                                        </div>
                                        <div class="panel-collapse collapse @if($serial == 0) show @endif" id="answer-{{$serial+1}}" aria-labelledby="question-1"
                                             role="tabpanel">
                                            <div class="panel-body">
                                                {{$faq->answer}}
                                            </div>
                                        </div>
                                    </div>
                                        @empty
                                            <div class="panel">
                                                <div class="panel-heading" id="question" role="tab">
                                                    <a class="panel-title" aria-controls="answer" aria-expanded="true" data-toggle="collapse"
                                                       href="#answer" data-parent="#accordion2">
                                                        Not available
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse show" id="answer" aria-labelledby="question-1"
                                                     role="tabpanel">
                                                    <div class="panel-body">
                                                        No FAQ available at the moment, please try again later.
                                                    </div>
                                                </div>
                                            </div>
                                    @endforelse
                                    <!-- End Question 1 -->
                                </div>
                            </div>
                            <!-- End Categroy 1 -->
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
