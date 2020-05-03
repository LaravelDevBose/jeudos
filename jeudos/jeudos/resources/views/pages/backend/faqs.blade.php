@extends('layouts.backend')

@section('title') FAQs @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">FAQs</h3>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="media bg-white mb-10 shadow pull-up">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-bolt"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>All</strong></h4>
                            <h3>{{number_format($faqs->count())}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="media bg-white mb-10 shadow pull-up text-info">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-warning"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>Active</strong></h4>
                            <h3>{{number_format($faqs->where('status',1)->count())}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="media bg-white mb-10 shadow pull-up text-success">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-check"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>Disabled</strong></h4>
                            <h3>{{number_format($faqs->where('status',0)->count())}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="box shadow">
                <h5 class="box-header">Faqs   <button class="btn btn-primary float-right" data-toggle="modal" data-target="#create">Create</button></h5>
                <div class="modal center-modal fade" id="create" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger">Create FAQ</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{url('admin/faqs/update')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Question</label>
                                        <textarea class="form-control" name="question"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Answer</label>
                                        <textarea class="form-control" name="answer"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer modal-footer-uniform">
                                    <button type="button" class="btn btn-rounded btn-secondary"
                                            data-dismiss="modal">Cancel
                                    </button>
                                    <button type="submit" class="btn btn-rounded btn-success float-right">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($faqs as $serial => $faq)
                            <tr>
                                <td>{{$serial + 1}}</td>
                                <td>{{$faq->question}}</td>
                                <td>{{$faq->answer}}</td>
                                <td>
                                   @if($faq->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @elseif($faq->status == 0)
                                        <span class="badge badge-danger">Disabled</span>
                                    @endif
                                </td>
                                <td>
                                    @if($faq->status == 1)
                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#disable{{$faq->id}}">Disable
                                        </button>
                                        <div class="modal center-modal fade" id="disable{{$faq->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger">Disable FAQ</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to disable this FAQ ?</p>
                                                    </div>
                                                    <div class="modal-footer modal-footer-uniform">
                                                        <button type="button" class="btn btn-rounded btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <a href="{{url('admin/faqs/disable/'.encrypt($faq->id))}}"
                                                           class="btn btn-rounded btn-success float-right">Yes, disable</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($faq->status == 0)
                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#enable{{$faq->id}}">Enable
                                        </button>
                                        <div class="modal center-modal fade" id="enable{{$faq->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-success">Enable FAQ</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to enable this FAQ ?</p>
                                                    </div>
                                                    <div class="modal-footer modal-footer-uniform">
                                                        <button type="button" class="btn btn-rounded btn-secondary"
                                                                data-dismiss="modal">No, cancel
                                                        </button>
                                                        <a href="{{url('admin/faqs/enable/'.encrypt($faq->id))}}"
                                                           class="btn btn-rounded btn-success float-right">Enable</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{$faq->id}}">Edit
                                    </button>
                                    <div class="modal center-modal fade" id="edit{{$faq->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger">Edit FAQ</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('admin/faqs/update')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$faq->id}}"/>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Question</label>
                                                            <textarea class="form-control" name="question">{{$faq->question}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Answer</label>
                                                            <textarea class="form-control" name="answer">{{$faq->answer}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer modal-footer-uniform">
                                                        <button type="button" class="btn btn-rounded btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <button type="submit" class="btn btn-rounded btn-success float-right">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


