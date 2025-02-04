@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h1 class="display-6 fw-bold text-primary">📝 Create New Order</h1>
                <hr>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="client_name" class="form-label">Client Name:</label>
                        <input type="text" name="client_name" id="client_name" class="form-control"
                               value="{{ old('client_name') }}" required>
                        @error('client_name')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="client_phone" class="form-label">Client Phone:</label>
                        <input type="text" name="client_phone" id="client_phone" class="form-control"
                               required pattern="\d{11}"
                               title="Введите 11 цифр, например 79991112233"
                               maxlength="11"
                               value="{{ old('client_phone') }}"
                               oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)">
                        @error('client_phone')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tariff_id" class="form-label fw-bold">📦 Tariff:</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-box"></i></span>
                            <select name="tariff_id" id="tariff_id" class="form-select border shadow-sm" required>
                                @foreach (\App\Models\Tariff::all() as $tariff)
                                    <option value="{{ $tariff->id }}" {{ old('tariff_id') == $tariff->id ? 'selected' : '' }}>
                                        {{ $tariff->ration_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('tariff_id')
                        <span class="text-danger fw-bold d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="schedule_type" class="form-label fw-bold">⏳ Schedule Type:</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-calendar-alt"></i></span>
                            <select name="schedule_type" id="schedule_type" class="form-select border shadow-sm" required>
                                <option value="EVERY_DAY" {{ old('schedule_type') == 'EVERY_DAY' ? 'selected' : '' }}>Every Day</option>
                                <option value="EVERY_OTHER_DAY" {{ old('schedule_type') == 'EVERY_OTHER_DAY' ? 'selected' : '' }}>Every Other Day</option>
                                <option value="EVERY_OTHER_DAY_TWICE" {{ old('schedule_type') == 'EVERY_OTHER_DAY_TWICE' ? 'selected' : '' }}>Every Other Day Twice</option>
                            </select>
                        </div>
                        @error('schedule_type')
                        <span class="text-danger fw-bold d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment:</label>
                        <textarea name="comment" id="comment" class="form-control">{{ old('comment') }}</textarea>
                        @error('comment')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <h5 class="fw-bold text-secondary">📅 Date Ranges</h5>
                    <div id="date-ranges">
                        @php $dateRanges = old('date_ranges', [['from' => '', 'to' => '']]); @endphp
                        @foreach ($dateRanges as $index => $dateRange)
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col">
                                    <label class="form-label">From:</label>
                                    <input type="date" name="date_ranges[{{ $index }}][from]" class="form-control" required value="{{ $dateRange['from'] ?? '' }}">
                                    @error("date_ranges.$index.from")
                                    <span class="text-danger fw-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label">To:</label>
                                    <input type="date" name="date_ranges[{{ $index }}][to]" class="form-control" required value="{{ $dateRange['to'] ?? '' }}">
                                    @error("date_ranges.$index.to")
                                    <span class="text-danger fw-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="add-date-range" class="btn btn-outline-secondary mt-2">➕ Add Date Range</button>

                    <hr>

                    <button type="submit" class="btn btn-success mt-3">✅ Create Order</button>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-dark mt-3">🔙 Back to Orders</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-date-range').addEventListener('click', function() {
            const container = document.getElementById('date-ranges');
            const index = container.children.length;
            const div = document.createElement('div');
            div.className = 'row g-3 align-items-center mb-2';
            div.innerHTML = `
                <div class="col">
                    <label class="form-label">From:</label>
                    <input type="date" name="date_ranges[${index}][from]" class="form-control" required>
                </div>
                <div class="col">
                    <label class="form-label">To:</label>
                    <input type="date" name="date_ranges[${index}][to]" class="form-control" required>
                </div>
            `;
            container.appendChild(div);
        });
    </script>
@endsection
