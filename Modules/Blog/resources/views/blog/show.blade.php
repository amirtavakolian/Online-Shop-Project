@php use Carbon\Carbon; @endphp
@extends('blog::layouts.master')

@section('head')
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            line-height: 1.4;
            color: rgba(0, 0, 0, 0.85);
            background-color: #f9f9f9;

        }

        button {
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
            font-size: 14px;
            padding: 4px 8px;
            color: rgba(0, 0, 0, 0.85);
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        button:hover,
        button:focus,
        button:active {
            cursor: pointer;
            background-color: #ecf0f1;
        }

        .comment-thread {
            width: 700px;
            max-width: 100%;
            margin: auto;
            padding: 0 30px;
            background-color: #fff;
            border: 1px solid transparent; /* Removes margin collapse */
        }

        .m-0 {
            margin: 0;
        }

        .sr-only {
            position: absolute;
            left: -10000px;
            top: auto;
            width: 1px;
            height: 1px;
            overflow: hidden;
        }

        /* Comment */

        .comment {
            position: relative;
            margin: 20px auto;
        }

        .comment-heading {
            display: flex;
            align-items: center;
            height: 50px;
            font-size: 14px;
        }

        .comment-voting {
            width: 20px;
            height: 32px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        .comment-voting button {
            display: block;
            width: 100%;
            height: 50%;
            padding: 0;
            border: 0;
            font-size: 10px;
        }

        .comment-info {
            color: rgba(0, 0, 0, 0.5);
            margin-left: 10px;
        }

        .comment-author {
            color: rgba(0, 0, 0, 0.85);
            font-weight: bold;
            text-decoration: none;
        }

        .comment-author:hover {
            text-decoration: underline;
        }

        .replies {
            margin-left: 20px;
        }

        /* Adjustments for the comment border links */

        .comment-border-link {
            display: block;
            position: absolute;
            top: 50px;
            left: 0;
            width: 12px;
            height: calc(100% - 50px);
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            background-color: rgba(0, 0, 0, 0.1);
            background-clip: padding-box;
        }

        .comment-border-link:hover {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .comment-body {
            padding: 0 20px;
            padding-left: 28px;
        }

        .replies {
            margin-left: 28px;
        }

        /* Adjustments for toggleable comments */

        details.comment summary {
            position: relative;
            list-style: none;
            cursor: pointer;
        }

        details.comment summary::-webkit-details-marker {
            display: none;
        }

        details.comment:not([open]) .comment-heading {
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        }

        .comment-heading::after {
            display: inline-block;
            position: absolute;
            right: 5px;
            align-self: center;
            font-size: 12px;
            color: rgba(0, 0, 0, 0.55);
        }

        details.comment[open] .comment-heading::after {
            content: "مخفی کردن کامنت";
            margin-right: 3%;
            margin-bottom: 2%;
            color: red;
            font-weight: 600;
        }

        details.comment:not([open]) .comment-heading::after {
            content: "نمایش کامنت";
            margin-right: 3%;
            margin-bottom: 2%;
            color: red;
            font-weight: 600;
        }

        /* Adjustment for Internet Explorer */

        @media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
            /* Resets cursor, and removes prompt text on Internet Explorer */
            .comment-heading {
                cursor: default;
            }

            details.comment[open] .comment-heading::after,
            details.comment:not([open]) .comment-heading::after {
                content: " ";
            }
        }

        /* Styling the reply to comment form */

        .reply-form textarea {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 16px;
            width: 100%;
            max-width: 100%;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .d-none {
            display: none;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="single_post">
        <div class="container-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="post_img">
                            <img src="{{ asset('storage/'.$post->image_url) }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="posts_meta text-center">
                    <span><i class="fa fa-comment-o"></i> 25 نظر</span>
                    <span><i class="fa fa-archive"></i> {{ $post->category->name }}</span>
                    <span><i class="fa fa-calendar"></i> {{ $post->created_at }}</span>
                </div>
                <div class="post_content">
                    <h4>{{ $post->title }}</h4>
                    <p>
                        {!!  $post->content !!}
                    </p>
                </div>
                @if($post->disable_comment == 1)
                    <div class="alert alert-danger">
                        <p>ثبت کامنت غیر فعال است</p>
                    </div>
                @else
                    <div class="comments_form" id="comments_form">
                        <h3>دیدگاه ها </h3>
                        @foreach($post->approvedParentComments() as $comment)
                            <div class="comment-thread">

                                <!-- Comment 1 start -->
                                <details open class="comment" id="comment-{{ $comment->id }}">
                                    <a href="#comment-{{ $comment->id }}" class="comment-border-link">
                                        <span class="sr-only">Jump to comment-1</span>
                                    </a>
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    <summary>
                                        <div class="comment-heading">
                                            <div class="comment-voting">
                                                <button type="button">
                                                    <span aria-hidden="true">&#9650;</span>
                                                    <span class="sr-only" data-comment-id-like="{{ $comment->id }}">
                                                        Vote up
                                                    </span>
                                                </button>
                                                <button type="button">
                                                    <span aria-hidden="true">&#9660;</span>
                                                    <span class="sr-only" data-comment-id-disslike="{{ $comment->id }}">
                                                        Vote down
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="comment-info">
                                                <a href="#" class="comment-author">{{ $comment->user->name }}</a>
                                                <p class="m-0">
                                                    لایک: {{ $comment->like }} | دیسلایک: {{ $comment->dislike }}
                                                    &bull; {{ Carbon::parse($comment->created_at)->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </summary>

                                    <div class="comment-body">
                                        <p>
                                            {{ $comment->content }}
                                        </p>
                                        <!-- Reply form end -->
                                    </div>
                                    <!-- replies here: -->
                                    <div class="replies">
                                        @foreach($comment->replies as $reply)
                                            @if($reply->approvedComments())
                                                <details open class="comment" id="comment-{{ $reply->id }}">
                                                    <a href="#comment-{{ $reply->id }}" class="comment-border-link">
                                                        <span class="sr-only">Jump to comment-2</span>
                                                    </a>
                                                    <summary>
                                                        <div class="comment-heading">
                                                            <div class="comment-voting">
                                                                <button type="button">
                                                                    <span aria-hidden="true">&#9650;</span>
                                                                    <span class="sr-only"
                                                                          data-comment-id-like="{{ $reply->id }}">
                                                                        Vote up
                                                                    </span>
                                                                </button>
                                                                <button type="button">
                                                                    <span aria-hidden="true">&#9660;</span>
                                                                    <span class="sr-only"
                                                                          data-comment-id-disslike="{{ $reply->id }}">
                                                                        Vote down
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <div class="comment-info">
                                                                <a href="#"
                                                                   class="comment-author">{{ $reply->user->name }}</a>
                                                                <p class="m-0">
                                                                    لایک: {{ $reply->like }} | دیسلایک: {{ $reply->dislike }}
                                                                    &bull; {{ Carbon::parse($reply->created_at)->diffForHumans() }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </summary>

                                                    <div class="comment-body">
                                                        <p>
                                                            {{ $reply->content }}
                                                        </p>

                                                    </div>
                                                </details>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="reply">
                                        <button type="button" data-toggle="reply-form"
                                                data-target="comment-{{ $comment->id }}-reply-form">
                                            پاسخ
                                        </button>
                                        <button type="button">گزارش تخلف</button>

                                        <!-- Reply form start -->
                                        <form action="#" class="reply-form d-none"
                                              id="comment-{{ $comment->id }}-reply-form">
                                            <textarea placeholder="Reply to comment" rows="4"></textarea>
                                            <button type="submit" data-parent-comment-id="{{ $comment->id }}">ثبت
                                            </button>
                                            <button type="button" data-toggle="reply-form"
                                                    data-target="comment-{{ $comment->id }}-reply-form">
                                                کنسل
                                            </button>
                                        </form>
                                    </div>
                                    <hr style="border: 2px solid aqua">
                                </details>
                                <!-- Comment 1 end -->

                            </div>

                        @endforeach
                    </div>
                    <div class="comments_form">
                        <h5>دیدگاه شما </h5>
                        @include('blog::partials.messages')
                        @guest()
                            <div class="alert alert-danger">
                                <p>جهت ثبت کامنت لطفا <a href="{{ route('login.index') }}">وارد شوید</a></p>
                            </div>
                        @else
                            <form method="POST" action="{{ route('blog.post.comment.store', ['post' => $post]) }}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" value="{{ auth()->user()->name }}" class="form-control"
                                               placeholder="نام شما">
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="content" class="form-control"
                                                  placeholder="نظر شما ..."></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="text-left">
                                            <button class="btn btn-primary">ثبت نظر</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endguest
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener(
            "click",
            function (event) {
                var target = event.target;
                var replyForm;
                if (target.matches("[data-toggle='reply-form']")) {
                    replyForm = document.getElementById(target.getAttribute("data-target"));
                    replyForm.classList.toggle("d-none");
                }
            },
            false
        );

        const reply = document.querySelector(".comments_form");
        reply.addEventListener('click', function (e) {
            if (e.target.getAttribute('type') == 'submit') {
                e.preventDefault();

                const token = document.querySelector('meta[name="csrf-token"]').content;
                let route = `{{ route('blog.post.comment.reply.store', ['post' => $post->id, 'postComment'=> ':postComment']) }}`;
                route = route.replace(':comment', e.target.parentNode.parentNode.parentNode.children[1].value)
                route = route.replace(':postComment', e.target.attributes[1].value)

                const replyData = new FormData();
                replyData.append('content', e.target.parentNode[0].value)

                const xhrStoreReply = new XMLHttpRequest();
                xhrStoreReply.open('POST', route);
                xhrStoreReply.setRequestHeader('X-CSRF-TOKEN', token);
                xhrStoreReply.send(replyData)

                xhrStoreReply.addEventListener('load', function (response) {
                    if (xhrStoreReply.status == 200) {
                        alert('کامنت شما پس از تایید مدیر نشان داده خواهد شد');
                        e.target.parentNode[0].value = "";
                    }
                })
            }
        });

        const commentsForm = document.querySelector("#comments_form");
        commentsForm.addEventListener('click', function (e) {
            if (e.target.nextElementSibling.hasAttribute('data-comment-id-like')) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                let route = `{{ route('blog.post.comment.like', ['postComment' => ':postComment']) }}`
                route = route.replace(':postComment', e.target.nextElementSibling.attributes[1].value)
                fetch(route, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                }).then((response) => {
                    console.log(response);
                });
            }
            if (e.target.nextElementSibling.hasAttribute('data-comment-id-disslike')) {
                let route = `{{ route('blog.post.comment.disslike', ['postComment' => ':postComment']) }}`
                route = route.replace(':postComment', e.target.nextElementSibling.attributes[1].value)
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                fetch(route, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                }).then((response) => {
                    console.log(response);
                });
            }
        })
    </script>
@endsection
