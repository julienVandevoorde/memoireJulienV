@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-container">
    <h1 class="dashboard-title text-center mb-5">Order Management</h1>

    @if($orders->isEmpty())
        <p class="text-center">No orders at the moment.</p>
    @else
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->user->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td>{{ number_format($order->total_price, 2) }} €</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="custom-button">View details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
