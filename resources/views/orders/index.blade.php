@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="display-5 fw-bold">📋 Orders</h1>
            <a href="{{ route('orders.create') }}" class="btn btn-success">+ Create New Order</a>
        </div>

        <a href="{{ route('welcome') }}" class="btn btn-outline-primary mb-3">🏠 Home</a>

        @if (session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
            </script>
        @endif

        <div class="row">
            @forelse ($orders as $order)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('orders.show', $order) }}" class="text-decoration-none text-dark">
                                    {{ $order->client_name }}
                                </a>
                            </h5>
                            <p class="card-text text-muted">
                                📞 {{ $order->client_phone }} <br>
                                📅 Created: {{ $order->created_at->format('d M Y') }} <br>
                                🏷️ {{ $order->tariff->ration_name }}
                            </p>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-sm">View Order</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">🚀 No orders yet. <a href="{{ route('orders.create') }}">Create one now!</a></p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
