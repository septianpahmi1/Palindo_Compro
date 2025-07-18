<form id="dashboard-filter" class="row g-2 mb-4">
    @csrf {{-- tidak wajib GET, tapi aman untuk JS fetch POST jika nanti diubah --}}

    <div class="col-auto">
        <select name="range" id="range" class="form-control">
            <option value="all" {{ $range === 'all' ? 'selected' : '' }}>All Time</option>
            <option value="year" {{ $range === 'year' ? 'selected' : '' }}>Per Year</option>
            <option value="month" {{ $range === 'month' ? 'selected' : '' }}>Per Month</option>
        </select>
    </div>

    <div class="col-auto" id="filter-year-wrap">
        <select name="year" id="year" class="form-control">
            @for ($y = now('Asia/Jakarta')->year; $y >= 2020; $y--)
                <option value="{{ $y }}" {{ (int) $year === $y ? 'selected' : '' }}>{{ $y }}
                </option>
            @endfor
        </select>
    </div>

    <div class="col-auto" id="filter-month-wrap" style="{{ $range === 'month' ? '' : 'display:none;' }}">
        <select name="month" id="month" class="form-control">
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ (int) $month === $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->shortMonthName }}
                </option>
            @endfor
        </select>
    </div>

    <div class="col-auto">
        <button type="button" id="applyFilter" class="btn btn-primary">Apply</button>
    </div>
</form>
