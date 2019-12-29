@csrf
<div class="row">
    @php $input = "member"; @endphp
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Team Member</label>
            <div class="col-sm-8">
                <select id="memberName" class=" col" name="{{$input}}"></select>
            </div>
            @error($input)
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>
    @php $input = "date"; @endphp
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Task date</label>
            <div class="col-sm-8">
                <input type="text" name="due_date" class="form-control datetimepicker-input" id="datetimepicker5"
                       data-toggle="datetimepicker" data-target="#datetimepicker5"/>
            </div>
            @error($input)
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>
    @php $input = "task_desc"; @endphp
    <div class="col-md-10">
        <div class="form-group bmd-form-group">
            <label class="col-form-label">Task Description</label>
            <textarea name="{{$input}}" id="" cols="30" rows="2"
                      class="form-control @error($input) is-invalid @enderror">{{ isset($row) ? $row->{$input} : '' }}</textarea>

            @error($input)
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>
    <div class="col-md-2 ">
        <button type="submit" id="addBtn" class=" align-bottom btn btn-primary pull-right">Add Task</button>

    </div>
</div>
@push('js')
    <script type="text/javascript">

        $('#memberName').select2({
            placeholder: "Choose member...",
            // minimumInputLength: 2,
            ajax: {
                url: '/users/search',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $(function () {
            var date = new Date();
            date.setDate(date.getDate() + 1);
            $('#datetimepicker5').datetimepicker({format: 'L', minDate: date});
        });
        $(document).ready(function () {
            $("#addTask").validate({
                rules: {
                    member: "required",
                    date: {
                        required: true,
                        date: true,
                    },
                    task_desc: {
                        required: true,
                        minlength: 10,
                        maxlength: 100
                    },
                },
                messages: {
                    member: "Please select team member",
                    date: {
                        required: "Please select due date",
                        date: "Your must select a valid date"
                    },
                    task_desc: {
                        required: "please enter task description",
                        minlength: "Your password must be at least 10 characters long",
                        maxlength: "Your password must be not more 100 characters long"
                    },
                },
                errorElement: "em",
                errorPlacement: function (error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.next("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function (response) {
                            $("#addTask")[0].reset();

                            $("#memberName").val('').trigger('change')

                            $('#tasks_list .card-body').prepend(
                                response.data
                            );
                            $('#tasks_list .card-body').lastChild.remove();
                        }
                    });
                }
            });

        });


    </script>
@endpush
