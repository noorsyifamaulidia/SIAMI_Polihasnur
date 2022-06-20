<style>
    @page {
        header: page-header;
    }

    body {
        font-family: 'arimo', sans-serif;
        line-height: 1.5;
    }

    table {
        display: table;
        border-collapse: separate;
        border-spacing: 2px;
        border-color: grey;
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        background-color: transparent;
    }

    table th,
    table td {
        font-size: 15px;
        padding: 0.3rem;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody+tbody {
        border-top: 2px solid #dee2e6;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .table-bordered thead th,
    .table-bordered thead td {
        border-bottom-width: 2px;
    }

    h6 {
        font-size: 16px;
        margin-bottom: 5px;
    }

    .mb-0 {
        margin-bottom: 0;
    }
</style>

<htmlpageheader name="page-header">
    <table border="1" class="table-bordered">
        <tr>
            <td rowspan="2">
                <img src="{{ $logo['logo'] }}" style="height: 80px; margin: 5px;" alt="">
            </td>
            <td style="padding: 5px">
                <img src="{{ $logo['tagline'] }}" style="height: 50px" alt="">
            </td>
            <td rowspan="2" width="100" style="font-size: 12px; padding: 5px;">FM. ......</td>
        </tr>
        <tr>
            <td align="center" style="padding: 5px"><b>{{ $title }}</b></td>
        </tr>
    </table>
</htmlpageheader>
