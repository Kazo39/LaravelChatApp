@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista poslatih zahtjeva za prijateljstvo</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 offset-2">
                                @if(count($friendship_requests_sent) > 0)
                                    @foreach($friendship_requests_sent as $fr)
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                {{$fr->first_name.' '.$fr->last_name}}

                                                <a class="btn btn-sm btn-outline-danger float-end " href="{{route('remove-friendship-request', [$fr->id])}}">Ukloni zahtjev</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-primary text-lg-center ">Trenutno nemate poslatih zahtjeva za prijateljstvo</p>
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
