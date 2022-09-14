@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row mb-5">
                <div class="col-12 offset-2">
                    <a class="btn btn-outline-info float-end ms-5" href="{{route('all-friendship-requests')}}">Pogledajte primljene zahtjeve </a>
                    <a class="btn btn-outline-info float-end ms-5" href="{{route('friendship-requests-sent')}}">Pogledajte poslate zahtjeve</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Posaljite zahtjev za prijateljstvo</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-8 offset-2">
                            @if(count($not_friends) > 0)
                                @foreach($not_friends as $not_friend)
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            {{$not_friend->first_name.' '.$not_friend->last_name}}

                                            <a class="btn btn-sm btn-outline-primary float-end " href="{{ route('send-request', [$not_friend->id]) }}">Dodaj prijatelja+</a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row">
                                    <div class="col-12">
                                        <p class="text-primary text-lg-center ">Trenutno nemate predloga za prijateljstvo</p>
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
