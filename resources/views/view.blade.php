@extends('app')

@section('content')
    <div class="table-container">
        <h1 class="forest-header">Wild fires in {{ $forest ?? 'this forest' }}</h1>
        <table class="fires-table">
            <thead>
            <tr>
                <th>FPA ID</th>
                <th>Fire Name</th>
                <th>Discovery Date</th>
                <th>Cause</th>
            </tr>
            </thead>
            <tbody id="fires-data" onload="setFireData()"></tbody>
        </table>
    </div>
    <div class="pagination-section">
        <div id="pagination-text"></div>
        <div class="page-buttons" id="page-buttons"></div>
    </div>

@endsection
<script>
    function setFireData(url = null) {
        const dataElement = document.getElementById("fires-data");
        const buttons = document.getElementById("page-buttons");
        const pagination = document.getElementById("pagination-text");
        dataElement.innerHTML = '';
        pagination.innerHTML = 'LOADING';
        buttons.innerHTML = '';
        axios.get(url ?? '/fires/{{$id}}')
            .then((response) => {
                if (response.data?.data?.length > 0) {
                    let firesHtml = '';
                    response.data.data.forEach((forest, index) => {
                        firesHtml += `<tr class="${index % 2 !== 0 ? 'even' : 'odd'}-row">
                            <td>${forest.fpa_id}</td>
                            <td>${forest.name}</td>
                            <td>${forest.date}</td>
                            <td>${forest.cause}</td>
                        <tr>`;
                    });
                    dataElement.innerHTML = firesHtml;
                    let buttonHtml = '';
                    let paginationText = '';
                    if (response.data.last_page > 1) {
                        response.data.links.forEach(link => {
                            buttonHtml += `<button ${
                                link.active || !link.url
                                    ? 'disabled'
                                    : `onclick="setFireData('${link.url}')"`
                            }>${link.label}</button>`;
                        });
                        paginationText = `Page ${response.data.current_page} - Showing ${response.data['from']} to ${response.data.to} of ${response.data.total}`
                    }
                    pagination.innerHTML = paginationText;
                    buttons.innerHTML = buttonHtml;
                } else {
                    buttons.innerHTML = '';
                    pagination.innerHTML = 'What a pity! There\'s no fire.';
                    dataElement.innerHTML = '';
                }
            });

    }
    window.onload = function () {
        setFireData();
    }
</script>
