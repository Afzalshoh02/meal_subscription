@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mb-3">
        <a href="{{ route('tariffs.index') }}" class="btn btn-outline-primary px-4 py-2 fw-bold shadow-sm">
            🔙 Back to Tariffs
        </a>
    </div>

    <h1 class="text-center text-secondary fw-bold mb-4">✏️ Edit Tariff</h1>

    <div class="w-50 mx-auto shadow-lg p-4 rounded bg-light">
        <form action="{{ route('tariffs.update', $tariff) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="mb-3">
                <label for="ration_name" class="form-label fw-bold">🥗 Ration Name:</label>
                <input type="text" name="ration_name" id="ration_name" class="form-control" required value="{{ old('ration_name', $tariff->ration_name) }}">
                @error('ration_name')
                <span class="text-danger fw-bold">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-3">
                <label for="cooking_day_before" class="form-label fw-bold">🍽 Cooking Day Before:</label>
                <select name="cooking_day_before" id="cooking_day_before" class="form-select" required>
                    <option value="1" {{ old('cooking_day_before', $tariff->cooking_day_before) == "1" ? 'selected' : '' }}>✅ Yes</option>
                    <option value="0" {{ old('cooking_day_before', $tariff->cooking_day_before) == "0" ? 'selected' : '' }}>❌ No</option>
                </select>
                @error('cooking_day_before')
                <span class="text-danger fw-bold">{{ $message }}</span>
                @enderror
            </div>


            <div class="text-center">
                <button type="submit" class="btn btn-warning fw-bold px-4 py-2 shadow-sm">
                    💾 Update Tariff
                </button>
            </div>
        </form>
    </div>
@endsection
