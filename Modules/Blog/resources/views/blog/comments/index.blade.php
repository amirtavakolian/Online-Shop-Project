@extends('panel::layouts.master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">لیست کامنت ها</h5>
            </div>
            <div>
                <table class="table table-bordered table-striped text-center" id="commentsList">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>پست</th>
                        <th>کاربر</th>
                        <th>متن کامنت</th>
                        <th>وضعیت</th>
                        <th>کامنت والد</th>
                        <th>تعداد لایک</th>
                        <th>تعداد دیسلایک</th>
                        <th>کامنت ربات</th>
                        <th>تغییر وضعیت</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <th>
                                {{ $loop->index+1 }}
                            </th>
                            <th>
                                {{ $comment->post->title }}
                            </th>
                            <th>
                                {{ $comment->user->name }}
                            </th>
                            <th>
                                {{ $comment->content }}
                            </th>
                            <th>
                                {{ $comment->commentStatus }}
                            </th>
                            <th>
                                {{ $comment->parent_id ? 'خیر':'بله' }}
                            </th>
                            <th>
                                {{ $comment->like }}
                            </th>
                            <th>
                                {{ $comment->dislike }}
                            </th>
                            <th>
                                {{ $comment->is_robot_generated ? 'بله':'خیر' }}
                            </th>
                            <th>
                                <select class="form-control" data-comment-status-id="{{ $comment->id }}">
                                    <option {{ $comment->status == 1 ? "selected" : "" }} value="1">تایید</option>
                                    <option {{ $comment->status == 0 ? "selected" : "" }} value="0">در انتظار تایید
                                    </option>
                                    <option {{ $comment->status == 2 ? "selected" : "" }} value="2">رد</option>
                                </select>
                            </th>
                            <th>
                                <a class="btn btn-sm btn-danger" href="#" data-category-id="{{ $comment->id }}">حذف</a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $comments->links() }}
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        const commentsList = document.querySelector('#commentsList');
        commentsList.addEventListener('change', function (e) {
            if (e.target.hasAttribute('data-comment-status-id')) {
                if (confirm('آیا مطمئن هستید؟')) {
                    let route = `{{ route('blog.comments.status.change', ['status' => ':status', 'comment' => ':comment']) }}`
                    route = route.replace(':status', e.target.value);
                    route = route.replace(':comment', e.target.getAttribute('data-comment-status-id'));

                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', route);
                    const token = document.querySelector('meta[name="csrf-token"]').content;
                    xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    xhr.send();

                    xhr.addEventListener('load', function (e) {
                        if (xhr.status == 200) {
                            window.location.reload();
                        }
                    });
                }
            }
        });
    </script>
@endsection
