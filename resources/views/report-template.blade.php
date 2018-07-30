######[Date {{ \Carbon\Carbon::today()->format('d/m/Y') }}]
######Name: **{{ Auth::user()->name }}**
######Team: **{{ Auth::user()->team }}**

-------------

@foreach($projectList as $pName => $projects)
######{{$pName}}:
@foreach($projects as $p)
- {{$p['task']}} : {{$p['actualHours']}}H
@endforeach
@endforeach