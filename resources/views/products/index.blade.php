@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('cart.index', ['locale' => app()->getLocale()]) }}" class="btn btn-warning">{{ __('Shopping cart') }}</a>
        <p>{{ __('Quantity of items in the shopping cart') }}: {{ $cart }}</p>
        @foreach ($products as $product)
            <div>
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <p>${{ $product->price }}</p>
                
                @if ($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" width="60">
                @else
                    <p>{{ __('No image') }}</p>
                @endif

                <form action="{{route('cart.add', ['locale' => app()->getLocale(), 'product' => $product]) }}" method="POST">
                    @csrf
                    <label for="quantity">{{ __('Quantity') }}:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="100">
                    <button type="submit">{{ __('Add to cart') }}</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
