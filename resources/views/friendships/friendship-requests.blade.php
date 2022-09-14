@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista zahtjeva za prijateljstvo</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 offset-2">
                                @if(count($friendship_requests) > 0)
                                    @foreach($friendship_requests as $fr)
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                {{$fr->first_name.' '.$fr->last_name}}

                                                <a class="btn btn-sm btn-outline-danger float-end ms-4" href="{{route('ignore-friendship-request', [$fr->id])}}">Odbiji zahtjev</a>
                                                <a class="btn btn-sm btn-outline-success float-end ms-4" href="{{route('accept-friendship-request', [$fr->id])}}">Prihvati zahtjev</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-primary text-lg-center ">Trenutno nemate zahtjeva za prijateljstvo</p>
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
