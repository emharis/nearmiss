<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kriteria</th>
            <th>Jenis Bahaya</th>
            <th>User Issue</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if(count($data)==0)
        <tr>
            <td colspan="9" class="text-center"><i>Tidak ada data yang ditampilkan</i></td>
        </tr>
        @endif
        <?php $rownum = 1; ?>
        @foreach($data as $dt)
        <tr data-id="{{$dt->id}}" class="op-row-data" >
            <td class="text-right">{{ ($data->getCurrentPage()-1)*\Helpers::constval('show_number_datatable') + $rownum++}}.</td>
            <td>{{date('d/m/Y',strtotime($dt->tgl))}}</td>
            <!--<td>{{$dt->kode}}</td>-->
            <td>{{$dt->kriteria}}</td>
            <!--<td>{{$dt->lokasi}}</td>-->
            <td>{{$dt->jenis_bahaya}}</td>
            <td>@if($dt->username == 'admin') admin @else
                {{isset($dt->user_issue)?$dt->user_issue:'-'}} @endif</td>
            <td class="text-center">
<!--                <div class="btn-group">
                    <a class="btn btn-primary btn-xs btnEdit" href="trans/pnrms/edit/{{$dt->id}}">Revisi</a>
                </div>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div id="checked-pagination" >    
        {{$data->links()}}
</div>
