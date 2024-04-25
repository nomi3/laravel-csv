<!DOCTYPE html>
<html>
<head>
    <title>保険証データ管理</title>
</head>
<body>
    <h1>保険証データ一覧</h1>

    <p>登録されている保険証の情報を閲覧できます。</p>

    <a href="{{ route('insureds.create') }}">新規登録</a>

    <table>
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
</body>
</html>
