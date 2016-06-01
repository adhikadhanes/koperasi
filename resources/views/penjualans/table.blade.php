<table class="table table-responsive" id="penjualans-table">
    <thead>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Pembeli</th>
        <th>Tanggal</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($penjualans as $penjualan)
        <tr>
            <td>{!! $penjualan->Nama !!}</td>
            <td>{!! $penjualan->Jumlah !!}</td>
            <td>{!! $penjualan->Pembeli !!}</td>
            <td>{!! $penjualan->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['penjualans.destroy', $penjualan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('penjualans.show', [$penjualan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('penjualans.edit', [$penjualan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>