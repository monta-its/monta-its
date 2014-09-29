@extends('layouts.default')
@section('content')
<div class="col-md-6">
    <h1>Sunting User</h1>

    @if ($data['item'] != null)
    <?php $item = $data['item']; ?>

    <form action="" method="post" role="form">
        <div class="form-group">
            <label for="">Username</label>
            <input type="text" class="form-control" value="{{ $item->username_user }}" name="username_user">
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Kata Sandi</label>
                <a href="{{ URL::to('user/change_password/' . $item->id_user) }}" class="form-control btn btn-primary">Ganti Kata Sandi</a>
            </div>
        </div>
        <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control" value="{{ $item->name_user }}" name="name_user">
        </div>
        <div class="form-group">
            <label for="">E-mail</label>
            <input type="text" class="form-control" value="{{ $item->email_user }}" name="email_user">
        </div>
        <div class="form-group">
            <label for="">Alamat</label>
            <input type="text" class="form-control" value="{{ $item->address_user }}" name="address_user">
        </div>
        <div class="form-group">
            <label for="">Kontak</label>
            <input type="text" class="form-control" value="{{ $item->contact_user }}" name="contact_user">
        </div>
        <div class="form-group">
            <label for="">Jenis Kelamin</label>
            <select class="form-control" name="gender_user">
                <option value="l" @if ($item->gender_user == 'l') {{ 'selected' }} @endif >Laki-laki</option>
                <option value="p" @if ($item->gender_user == 'p') {{ 'selected' }} @endif >Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Group</label>
            <div class="input-group">
                <select class="form-control" name="group_id">
                    <option value="0"></option>
                @foreach ($data['groups'] as $group)
                    <option value="{{ $group->id_group }}">{{ $group->name_group }}</option>
                @endforeach
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" id="addGroup">Tambah</button>
                </span>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" id="noGroup">Tidak ada group terdaftar</div>
            <table class="table table-striped table-hover" id="group">
                <tbody>
                    <tr class="sample">
                        <td>
                            <a class="text">Nama group</a>
                            <input type="hidden" value="" name="group_ids[]">
                        </td>
                        <td class="col-md-2 text-center"><button type="button" class="btn btn-warning btn-xs removeGroup">Hapus</button></td>
                    </tr>
                @foreach ($item->group as $group)
                    <tr>
                        <td>
                            <a href="{{ URL::to('group/detail/' . $group->id_group) }}" class="text">{{ $group->name_group }}</a>
                            <input type="hidden" value="{{ $group->id_group }}" name="group_ids[]">
                        </td>
                        <td class="col-md-2 text-center"><button type="button" class="btn btn-warning btn-xs removeGroup">Hapus</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <label for="">Enabled</label>
            <select class="form-control" name="enabled">
                <option value="1" @if ($item->enabled == '1') {{ 'selected' }} @endif >Ya</option>
                <option value="0" @if ($item->enabled == '0') {{ 'selected' }} @endif >Tidak</option>
            </select>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-success">Simpan</button>
    </form>
    @endif
</div>
@stop

@section('custom_foot')
    @include('scripts.item-input-control')
    <script type="text/javascript">
        $(document).ready(function(){
            runItemInputControl(['group']);
        });
    </script>
@stop