@extends('partials.layout')

@section('title', 'Thank You')

@section('extra-css')

@endsection

@section('body-class', 'sticky-footer')

@section('content')

   <div class="thank-you-section">
   		
      @if(session()->has('success'))
            <div class="alert alert-success" style="color: green">
                {{session()->get('success')}}
                
            </div>
            @endif

            @if(count($errors)>0)
            <div class="alerta alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>a{{$error}}</li>
                    @endforeach
                </ul>
            </div>

            @endif
       <h1>Thank you for <br> Your Order!</h1>
       <p>A confirmation email was sent</p>
       <div class="spacer"></div>
       <div>
           <a href="{{ route("home.index") }}" class="button">Home Page</a>
       </div>
   </div>




@endsection
