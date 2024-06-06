@php use Modules\Ticket\App\Enum\TicketPriority;use Modules\Ticket\App\Enum\TicketStatus; @endphp
@extends('ticket::layouts.master')
@section('content')
    <div id="newIssue" tabindex="-1" role="dialog" aria-labelledby="newIssue"
         aria-hidden="true">
        <div class="modal-wrapper">
            @include('ticket::partials.messages')
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                        <h4 class="modal-title"><i class="fa fa-pencil"></i> Create New Issue</h4>
                    </div>
                    <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <input name="title" type="text" class="form-control" placeholder="عنوان">
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="priority">
                                    <option value="">الویت</option>
                                    @foreach(TicketPriority::cases() as $status)
                                        <option value="{{ $status->name }}">{{ $status->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="department_id">
                                    <option selected>دپارتمان</option>
                                    @foreach($departments as $department)
                                        <option name="department_id"
                                                value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <textarea name="content" class="form-control" style="height: 120px;"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="attachment">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                    class="fa fa-times"></i> Discard
                            </button>
                            <button type="submit" class="btn btn-primary pull-right"><i
                                    class="fa fa-pencil"></i> Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
