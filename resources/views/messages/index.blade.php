@extends('layouts.app')


@section('additional_styles')
    <style>
        .image{
            height: 50px;
            width: 50px;
        }
    </style>
@endsection
@section('content')

    <div class="container" >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" >Vase poruke sa {{$friend->first_name.' '.$friend->last_name}}</div>

                    <div class="card-body" >
                        <div class="container " id="chat"></div>
                        <div class="container" >
                            <form method="POST"  id="messageForm" action="{{route('send-message')}}">
                                @CSRF
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <input type="hidden" name="id" value="{{$friend->id}}">
                                        <input type="text" name="message" id="message" class="form-control" placeholder="Posaljite poruku">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script>
        async function messages(id = {{$friend->id}}){
            let response = await fetch('{{route('show-messages', [$friend->id])}}');
            let responseJSON = await response.json();
            let chatDiv = document.getElementById('chat');
            let chat = '';
            responseJSON.forEach((message) => {
                if(message.user_id_received_message === {{auth()->user()->id}}){
                    chat += `<div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-1">
                                            <img src="{{asset('no-photo.jpg')}}"class="image rounded-circle float-start" alt="">
                                        </div>
                                        <div class="col-11">
                                            <p class=" bg-danger rounded-5 px-3 py-1 float-start mt-2">${message.message}</p>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                }else{
                    chat += `<div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-11">
                                            <p class="float-end bg-info rounded-5 px-3 py-1 mt-2">${message.message}</p>
                                        </div>
                                        <div class="col-1">
                                            <img src="{{asset('no-photo.jpg')}}"class="image rounded-circle float-end" alt="">
                                        </div>
                                    </div>
                            </div>
                        </div>`;
                }
            });

            if(chat === ''){
                chat = `<div class="row">
                            <div class="col-12">
                                <p class="text-warning text-center">Jos uvijek nemate poruka sa ovim prijateljom</p>
                            </div>
                        </div>`
            }
            chatDiv.innerHTML = chat;
            setTimeout(messages, 2000);
        }

        messages()
    </script>


@endsection


