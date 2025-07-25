<div class="table-responsive mailbox-messages">
    <table class="table table-hover table-striped">
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>
                        <div class="icheck-primary">
                            <input type="checkbox" name="ids[]" value="{{ $item->id }}" class="select-item"
                                id="check{{ $item->id }}">
                            <label for="check{{ $item->id }}"></label>
                        </div>
                    </td>
                    <td class="mailbox-name">
                        <p>{{ Str::limit($item->email, 15) }}</p>
                    </td>
                    <td class="mailbox-name">
                        <a href="{{ route('consultation.detail', $item->id) }}">{{ $item->name }}</a>
                    </td>
                    <td class="mailbox-subject">
                        <b>{{ $item->subject }}</b> - {{ Str::limit($item->message, 80) }}
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date">
                        {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada hasil ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-between px-3 py-2">
        <div>
            Menampilkan {{ $data->firstItem() }} - {{ $data->lastItem() }} dari {{ $data->total() }} data
        </div>
        <div>
            {!! $data->withQueryString()->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
