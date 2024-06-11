@extends('ticket::layouts.master')

@section('content')
    <body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        @include('coworkers::partials.messages')
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="grid support">
                        <div class="grid-body">
                            <h2>Browse</h2>
                            <hr>
                            <ul>
                                <li class="active"><a href="#">Everyone's Issues<span class="pull-right">142</span></a>
                                </li>
                                <li><a href="#">Created by you<span class="pull-right">52</span></a></li>
                                <li><a href="#">Mentioning you<span class="pull-right">18</span></a></li>
                            </ul>
                            <hr>
                            <p><strong>Labels</strong></p>
                            <ul class="support-label">
                                <li><a href="#"><span class="bg-blue">&nbsp;</span>&nbsp;&nbsp;&nbsp;application<span
                                            class="pull-right">2</span></a></li>
                                <li><a href="#"><span class="bg-red">&nbsp;</span>&nbsp;&nbsp;&nbsp;css<span
                                            class="pull-right">7</span></a></li>
                                <li><a href="#"><span class="bg-yellow">&nbsp;</span>&nbsp;&nbsp;&nbsp;design<span
                                            class="pull-right">128</span></a></li>
                                <li><a href="#"><span class="bg-black">&nbsp;</span>&nbsp;&nbsp;&nbsp;html<span
                                            class="pull-right">41</span></a></li>
                                <li><a href="#"><span
                                            class="bg-light-blue">&nbsp;</span>&nbsp;&nbsp;&nbsp;javascript<span
                                            class="pull-right">22</span></a></li>
                                <li><a href="#"><span class="bg-green">&nbsp;</span>&nbsp;&nbsp;&nbsp;management<span
                                            class="pull-right">87</span></a></li>
                                <li><a href="#"><span class="bg-purple">&nbsp;</span>&nbsp;&nbsp;&nbsp;mobile<span
                                            class="pull-right">92</span></a></li>
                                <li><a href="#"><span class="bg-teal">&nbsp;</span>&nbsp;&nbsp;&nbsp;php<span
                                            class="pull-right">140</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="grid support-content">
                        <div class="grid-body">
                            <h2>Issues</h2>
                            <hr>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default active">162 Open</button>
                                <button type="button" class="btn btn-default">95,721 Closed</button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    Sort:
                                    <strong>Newest</strong> <span class="caret"></span></button>
                                <ul class="dropdown-menu fa-padding" role="menu">
                                    <li><a href="#"><i class="fa fa-check"></i> Newest</a></li>
                                    <li><a href="#"><i class="fa"> </i> Oldest</a></li>
                                    <li><a href="#"><i class="fa"> </i> Recently updated</a></li>
                                    <li><a href="#"><i class="fa"> </i> Least recently updated</a></li>
                                    <li><a href="#"><i class="fa"> </i> Most commented</a></li>
                                    <li><a href="#"><i class="fa"> </i> Least commented</a></li>
                                </ul>
                            </div>

                            <a href="{{ route('tickets.create') }}" class="btn btn-success pull-right">تیک جدید</a>

                            <div class="padding"></div>
                            <div class="row">
                                @foreach($tickets as $ticket)
                                    <div class="col-md-12">
                                        <ul class="list-group fa-padding">
                                            <a href="{{ route('coworkers.tickets.show', ['ticket' => $ticket->id]) }}">
                                                <li class="list-group-item" data-toggle="modal" data-target="#issue">
                                                    <div class="media">
                                                        <i class="fa fa-cog pull-left"></i>
                                                        <div class="media-body">
                                                            <strong>{{ $ticket->title }}</strong>
                                                            <span
                                                                class="label label-{{ $ticket->ticket_status[0] }}">{{ $ticket->ticket_status[1] }}</span>
                                                            <span class="number pull-right"># {{ $ticket->id }}</span>
                                                            <p class="info">Opened by <a
                                                                    href="#">{{ $ticket->user->name }}</a>
                                                                {{ $ticket->created_at }}
                                                                <i class="fa fa-comments"></i> <a
                                                                    href="#">{{ $ticket->ticketAnswer->count() }}
                                                                    replies </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-top: 2%;">
                                                        <div class="col-lg-2">
                                                            <a href="#" class="btn btn-primary text-white"
                                                               style="color: white; font-weight: bolder;">
                                                                ارجاع به همکار
                                                            </a>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <a href="#" class="btn btn-success"
                                                               style="color: white; font-weight: bolder; margin-top: 2%;">
                                                                ارجاع به دپارتمان
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>
                                        </ul>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">

    </script>
    </body>
@endsection
