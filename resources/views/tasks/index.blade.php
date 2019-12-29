@extends('layouts.app')
@push('css')
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="w-100">
                @role('admin')
                <div class="card w-100">
                    <div class="card-header">Assign new task</div>

                    <div class="card-body">
                        <form id="addTask" action="{{route('task.store')}}" method="POST">
                            @include('tasks.form')
                            <div class="clearfix"></div>
                        </form>

                    </div>
                </div>
                @endrole
                <div id="tasks_list" class="my-3  bg-white rounded shadow-sm overflow-scroll card w-100">
                    <div class="card-header ">
                        <h4 class="border-bottom border-gray pb-2 mb-0">Recent Tasks</h4></div>
                    <div class="card-body ">
                        @component('tasks.tasksList',['tasks'=>$tasks])
                        @endcomponent
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        let csrf = '{{csrf_token()}}';

        function markDone(element, taskId) {

            $.ajax({
                url: 'complete/' + taskId,
                type: "post",
                data: taskId,
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    //$("#preview").fadeOut();

                },
                success: function (data) {
                    console.log(data);
                    $(element).parent().html('<span class="text-success font-weight-bold">Done </span>');
                },
                error: function (e) {
                }
            });
        }

        var pageNumber = 2;
        let ajaxredy = true;
        $('#tasks_list .card-body').scroll(function () {
            console.log("1 " + ajaxredy);
            if (ajaxredy == false) return;
            console.log($('#tasks_list .card-body').scrollTop());
            console.log($('#tasks_list .media').height());
            // if ($('#tasks_list .card-body').scrollTop() >= ( 600 * (pageNumber - 1)) ) {
            // if ($('#tasks_list .card-body').scrollTop() + $('#tasks_list .media').height() + 550 == $(document).height() ) {
            if ($('#tasks_list .card-body').scrollTop() >= ($('#tasks_list .media').height() * 10 * (pageNumber - 1)) - 220) {
                ajaxredy = false;
                console.log("2 " + ajaxredy);

                $.ajax({
                    type: 'GET',
                    url: "?page=" + pageNumber,
                    success: function (data) {
                        pageNumber += 1;
                        if (data.html.length == 0) {
                            $('#tasks_list .card-body').append("<span class='text-danger font-weight-bold'>No More Tasks</span>");
                            console.log("3 " + ajaxredy);

                        } else {
                            console.log(data);
                            $('#tasks_list .card-body').append(data.html);
                            console.log("1 " + ajaxredy);

                        }
                        ajaxredy = true;
                        console.log("5 " + ajaxredy);

                    }, error: function (data) {

                    },
                })
            }
        });

    </script>
@endpush
