@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mb-3 mt-3">
        <a href="{{ route('welcome') }}" class="btn btn-outline-primary px-4 py-2 fw-bold shadow-sm">
            🏠 HOME
        </a>
    </div>

    <h1 class="text-center text-secondary fw-bold mb-4">📋 Tariffs</h1>

    <div class="text-center mb-3">
        <a href="{{ route('tariffs.create') }}" class="btn btn-success fw-bold px-4 py-2 shadow-sm">
            ➕ Create New Tariff
        </a>
    </div>

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

    <ul class="list-group shadow-lg w-75 mx-auto">
        @foreach ($tariffs as $tariff)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('tariffs.show', $tariff) }}" class="text-decoration-none fw-bold text-primary">
                    {{ $tariff->ration_name }}
                </a>

                <div class="d-flex">
                    <a href="{{ route('tariffs.edit', $tariff) }}" class="btn btn-warning btn-sm mx-1">
                        ✏ Edit
                    </a>

                    <form action="{{ route('tariffs.destroy', $tariff) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            ❌ Delete
                        </button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
