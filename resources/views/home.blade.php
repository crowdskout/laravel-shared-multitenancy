@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><a href="{{ url('/home') }}">Profile Dashboard</a></h4>

                    <button class="btn btn-info" data-toggle="collapse" data-target="#customers">Customers</button>
                    <div id="customers" class="{{ Request::input('customer') ? '' : 'collapse'}}">
                        @foreach(Auth::user()->customers as $customer)
                            <a  role="button"
                                href="{{ Request::url() }}?customer={{ $customer->id }}"
                                class="btn btn-outline-info btn-sm {{ Request::input('customer') == $customer->id ? 'active' : ''}}"
                            >{{ $customer->name }}</a>
                        @endforeach
                    </div>

                    <button class="btn btn-info" data-toggle="collapse" data-target="#sources">Sources</button>
                    <div id="sources" class="{{ Request::input('source') ? '' : 'collapse'}}">
                    @foreach(\App\Source::permissioned() as $source)
                        <a  role="button"
                            href="{{ Request::url() }}?source={{ $source->id }}"
                            class="btn btn-outline-info btn-sm {{ Request::input('source') == $source->id ? 'active' : ''}}"
                        >{{ $source->name }}</a>
                    @endforeach
                    </div>
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
