<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<style>
    body {
        background: #fff;
    }

    .blocks {
        list-style: none;


    }

    .blocks li {
        display: inline-block;
    }

    div.circTxt {
        /*allows for centering*/
        display: inline-block;
        /*adjust as needed*/

        position: relative;
        color: blue;
    }

    .text_ceter {
        position: absolute;
        top: 42px;
        border-bottom: 0;
        left: -15px;
        right: 0;
        font-size: 12px;
        font-weight: bold;

    }

    .text_ceter2 {
        position: absolute;
        top: 60px;
        border-bottom: 0;
        left: -30px;
        right: 0;
        font-size: 12px;
        font-weight: bold;
    }

    .text_ceter3 {
        position: absolute;
        top: 80px;
        border-bottom: 0;
        left: -30px;
        right: 0;
        font-size: 12px;
        font-weight: bold;
    }
</style>

<body>
    <div style="width:100%">

        <ul class="blocks">
            @php
            $testloop = 120;
            $k = 0;
            @endphp
            @foreach ($myusers as $mkey => $user)

            @if($mkey%12==0) @if($mkey> 0)
            <br>
            @endif
            @php
            if($mkey > 0)
            {$k = $k + 120;}

            @endphp
            @endif
            @if($mkey%12==0) <li style="margin-left:-10px;margin-top:{{$k}}px">
                @else
            <li style="margin-left:125px;margin-top:{{$k}}px">
                @endif
                @php
                $string = '/REP/'.$user->pet_code.' - PET-ID.APP/REP/'.$user->pet_code.' - PET-ID.APP';

                $string_array = str_split($string);
                ///dd(str_split($string));
                $deg = 360 / sizeof($string_array);

                $origin = 0;


                //dd($img_path);
                @endphp
                <div class="circTxt" id="test">
                    @foreach ($string_array as $key => $val)
                    <p
                        style='height:60px;position:absolute;transform:rotate({{$origin}}deg);transform-origin:0 100%;font-size:11px;font-weight:bold;'>
                        {{$val}}</p>

                    @php
                    $origin += $deg
                    @endphp
                    @endforeach

                    @php
                    $us = \App\Cloudsa9\Entities\Models\User\User::where('id','=',$user->user_id)->first();
                    @endphp
                    <span class="text_ceter">
                        {{$user->name}}
                    </span>
                    <span class="text_ceter2">
                        {{$us->phone}}
                    </span>
                    <span class="text_ceter3">
                        {{$us->phone}}
                    </span>
                </div>
            </li>
            @endforeach


        </ul>

    </div>

</body>

</html>