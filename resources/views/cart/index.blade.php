@extends('layouts.app')

@section('content')
    <div class="container">
    <a href="{{ route('products.index', ['locale' => app()->getLocale()]) }}" class="btn btn-warning">{{ __('Products') }}</a>
    @foreach ($cartItems as $item)
        <div>
            <h3>{{ $item->product->name }}</h3>
            <p>{{ __('Quantity') }}: {{ $item->quantity }}</p>
            <p>{{ __('Price') }}: ${{ $item->product->price }}</p>
            <p>{{ __('Total') }}: ${{ $item->price }}</p>
            <form action="{{ route('cart.update', ['cart' => $item, 'locale' => app()->getLocale()]) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                <button type="submit">{{ __('Update') }}</button>
            </form>
            <form action="{{ route('cart.remove', ['locale' => app()->getLocale(), 'cart' => $item]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">{{ __('Remove') }}</button>
            </form>
        </div>
    @endforeach
    <p class="fs-4 fw-bolder mt-4">{{__('Total price') }}: ${{ $totalPrice }}</p>
</div>
@endsection