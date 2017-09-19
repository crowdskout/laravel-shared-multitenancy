@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('/home') }}" class="btn">Profile Dashboard</a>
                    @foreach(Auth::user()->customers as $customer)
                        <a href="{{ Request::url() }}?customer={{ $customer->id }}" class="btn">{{ $customer->name }}</a>
                    @endforeach
                    @foreach(\App\Source::permissioned() as $source)
                        <a href="{{ Request::url() }}?source={{ $source->id }}" class="btn">{{ $source->name }}</a>
                    @endforeach
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('subviews.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
