<table style="width: 100%;   border-collapse: collapse;   border: 1px solid black;">
    <thead>
    <tr>
        <th style="border: 1px solid black;">N¤</th>
        <th style="border: 1px solid black;">Matiere</th>
        <th style="border: 1px solid black;">Note</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($all_notes as $key =>$info)
        <tr style="font-size: 16px">
            <td class="black-text" style="  border: 1px solid black;">{{++$key}}</td>
            <td class="black-text" style="  border: 1px solid black;">{{$info->lib_mat}}</td>
            <td class="black-text" style="  border: 1px solid black;">{{$info->note}}</td>
        </tr>
    @endforeach
    </tbody>
</table>