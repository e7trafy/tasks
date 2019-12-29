<div class="media text-muted p-2 border-bottom border-gray">
    <svg class="bd-placeholder-img mr-2 mt-3 rounded " width="32" height="32" xmlns="http://www.w3.org/2000/svg"
         preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>
            Placeholder</title>
        <rect width="100%" height="100%" fill="#007bff"></rect>
        <text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
    </svg>
    <p class="media-body col-md-9 pb-1 mb-0 small lh-125 pt-2">
        <strong class="d-block text-gray-dark">{{$task->user->name}}</strong>
        {{$task->description}}
    </p>

    <div class="col-md-3 float-left">
        <span class="d-block text-gray-dark">assign date : <strong>{{date('d-m-Y', strtotime($task->created_at))}}</strong></span>

        <span

        class="d-block text-gray-dark">due date : <strong class="text-danger">{{date('d-m-Y', strtotime($task->due_date))}}</strong></span>
        <div class="bottom right">
            @if($task->is_complete)
                <span class="text-success font-weight-bold">Done  on {{date('d-m-Y', strtotime($task->updated_at))}} </span>
            @else
                <input type="checkbox" onchange="markDone(this,{{$task->id}})">Mark As Done
            @endif
        </div>
    </div>
</div>
