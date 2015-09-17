<table class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
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
        <tr class="ck-row-data" data-id="{{$dt->id}}">
            <td class="text-right">{{ ($data->getCurrentPage()-1)*\Helpers::constval('nearmiss_list_number') + $rownum++}}.</td>
            <td>{{date('d/m/Y',strtotime($dt->tgl))}}</td>
            <td>{{isset($dt->user_issue)?$dt->user_issue:'-'}}</td>
            <td class="text-center">
                <!--                <div class="btn-group">
                                    <a class="btnEdit" href="trans/pnrms/edit/{{$dt->id}}">Edit</a>
                                </div>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$data->links()}}