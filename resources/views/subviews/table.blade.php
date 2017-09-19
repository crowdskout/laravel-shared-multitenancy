@if (count($table) === 0)
    <div>Sorry, no profiles to display</div>
@else
    <table class="table table-condensed">
        <thead>
        <tr>
            @foreach($table[0] as $header => $unused)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($table as $row)
            @if (isset($row['id']))
                <tr onclick="window.location.assign('profile/{{ $row['id'] }}');">
            @else
                <tr>
                    @endif
                    @foreach($row as $column)
                        <td>
                            @if (is_array($column) && count($column) > 0)
                                @include('subviews.table', ['table' => $column])
                            @elseif (!is_array($column))
                                {{ $column }}
                            @endif
                        </td>
                    @endforeach
                </tr>
                @endforeach
        </tbody>
    </table>
@endif