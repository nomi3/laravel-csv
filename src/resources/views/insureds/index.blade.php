<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>保険証データ管理</title>
</head>
<body>
    <h1>保険証データ一覧</h1>
    <p>登録されている保険証の情報を閲覧できます。</p>
    <a href="{{ route('insureds.create') }}">新規登録</a>

    <form id="searchForm">
        <input type="text" name="name" placeholder="漢字氏名" oninput="fetchData()">
        <input type="text" name="last_name_kana" placeholder="カナ（姓）" oninput="fetchData()">
        <input type="text" name="first_name_kana" placeholder="カナ（名）" oninput="fetchData()">
        <input type="text" name="email" placeholder="メールアドレス" oninput="fetchData()">
        <input type="text" name="insurance_card_number" placeholder="保険証番号" oninput="fetchData()">
        <input type="text" name="insurance_card_symbol" placeholder="保険証記号" oninput="fetchData()">
    </form>

    <table id="resultsTable">
        <thead>
            <tr>
                <th>漢字氏名</th>
                <th>カナ（姓）</th>
                <th>カナ（名）</th>
                <th>メールアドレス</th>
                <th>保険証番号</th>
                <th>保険証記号</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($insureds as $insured)
                <tr>
                    <td>{{ $insured->name }}</td>
                    <td>{{ $insured->last_name_kana }}</td>
                    <td>{{ $insured->first_name_kana }}</td>
                    <td>{{ $insured->email }}</td>
                    <td>{{ $insured->insurance_card_number }}</td>
                    <td>{{ $insured->insurance_card_symbol }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function fetchData() {
            const form = document.getElementById('searchForm');
            const formData = new FormData(form);
            const searchParams = new URLSearchParams(formData).toString();

            fetch(`/insureds/search?${searchParams}`)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('resultsTable').getElementsByTagName('tbody')[0];
                tableBody.innerHTML = '';
                data.forEach(item => {
                    const row = `<tr>
                        <td>${item.name}</td>
                        <td>${item.last_name_kana}</td>
                        <td>${item.first_name_kana}</td>
                        <td>${item.email}</td>
                        <td>${item.insurance_card_number}</td>
                        <td>${item.insurance_card_symbol}</td>
                    </tr>`;
                    tableBody.innerHTML += row;
                });
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
