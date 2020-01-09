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

    td {
        padding: 28px 4px;
    }

    .pdf_images {
        width: 122px;
        height: 122px;
    }
</style>

<body>
    <div style="width:100%">
        @php
        /* $myloop = 84;
        $marray = [];
        for ($i=0; $i < $myloop; $i++) { 
            array_push($marray,$i);
        } */
        //dd($marray);
        $chunk_data = array_chunk($myusers->toArray(),14);
        //$chunk_data = array_chunk($marray,14);
        @endphp
        <table style="margin-top: 12px;">

            @for ($i = 0; $i < sizeof($chunk_data); $i++) <tr>

                @for ($j = 0; $j < sizeof($chunk_data[$i]); $j++) <td>


                    @php
                    $img_path = asset('storage/tag/image/'.$chunk_data[$i][$j]['front_tag']);
                    @endphp
                    <img src="{{$img_path}}" alt="" class="pdf_images">
                    </td>
                    @endfor

                    </tr>
                    @endfor


        </table>

    </div>

</body>

</html>