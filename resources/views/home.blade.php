@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><a href="{{ url('/home') }}">Profile Dashboard</a></h4>

                    <button class="btn btn-info" data-toggle="collapse" data-target="#customers">Customers</button>
                    <div id="customers" class="">
                        @foreach(Auth::user()->customers as $customer)
                            <a  role="button"
                                href="{{ Request::url() }}?customer={{ $customer->id }}"
                                class="btn btn-outline-info btn-sm {{ Request::input('customer') == $customer->id ? 'active' : ''}}"
                            >{{ $customer->name }}</a>
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
