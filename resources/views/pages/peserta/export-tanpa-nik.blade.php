<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>RT</th>
            <th>RW</th>
            <th>Provinsi</th>
            <th>Kabupaten/Kota</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataRows as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->rt }}</td>
                <td>{{ $item->rw }}</td>
                <td>{{ $item->provinsi }}</td>
                <td>{{ $item->kabupaten }}</td>
                <td>{{ $item->kecamatan }}</td>
                <td>{{ $item->kelurahan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
