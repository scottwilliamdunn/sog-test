@extends('app')

@section('content')
    <div class="table-container">
        <table class="fires-table">
            <thead>
                <tr>
                    <th>Forest</th>
                    <th>Number of fires</th>
                </tr>
            </thead>
            <tbody id="fires-data" onload="setFireData()"></tbody>
        </table>
    </div>
    <div class="pagination-section">
        <div id="pagination-text">asfdsfgdsfg</div>
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
        axios.get(url ?? '/fires')
            .then((response) => {
                if (response.data?.data?.length > 0) {
                    let firesHtml = '';
                    response.data.data.forEach((forest, index) => {
                        firesHtml += `<tr class="${index % 2 !== 0 ? 'even' : 'odd'}-row"><td><a href="/${forest.forest_id}">${forest.name}</a></td><td>${forest.count}</td><tr>`;
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
