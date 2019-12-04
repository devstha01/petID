<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <title>QR Code site</title>
    <style>
         @page{
            size:A4;
            margin:0;
        }
        
        .container {
            page:cover;
        }

        * {
            padding: 0;
            margin: 0;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            font-family: "Bebas Neue", cursive;
        }

     

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: distribute;
            justify-content: space-around;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: 20px 0;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .row .qrcode-container {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            position: relative;
            margin: 25px;
            width: 50px;
        }

        .row .qrcode-container .qrcode-img {
            width: inherit;
        }

        .row .qrcode-container span {
            position: absolute;
            font-size: 12px;
            text-align: center;
            height: 105px;
            display: -ms-grid;
            display: grid;
            -ms-flex-line-pack: end;
            align-content: flex-end;
            color: blue;
            font-weight: bold;
        }

        .char1 {
            -webkit-transform: rotate(-90deg);
            transform: rotate(-90deg);
        }

        .char22 {
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
        }

        .char2 {
            -webkit-transform: rotate(75deg);
            transform: rotate(75deg);
        }

        .char3 {
            -webkit-transform: rotate(67deg);
            transform: rotate(67deg);
        }

        .char4 {
            -webkit-transform: rotate(59deg);
            transform: rotate(59deg);
        }

        .char5 {
            -webkit-transform: rotate(51deg);
            transform: rotate(51deg);
        }

        .char6 {
            -webkit-transform: rotate(43deg);
            transform: rotate(43deg);
        }

        .char7 {
            -webkit-transform: rotate(35deg);
            transform: rotate(35deg);
        }

        .char8 {
            -webkit-transform: rotate(27deg);
            transform: rotate(27deg);
        }

        .char9 {
            -webkit-transform: rotate(19deg);
            transform: rotate(19deg);
        }

        .char10 {
            -webkit-transform: rotate(11deg);
            transform: rotate(11deg);
        }

        .char11 {
            -webkit-transform: rotate(3deg);
            transform: rotate(3deg);
        }

        .char12 {
            -webkit-transform: rotate(-5deg);
            transform: rotate(-5deg);
        }

        .char13 {
            -webkit-transform: rotate(-13deg);
            transform: rotate(-13deg);
        }

        .char14 {
            -webkit-transform: rotate(-21deg);
            transform: rotate(-21deg);
        }

        .char15 {
            -webkit-transform: rotate(-29deg);
            transform: rotate(-29deg);
        }

        .char16 {
            -webkit-transform: rotate(-37deg);
            transform: rotate(-37deg);
        }

        .char17 {
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .char18 {
            -webkit-transform: rotate(-53deg);
            transform: rotate(-53deg);
        }

        .char19 {
            -webkit-transform: rotate(-61deg);
            transform: rotate(-61deg);
        }

        .char20 {
            -webkit-transform: rotate(-69deg);
            transform: rotate(-69deg);
        }

        .char21 {
            -webkit-transform: rotate(-77deg);
            transform: rotate(-77deg);
        }

        .char23 {
            -webkit-transform: rotate(-105deg);
            transform: rotate(-105deg);
        }

        .char24 {
            -webkit-transform: rotate(-113deg);
            transform: rotate(-113deg);
        }

        .char25 {
            -webkit-transform: rotate(-121deg);
            transform: rotate(-121deg);
        }

        .char26 {
            -webkit-transform: rotate(-129deg);
            transform: rotate(-129deg);
        }

        .char27 {
            -webkit-transform: rotate(-137deg);
            transform: rotate(-137deg);
        }

        .char28 {
            -webkit-transform: rotate(-145deg);
            transform: rotate(-145deg);
        }

        .char29 {
            -webkit-transform: rotate(-153deg);
            transform: rotate(-153deg);
        }

        .char30 {
            -webkit-transform: rotate(-161deg);
            transform: rotate(-161deg);
        }

        .char31 {
            -webkit-transform: rotate(-169deg);
            transform: rotate(-169deg);
        }

        .char32 {
            -webkit-transform: rotate(-177deg);
            transform: rotate(-177deg);
        }

        .char33 {
            -webkit-transform: rotate(-185deg);
            transform: rotate(-185deg);
        }

        .char34 {
            -webkit-transform: rotate(-193deg);
            transform: rotate(-193deg);
        }

        .char35 {
            -webkit-transform: rotate(-201deg);
            transform: rotate(-201deg);
        }

        .char36 {
            -webkit-transform: rotate(-209deg);
            transform: rotate(-209deg);
        }

        .char37 {
            -webkit-transform: rotate(-217deg);
            transform: rotate(-217deg);
        }

        .char38 {
            -webkit-transform: rotate(-225deg);
            transform: rotate(-225deg);
        }

        .char39 {
            -webkit-transform: rotate(-233deg);
            transform: rotate(-233deg);
        }

        .char40 {
            -webkit-transform: rotate(-241deg);
            transform: rotate(-241deg);
        }

        .char41 {
            -webkit-transform: rotate(-249deg);
            transform: rotate(-249deg);
        }

        .char42 {
            -webkit-transform: rotate(-257deg);
            transform: rotate(-257deg);
        }

        /*# sourceMappingURL=styles.css.map */
    </style>
</head>

<body>
    <div class="container">

        <div class="row 1">
            <div class="qrcode-container">
                <img src="{{ asset('/images/qrcode.PNG')}}" alt="QR code" class="qrcode-img" />
                <span>12345</span>
            </div>

            <div class="qrcode-container">
                <img src="{{ asset('/images/qrcode.PNG')}}" alt="QR code" class="qrcode-img" />
                <span>12345</span>
            </div>
            
            <div class="qrcode-container">

                <span class="char1">-</span>
                <span class="char2">P</span>
                <span class="char3">E</span>
                <span class="char4">T</span>
                <span class="char5">-</span>
                <span class="char6">I</span>
                <span class="char7">D</span>
                <span class="char8">.</span>
                <span class="char9">A</span>
                <span class="char10">P</span>
                <span class="char11">P</span>
                <span class="char12">/</span>
                <span class="char13">R</span>
                <span class="char14">F</span>
                <span class="char15">P</span>
                <span class="char16">/</span>
                <span class="char17">S</span>
                <span class="char18">C</span>
                <span class="char19">7</span>
                <span class="char20">3</span>
                <span class="char21">4</span>


                <span class="char22">-</span>
                <span class="char23">P</span>
                <span class="char24">E</span>
                <span class="char25">T</span>
                <span class="char26">-</span>
                <span class="char27">I</span>
                <span class="char28">D</span>
                <span class="char29">.</span>
                <span class="char30">A</span>
                <span class="char31">P</span>
                <span class="char32">P</span>
                <span class="char33">/</span>
                <span class="char34">R</span>
                <span class="char35">F</span>
                <span class="char36">P</span>
                <span class="char37">/</span>
                <span class="char38">S</span>
                <span class="char39">C</span>
                <span class="char40">7</span>
                <span class="char41">3</span>
                <span class="char42">4</span>

                <img src="{{ asset('/images/qrcode.PNG')}}" alt="QR code" class="qrcode-img" />


            </div>

            <div class="qrcode-container">

                <span class="char1">-</span>
                <span class="char2">P</span>
                <span class="char3">E</span>
                <span class="char4">T</span>
                <span class="char5">-</span>
                <span class="char6">I</span>
                <span class="char7">D</span>
                <span class="char8">.</span>
                <span class="char9">A</span>
                <span class="char10">P</span>
                <span class="char11">P</span>
                <span class="char12">/</span>
                <span class="char13">R</span>
                <span class="char14">F</span>
                <span class="char15">P</span>
                <span class="char16">/</span>
                <span class="char17">S</span>
                <span class="char18">C</span>
                <span class="char19">7</span>
                <span class="char20">3</span>
                <span class="char21">4</span>


                <span class="char22">-</span>
                <span class="char23">P</span>
                <span class="char24">E</span>
                <span class="char25">T</span>
                <span class="char26">-</span>
                <span class="char27">I</span>
                <span class="char28">D</span>
                <span class="char29">.</span>
                <span class="char30">A</span>
                <span class="char31">P</span>
                <span class="char32">P</span>
                <span class="char33">/</span>
                <span class="char34">R</span>
                <span class="char35">F</span>
                <span class="char36">P</span>
                <span class="char37">/</span>
                <span class="char38">S</span>
                <span class="char39">C</span>
                <span class="char40">7</span>
                <span class="char41">3</span>
                <span class="char42">4</span>

                <img src="{{ asset('/images/qrcode.PNG')}}" alt="QR code" class="qrcode-img" />


            </div>

            <div class="qrcode-container">

                <span class="char1">-</span>
                <span class="char2">P</span>
                <span class="char3">E</span>
                <span class="char4">T</span>
                <span class="char5">-</span>
                <span class="char6">I</span>
                <span class="char7">D</span>
                <span class="char8">.</span>
                <span class="char9">A</span>
                <span class="char10">P</span>
                <span class="char11">P</span>
                <span class="char12">/</span>
                <span class="char13">R</span>
                <span class="char14">F</span>
                <span class="char15">P</span>
                <span class="char16">/</span>
                <span class="char17">S</span>
                <span class="char18">C</span>
                <span class="char19">7</span>
                <span class="char20">3</span>
                <span class="char21">4</span>


                <span class="char22">-</span>
                <span class="char23">P</span>
                <span class="char24">E</span>
                <span class="char25">T</span>
                <span class="char26">-</span>
                <span class="char27">I</span>
                <span class="char28">D</span>
                <span class="char29">.</span>
                <span class="char30">A</span>
                <span class="char31">P</span>
                <span class="char32">P</span>
                <span class="char33">/</span>
                <span class="char34">R</span>
                <span class="char35">F</span>
                <span class="char36">P</span>
                <span class="char37">/</span>
                <span class="char38">S</span>
                <span class="char39">C</span>
                <span class="char40">7</span>
                <span class="char41">3</span>
                <span class="char42">4</span>

                <img src="{{ asset('/images/qrcode.PNG')}}" alt="QR code" class="qrcode-img" />


            </div>

            <div class="qrcode-container">

                <span class="char1">-</span>
                <span class="char2">P</span>
                <span class="char3">E</span>
                <span class="char4">T</span>
                <span class="char5">-</span>
                <span class="char6">I</span>
                <span class="char7">D</span>
                <span class="char8">.</span>
                <span class="char9">A</span>
                <span class="char10">P</span>
                <span class="char11">P</span>
                <span class="char12">/</span>
                <span class="char13">R</span>
                <span class="char14">F</span>
                <span class="char15">P</span>
                <span class="char16">/</span>
                <span class="char17">S</span>
                <span class="char18">C</span>
                <span class="char19">7</span>
                <span class="char20">3</span>
                <span class="char21">4</span>


                <span class="char22">-</span>
                <span class="char23">P</span>
                <span class="char24">E</span>
                <span class="char25">T</span>
                <span class="char26">-</span>
                <span class="char27">I</span>
                <span class="char28">D</span>
                <span class="char29">.</span>
                <span class="char30">A</span>
                <span class="char31">P</span>
                <span class="char32">P</span>
                <span class="char33">/</span>
                <span class="char34">R</span>
                <span class="char35">F</span>
                <span class="char36">P</span>
                <span class="char37">/</span>
                <span class="char38">S</span>
                <span class="char39">C</span>
                <span class="char40">7</span>
                <span class="char41">3</span>
                <span class="char42">4</span>

                <img src="{{ asset('/images/qrcode.PNG')}}" alt="QR code" class="qrcode-img" />


            </div>

            <div class="qrcode-container">

                <span class="char1">-</span>
                <span class="char2">P</span>
                <span class="char3">E</span>
                <span class="char4">T</span>
                <span class="char5">-</span>
                <span class="char6">I</span>
                <span class="char7">D</span>
                <span class="char8">.</span>
                <span class="char9">A</span>
                <span class="char10">P</span>
                <span class="char11">P</span>
                <span class="char12">/</span>
                <span class="char13">R</span>
                <span class="char14">F</span>
                <span class="char15">P</span>
                <span class="char16">/</span>
                <span class="char17">S</span>
                <span class="char18">C</span>
                <span class="char19">7</span>
                <span class="char20">3</span>
                <span class="char21">4</span>


                <span class="char22">-</span>
                <span class="char23">P</span>
                <span class="char24">E</span>
                <span class="char25">T</span>
                <span class="char26">-</span>
                <span class="char27">I</span>
                <span class="char28">D</span>
                <span class="char29">.</span>
                <span class="char30">A</span>
                <span class="char31">P</span>
                <span class="char32">P</span>
                <span class="char33">/</span>
                <span class="char34">R</span>
                <span class="char35">F</span>
                <span class="char36">P</span>
                <span class="char37">/</span>
                <span class="char38">S</span>
                <span class="char39">C</span>
                <span class="char40">7</span>
                <span class="char41">3</span>
                <span class="char42">4</span>

                <img src="{{ asset('/images/qrcode.PNG')}}" alt="QR code" class="qrcode-img" />


            </div>

            <div class="qrcode-container">

                <span class="char1">-</span>
                <span class="char2">P</span>
                <span class="char3">E</span>
                <span class="char4">T</span>
                <span class="char5">-</span>
                <span class="char6">I</span>
                <span class="char7">D</span>
                <span class="char8">.</span>
                <span class="char9">A</span>
                <span class="char10">P</span>
                <span class="char11">P</span>
                <span class="char12">/</span>
                <span class="char13">R</span>
                <span class="char14">F</span>
                <span class="char15">P</span>
                <span class="char16">/</span>
                <span class="char17">S</span>
                <span class="char18">C</span>
                <span class="char19">7</span>
                <span class="char20">3</span>
                <span class="char21">4</span>


                <span class="char22">-</span>
                <span class="char23">P</span>
                <span class="char24">E</span>
                <span class="char25">T</span>
                <span class="char26">-</span>
                <span class="char27">I</span>
                <span class="char28">D</span>
                <span class="char29">.</span>
                <span class="char30">A</span>
                <span class="char31">P</span>
                <span class="char32">P</span>
                <span class="char33">/</span>
                <span class="char34">R</span>
                <span class="char35">F</span>
                <span class="char36">P</span>
                <span class="char37">/</span>
                <span class="char38">S</span>
                <span class="char39">C</span>
                <span class="char40">7</span>
                <span class="char41">3</span>
                <span class="char42">4</span>

                <img src="{{ asset('/images/qrcode.PNG') }}" alt="QR code" class="qrcode-img" />

            </div>
        </div>

    </div>
</body>

</html>