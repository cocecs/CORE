@php
    $towns = [
        "7206" => "Aloran",
        "7211" => "Baliangao",
        "7215" => "Bonifacio",
        "7210" => "Calamba",
        "7201" => "Clarin",
        "7213" => "Concepcion",
        "7204" => "Jimenez",
        "7208" => "Lopez Jaena",
        "7207" => "Oroquieta City",
        "7200" => "Ozamiz City",
        "7205" => "Panaon",
        "7209" => "Plaridel",
        "7212" => "Sapang Dalaga",
        "7203" => "Sinacaban",
        "7214" => "Tangub City",
        "7202" => "Tudela",
    ];




@endphp

<select {{ $attributes }}>
    @foreach($towns as $zip => $name)
        <option value="{{ $zip }}">{{ $name }}</option>
    @endforeach
</select>
