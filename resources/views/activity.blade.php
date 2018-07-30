@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">BackLog Activity</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @markdown
                    @include('report-template', compact('projectList'))
                    @endmarkdown

                </div>
                <div class="card-footer">
                    <form method="post">
                        <button type="submit" class="btn btn-primary float-right">
                            Submit to DAILYREPORT
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
