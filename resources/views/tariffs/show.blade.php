@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mb-3">
        <a href="{{ route('tariffs.index') }}" class="btn btn-outline-primary px-4 py-2 fw-bold shadow-sm">
            🔙 Back to Tariffs
        </a>
    </div>

    <h1 class="text-center text-secondary fw-bold mb-4">📌 Tariff Details</h1>

    <div class="card shadow-lg p-4 rounded w-50 mx-auto">
        <div class="card-body">
            <h3 class="text-primary fw-bold text-center">🥗 {{ $tariff->ration_name }}</h3>

            <p class="fs-5 text-center">
                <strong>🍽 Cooking Day Before:</strong>
                <span class="{{ $tariff->cooking_day_before ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                    {{ $tariff->cooking_day_before ? '✅ Yes' : '❌ No' }}
                </span>
            </p>

            <div class="d-flex justify-content-center gap-3 mt-4">

                <a href="{{ route('tariffs.edit', $tariff) }}" class="btn btn-warning fw-bold px-4 py-2 shadow-sm">
                    ✏️ Edit
                </a>


                <form action="{{ route('tariffs.destroy', $tariff) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tariff?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger fw-bold px-4 py-2 shadow-sm">
                        ❌ Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
