<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/index.js') }}"></script>
    <title>Product list</title>
</head>
<body>
    <table>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    @foreach ($productItemData as $data)
        <tr>
            <td>{{ $data['name'] }}</td>
            <td>{{ $data['wattage'] }}</td>
            <td>{{ $data['price'] }}</td>
            <td> <button name="product{{ $data['id'] }}" id="{{ $data['id'] }}" type="submit" onclick="productInWinkelWagenZetten({{ $data['id'] }})">Buy</button> </td>
        </tr>
    @endforeach
    </table>

    <div id="hiddenItemBox">
        @foreach ($productItemData as $data)
            <div hidden id="product{{ $data['id'] }}"> {{ $data['name'] }} aantal <b id="productAantal{{ $data['id'] }}"></b> <button type="submit" onclick="productInWinkelWagenZetten({{ $data['id'] }})">+</button> <button type="submit"  onclick="productInWinkelWagenVerweideren({{ $data['id'] }})">-</button> <b id="plekVoorbedrag{{ $data['id'] }}"></b></div>
        @endforeach
        <div id="plekVoorEindTotaal"></div>
    </div>
</body>
</html>