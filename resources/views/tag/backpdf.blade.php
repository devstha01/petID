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
        padding: 5px;
    }

    .pdf_images {
        width: 113px;
        height: 113px;
    }
</style>

<body>
    <div style="width:100%">
        @php

        $chunk_data = array_chunk($myusers,12);

        @endphp
        <table>

            @for ($i = 0; $i < sizeof($chunk_data); $i++) <tr>

                @for ($j = 0; $j < sizeof($chunk_data[$i]); $j++) <td>


                    @php
                    // $img_path = url('storage/app/public/tag/image/'.$chunk_data[$i][$j]['image1']);
                    $img_path = url('storage/app/public/tag/image/5df3320259a270.14600610.jpg');
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