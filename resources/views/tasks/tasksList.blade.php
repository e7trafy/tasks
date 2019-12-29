@foreach($tasks as $task)
    @component('tasks.singleTask',['task'=>$task])
    @endcomponent
@endforeach
