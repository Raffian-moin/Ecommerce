@extends('partials.layout')

@section('title', 'Shopping Cart')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="#">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shopping Cart</span>
        </div>
    </div> <!-- end breadcrumbs -->


    <div class="cart-section container">
        <div>
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

            @if(Cart::count()>0)

            <h2>{{Cart::count()}} item(s) in Shopping Cart</h2>

            @foreach(Cart::content() as $item)
            <div class="cart-table">
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{ route('shop.show',$item->model->slug) }}"><img src="/img/macbook-pro.png" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{ route('shop.show',$item->model->slug) }}">{{$item->model->name}}</a></div>
                            <div class="cart-table-description">{{$item->model->details}}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                            <form action="{{ route('cart.delete',$item->rowId) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="cart-options">Remove</button>
                            </form>
                            <form action="{{ route('cart.saveForLater',$item->rowId) }}" method="POST">
                                @csrf
                                <button type="submit" class="cart-options">Save for later</button>
                            </form>
                        </div>
                        <div>
                            <select class="quantity">
                                <option selected="">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div>{{$item->model->PresentPrice()}}</div>
                    </div>
                </div> <!-- end cart-table-row -->

            </div> <!-- end cart-table -->
            @endforeach

            <a href="#" class="have-code">Have a Code?</a>

            <div class="have-code-container">
                <form action="#">
                    <input type="text">
                    <button type="submit" class="button button-plain">Apply</button>
                </form>
            </div> <!-- end have-code-container -->

            <div class="cart-totals">
                <div class="cart-totals-left">
                    Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                </div>

                <div class="cart-totals-right">
                    <div>
                        Subtotal <br>
                        Tax <br>
                        <span class="cart-totals-total">Total</span>
                    </div>
                    <div class="cart-totals-subtotal">
                        {{PresentPrice(Cart::subtotal()) }}<br>
                        {{PresentPrice(Cart::tax()) }} <br>
                        <span class="cart-totals-total">{{PresentPrice(Cart::total()) }}</span>
                    </div>
                </div>
            </div> <!-- end cart-totals -->

            <div class="cart-buttons">
                <a href="#" class="button">Continue Shopping</a>
                <a href="#" class="button-primary">Proceed to Checkout</a>
            </div>

            @else

            <h1>No item in Cart</h1>

            @endif

             @if(Cart::instance('saveForLater')->count()>0)

            <h2>{{Cart::instance('saveForLater')->count()}} item(s) saved for later</h2>

            @foreach(Cart::instance('saveForLater')->content() as $item)
            <div class="saved-for-later cart-table">
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{ route('shop.show',$item->model->slug) }}"><img src="/img/macbook-pro.png" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{ route('shop.show',$item->model->slug) }}">{{$item->model->name}}</a></div>
                            <div class="cart-table-description">{{$item->model->details}}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                            
                           <form action="{{ route('saveForLater.delete',$item->rowId) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="cart-options">Remove</button>
                            </form>
                            <form action="{{ route('saveForLater.switchToCart',$item->rowId) }}" method="POST">
                                @csrf
                                <button type="submit" class="cart-options">move to Cart</button>
                            </form>
                        </div>
                        {{-- <div>
                            <select class="quantity">
                                <option selected="">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div> --}}
                        <div> {{$item->model->PresentPrice()}} </div>
                    </div>
                </div> <!-- end cart-table-row -->


            </div> <!-- end saved-for-later -->
            @endforeach

            @else
            <h1>No items saved for later</h1>
            @endif

        </div>

    </div> <!-- end cart-section -->

    @include('partials.might-like')


@endsection
