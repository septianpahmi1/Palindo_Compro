@foreach ($data as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><img src="/file/task/{{ $item->image }}" height="50px" width="50px" style="object-fit: cover" alt=""
                data-toggle="modal" data-target="#imageDetail{{ $item->id }}"></td>
        @include('dashboard.task.image')
        <td>{{ $item->user->name }}</td>
        <td>{{ $item->title }}</td>
        <td>{{ Carbon\Carbon::parse($item->start_at)->format('d F Y') }}</td>
        <td>{{ Carbon\Carbon::parse($item->end_at)->format('d F Y') }}</td>
        <td>
            @if ($item->status == 'Pending')
                <button type="button" class="btn btn-sm btn-outline-primary" readonly>Pending</button>
            @elseif($item->status == 'Completed')
                <button type="button" class="btn btn-sm btn-outline-success" readonly>Completed</button>
            @elseif($item->status == 'Not Completed')
                <button type="button" class="btn btn-sm btn-outline-danger" readonly>Not Completed</button>
            @endif
        </td>
        <td>
            <p data-toggle="modal" data-target="#descDetail{{ $item->id }}">
                {{ Str::limit($item->description ?? '-', 15) }}
            </p>
        </td>
        @include('dashboard.task.description')
        <td>
            <div class="btn-group btn-flat btn-block">
                @if (Auth::user()->role == 'admin')
                    <button url="{{ route('submission.delete', $item->id) }}" data-id="{{ $item->id }}"
                        type="button" class="btn btn-danger btn-sm delete">Delete</button>
                @endif
            </div>
        </td>
    </tr>
@endforeach
