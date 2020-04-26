<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Email Peserta</th>
        <th>Asal Sekolah</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
    </tr>
    </thead>
    <tbody>
    @php $i = 1 @endphp
    @foreach($peserta as $p)
        <tr>
            <td>{{$i++}}</td>
            <td>{{ $p->lampiran->nama_peserta }}</td>
            <td>{{ $p->lampiran->email_peserta }}</td>
            <td>{{ $p->lampiran->asal_sekolah }}</td>
            <td>{{ $p->lampiran->mulai }}</td>
            <td>{{ $p->lampiran->selesai }}</td>
        </tr>
    @endforeach
    </tbody>
</table>