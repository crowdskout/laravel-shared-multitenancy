@if (count($table) === 0)
    <div>Sorry, no profiles to display</div>
@else
    <table class="table table-condensed table-hover">
        <thead>
        <tr>
            @include('subviews.table-head', ['row' => $table[0]])
        </tr>
        </thead>
        @include('subviews.table-body', ['row' => $table[0]])
    </table>
@endif