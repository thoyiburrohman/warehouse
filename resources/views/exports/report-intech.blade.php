<div class="table-responsive">
    <table class="table table-hover" id="datatableIntech">
        <thead>
            <tr>
                <th>SERIAL NUMBER</th>
                <th>STATUS</th>
                <th>TEKNISI</th>
                <th>UNIT</th>
                <th>MITRA</th>
                @if (roleId() != 3)
                    <th>WAREHOUSE</th>
                @endif
                <th>UMUR</th>
                <th>TANGGAL</th>
                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($distributions as $item)
                <tr class="single-item">
                    <td class="text-uppercase">{{ $item->nte->serial_number }}</td>
                    <td class="text-uppercase">{{ $item->nte->status }}</td>
                    <td class="text-uppercase">
                        {{ $item->toTechnician->name }}
                    </td>
                    <td class="text-uppercase">
                        {{ $item->toTechnician->division }}
                    </td>
                    <td class="text-uppercase">
                        {{ $item->toTechnician->mitra->name }}
                    </td>
                    @if (roleId() != 3)
                        <td class="text-uppercase">{{ $item->nte->warehouse->name }}</td>
                    @endif
                    <td class="text-uppercase">
                        {{ umurHari($item->id) }}
                    </td>
                    <td class="text-uppercase">
                        {{ Carbon\Carbon::parse($item->date)->format('d-M-y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
