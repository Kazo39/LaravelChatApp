@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista Vasih prijatelja</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 offset-2">

                                @if(count($friends) > 0)
                                    @foreach($friends as $friend)
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                {{$friend->first_name.' '.$friend->last_name}}

                                                <a class="btn btn-sm btn-outline-primary float-end " href="{{ route('open-chat', [$friend->id]) }}">Otvori konverzaciju+</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-primary text-lg-center ">Trenutno nemate ni jednog prijatelja</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
