@extends('layouts.dasbor')
@section('page_title')
Bimbingan Tugas Akhir
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Profil Tugas Akhir
            </div>
            <form role="form" accept-charset="utf-8" id="form">
                <input name="id_tugas_akhir" type="hidden" value="{{{$item->id_tugas_akhir}}}" />
                <table class="table table-condensed table-striped">
                    <tbody>
                        <tr>
                            <td class="col-md-3">Nama Mahasiswa</td>
                            <td>
                                {{{ $item->mahasiswa->nama_lengkap }}}
                            </td>
                        </tr>
                        <tr>
                            <td>NRP Mahasiswa</td>
                            <td>
                                {{{ $item->mahasiswa->nrp}}}
                            </td>
                        </tr>
                        <tr>
                            <td>Judul</td>
                            <td>
                                <b>{{{$item->penawaranJudul->judul_tugas_akhir}}}</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                    @foreach ($status as $s)
                                        @if(($s->nilai == "siap_seminar" && $mahasiswa['lolos_syarat_seminar_proposal'] == false) || ($s->nilai == "siap_sidang" && $mahasiswa['lolos_syarat_sidang_akhir'] == false)))
                                        @else
                                            <option value="{{$s->nilai}}" {{($item->status == $s->nilai) ? "selected": ""}}>{{{$s->nama}}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Target Selesai</td>
                            <td>
                                <div class="form-group">
                                <div class='input-group date' id='target_selesai' data-date-format="YYYY-MM-DD">
                                    <input type='text' class="form-control" name="target_selesai" value='{{{$item->target_selesai }}}' />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>
                                {{{$item->tanggal_mulai}}}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>
                                {{{ $item->tanggal_selesai }}}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </form>
        
        </div>
    </div>
</div>

@stop

@section('scripts')
    <link rel="stylesheet" href="{{URL::to('/assets/bootstrap/bootstrap-datetimepicker.min.css')}}"/>
    <script src="{{URL::to('/assets/moment.min.js')}}"></script>
    <script src="{{URL::to('/assets/bootstrap/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        $("form").submit(function() {
            $.ajax({
                url: '{{URL::to('/dasbor/dosen/tugas_akhir')}}',
                method: "PUT",
                data: $(this).serialize(),
                success: function() {
                    alert("Berhasil diubah");
                    location.reload();
                }
            });
            return false;
        });

        $("#target_selesai").datetimepicker({
            pickTime: false
        });
    });
    </script>
@stop
