@foreach ($data as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><img src="/file/submission/{{ $item->submission->image }}" height="50px" width="50px"
                style="object-fit: cover" alt="" data-toggle="modal" data-target="#imageDetail{{ $item->id }}">
        </td>

        @include('dashboard.submission.image')
        <td>{{ $item->submission->user->name }}</td>
        <td>{{ $item->submission->title }}</td>
        <td>{{ $item->submission->quantity }}</td>
        <td>Rp {{ number_format($item->submission->price, 0, ',', '.') }}</td>
        <td>Rp {{ number_format($item->submission->total, 0, ',', '.') }}</td>
        <td>
            @if ($item->submission->importance == 'Not important')
                <button type="button" class="btn btn-sm btn-outline-primary" readonly>Low</button>
            @elseif($item->submission->importance == 'Important')
                <button type="button" class="btn btn-sm btn-outline-warning" readonly>Medium</button>
            @elseif($item->submission->importance == 'Very Important')
                <button type="button" class="btn btn-sm btn-outline-danger" readonly>Hight</button>
            @endif
        </td>
        <td>
            @if ($item->status == 'Pending')
                <button type="button" class="btn btn-sm btn-outline-primary" readonly>Pending</button>
            @elseif($item->status == 'Approved')
                <button type="button" class="btn btn-sm btn-outline-success" readonly>Approved</button>
            @elseif($item->status == 'Disapproved')
                <button type="button" class="btn btn-sm btn-outline-danger" readonly>Disapproved</button>
            @endif
        </td>
        <td>
            <p data-toggle="modal" data-target="#descDetail{{ $item->id }}">
                {{ Str::limit($item->submission->description, 15) }}</p>
        </td>
        @include('dashboard.submission.description')
        </td>
        <td>
            <div class="btn-group btn-flat btn-block">
                @if ($item->status == 'Pending')
                    @if (Auth::user()->role == 'super admin')
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#submission{{ $item->id }}">Action</button>
                    @endif
                    @if (Auth::user()->role == 'admin')
                        <button url="{{ route('submission.delete', $item->id) }}" data-id="{{ $item->id }}"
                            type="button" class="btn btn-danger btn-sm delete">Delete</button>
                    @endif
                @endif
            </div>
        </td>
    </tr>
    @include('dashboard.submission.action')
@endforeach
