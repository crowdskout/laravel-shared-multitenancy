<tbody>
@foreach($table as $row)
    @if (isset($row['id']))
        <tr onclick="window.location.assign('/profile/{{ $row['id'] }}');">
    @else
        <tr>
    @endif
        @foreach($row as $column)
            <td>
                @if (is_array($column) && count($column) > 0)
                    <table class="table table-responsive">
                        @include('subviews.table-body', ['table' => $column])
                    </table>
                @elseif (!is_array($column))
                    {{ $column }}
                @endif
            </td>
        @endforeach
        </tr>
@endforeach
</tbody>