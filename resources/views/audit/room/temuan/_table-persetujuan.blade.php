<tr>
    <td colspan="6" align="center"><b>Tempat Persetujuan</b></td>
</tr>
<tr>
    <td>Auditi</td>
    <td>{{ $data->approvalPimpinanAuditi->name ?? '-' }}</td>
    <td></td>
    <td>Ketua Auditor</td>
    <td>{{ $data->approvalKetuaAuditor->name ?? '-' }}</td>
    <td></td>
</tr>
<tr>
    <td colspan="6" align="center">Direview oleh:</td>
</tr>
<tr>
    <td>Penjamin Mutu Audit</td>
    <td>{{ $data->reviewedByUpm->name ?? '-' }}</td>
    <td></td>
    <td>Pimpinan Auditi</td>
    <td>{{ $data->reviewedByPj->name ?? '-' }}</td>
    <td></td>
</tr>
