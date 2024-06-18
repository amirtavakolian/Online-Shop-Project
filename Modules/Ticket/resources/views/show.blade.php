@extends('ticket::layouts.master')

@section('content')
    <div class="" id="issue" tabindex="-1" role="dialog"
         aria-labelledby="issue"
         aria-hidden="true">
        <div class="modal-wrapper">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <h4 class="modal-title">
                            <i class="fa fa-cog"></i>
                            {{ $ticket->title }}
                        </h4>
                    </div>
                    <form action="{{ route('ticket.store.reply') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="assets/img/user/avatar01.png"
                                         class="img-circle" alt width="50">
                                </div>
                                <div class="col-md-10">
                                    <p>Posted by <a href="#">{{ $ticket->user->name }}</a>
                                        on {{ $ticket->created_at->diffForHumans() }}</p>
                                    <b><p>{{ $ticket->content }}</p></b>
                                    @if(!$ticket->attachments->isEmpty())
                                        <img src="{{ asset('storage/'.$ticket->attachments->first()->file_path)  }}">
                                    @endif
                                </div>
                            </div>
                            @foreach($ticket->ticketAnswer as $ticketAnswer)
                                <div class="row support-content-comment">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="assets/img/user/avatar01.png"
                                                 class="img-circle" alt width="50">
                                        </div>
                                        <div class="col-md-10">
                                            <p>Posted by <a href="#">{{ auth()->user()->name }}</a>
                                                on {{ $ticket->created_at->diffForHumans() }}</p>
                                            <b><p>{!! $ticketAnswer->content !!} </p></b>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <h4><label>پاسخ:</label></h4>
                            <textarea name="content" id="editor1" class="form-control mb-5 editor"></textarea>
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <input type="submit" class="alert-success form-control" style="margin-top: 20px" value="ثبت پاسخ">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
