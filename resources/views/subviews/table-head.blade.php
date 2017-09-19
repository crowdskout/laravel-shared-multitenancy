<thead>
<tr>
    @foreach($row as $header => $column)
        @if (is_array($column) && count($column) > 0)
            <th class=".container">
            @foreach($column[0] as $subHeader => $subColumn)
                <div class="col-xs-{{ (int) (10 / count($column[0])) }}">
                    {{ $subHeader }}
                </div>
            @endforeach
            </th>
        @elseif (!is_array($column))
            <th>{{ $header }}</th>
        @endif
    @endforeach
</tr>
</thead>