<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Pdf</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
</head>


<body>
    
    <div class="container">
        <div class="row" style="height:50px;"></div>
        <div class="row" align="center">
            <h3>Download BackPdf</h3>
        </div>
        <form action="{{ url('download_backpdf') }}" method="GET">
            <div class="row">
            
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="date" class="form-control" name="date" style="height:39px" placeholder="Select Date" required />
                    </div>
                </div>
                <div class="col-sm-4" align="left">
                    <button type="submit" class="btn btn-success">Download</button>
                </div>
            
            </div>
        </form>
        <div class="row" align="center">
            <h3>Download FrontPdf</h3>
        </div>
        <form action="{{ url('download_frontpdf') }}" method="GET">
            <div class="row">
            
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="date" class="form-control" name="date" style="height:39px" placeholder="Select Date" required />
                    </div>
                </div>
                <div class="col-sm-4" align="left">
                    <button type="submit" class="btn btn-success">Download</button>
                </div>
            
            </div>
        </form>
    </div>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>