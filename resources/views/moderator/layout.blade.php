<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ strip_tags($__env->yieldContent('title')) }} · Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/comments/css/admin.css">
</head>
<body>
    @include('comments::moderator.partials.navbar')

    <div class="container">
        <div id="admin" class="col-md-11 col-md-offset-1">
            <h3 class="page-header">
                @yield('title')
            </h3>

            @yield('content')
        </div>
    </div>

    <script type="text/x-template" id="alert-template">@include('comments::templates/alert')</script>
    <script>
        var adminConfig = {
            csrfToken: "{{ csrf_token() }}",
            routes: {
                index: "{{ route('moderator.boards.comments.index', request()->boards) }}",
                update: "{{ route('moderator.boards.comments.update', [request()->boards, ':id']) }}",
                destroy: "{{ route('moderator.boards.comments.destroy', [request()->boards, ':id']) }}"
            }
        };
    </script>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="/vendor/comments/js/admin.js"></script>
    <script src="/vendor/js/bootbox.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>
