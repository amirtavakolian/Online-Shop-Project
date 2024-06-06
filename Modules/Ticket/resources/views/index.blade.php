@extends('ticket::layouts.master')

@section('content')
    <body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="grid support">
                        <div class="grid-body">
                            <h2>Browse</h2>
                            <hr>
                            <ul>
                                <li class="active"><a href="#">Everyone's Issues<span class="pull-right">142</span></a></li>
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
                                <li><a href="#"><span class="bg-light-blue">&nbsp;</span>&nbsp;&nbsp;&nbsp;javascript<span
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
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> Sort:
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

                                <div class="col-md-12">
                                    <ul class="list-group fa-padding">
                                        <li class="list-group-item" data-toggle="modal" data-target="#issue">
                                            <div class="media">
                                                <i class="fa fa-cog pull-left"></i>
                                                <div class="media-body">
                                                    <strong>Add drag and drop config import closes</strong> <span
                                                        class="label label-danger">IMPORTANT</span><span
                                                        class="number pull-right"># 13698</span>
                                                    <p class="info">Opened by <a href="#">jwilliams</a> 5 hours ago <i
                                                            class="fa fa-comments"></i> <a href="#">2 comments</a></p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="modal fade" id="issue" tabindex="-1" role="dialog" aria-labelledby="issue"
                                         aria-hidden="true">
                                        <div class="modal-wrapper">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-blue">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×
                                                        </button>
                                                        <h4 class="modal-title"><i class="fa fa-cog"></i> Add drag and drop
                                                            config import closes</h4>
                                                    </div>
                                                    <form action="#" method="post">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <img src="assets/img/user/avatar01.png"
                                                                         class="img-circle" alt width="50">
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <p>Issue <strong>#13698</strong> opened by <a href="#">jqilliams</a>
                                                                        5 hours ago</p>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                        elit, sed do eiusmod tempor incididunt ut labore et
                                                                        dolore magna aliqua. Ut enim ad minim veniam, quis
                                                                        nostrud exercitation ullamco laboris nisi ut aliquip
                                                                        ex ea commodo consequat.</p>
                                                                    <p>Duis aute irure dolor in reprehenderit in voluptate
                                                                        velit esse cillum dolore eu fugiat nulla pariatur.
                                                                        Excepteur sint occaecat cupidatat non proident, sunt
                                                                        in culpa qui officia deserunt mollit anim id est
                                                                        laborum.</p>
                                                                </div>
                                                            </div>
                                                            <div class="row support-content-comment">
                                                                <div class="col-md-2">
                                                                    <img src="assets/img/user/avatar02.png"
                                                                         class="img-circle" alt width="50">
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <p>Posted by <a href="#">ehernandez</a> on 16/06/2014 at
                                                                        14:12</p>
                                                                    <p>Duis aute irure dolor in reprehenderit in voluptate
                                                                        velit esse cillum dolore eu fugiat nulla pariatur.
                                                                        Excepteur sint occaecat cupidatat non proident, sunt
                                                                        in culpa qui officia deserunt mollit anim id est
                                                                        laborum.</p>
                                                                    <a href="#"><span class="fa fa-reply"></span> &nbsp;Post
                                                                        a reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal"><i class="fa fa-times"></i> Close
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

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
