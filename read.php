<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
        .wrapper {
            width: 1080px;
            margin: auto;
        }

        .page-header h2 {
            margin-top: 0;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div>
        <header>
            <button> <a href="index.php"> Go back</a></button>
        </header>
    </div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Data Mahasiswa</h2><br>
                        <h3>Silahkan Search Untuk menampilkan Data Mahasiswa</h3>
                        <a href="create.php" class="btn btn-dark">Tambah Mahasiswa</a>
                    </div>
                    <div class="container">
                        <form method="post">
                            <input type="text" placeholder="Search Data" name="search">
                            <button class="btn btn-dark" name="submit">Search</button>
                        </form>
                        <div class="container my-5">
                            <table class="table">
                                <?php
                    
                require_once "config.php";
                if(isset($_POST['submit'])){
                    $search=$_POST['search'];
                    $sql="SELECT id, Nama, NIM, Tugas, UTS, UAS, (Tugas+UTS+UAS)/3 as nilaiAkhir from `mahasiswa` where id like '%$search%' or Nama like '%$search%' or NIM like '%$search%' ";
               
                    $result=mysqli_query($con, $sql);
                    $num=mysqli_num_rows($result);
                    $numberPages=3;
                    $totalPages=ceil($num/$numberPages);
                    //echo $totalPages;
                    for($btn=1;$btn<=$totalPages;$btn++){
                        echo '<button class="btn btn-dark mx-1 my-3 mb-3"><a href="read.php?page='.$btn.'" class="text-light">'.$btn.'</a></button>';
                    }
                    if(isset($_GET['page'])){
                        $page=$_GET['page'];
                        //echo $page;
                    }else{
                        $page=1;
                    }
                   $startinglimit=($btn-1)*$numberPages;
                
                if($result){
                    if(mysqli_num_rows($result)>1){
                    echo "<table class='table'>";
                    echo "<thead class='thead-dark'>";
                           echo "<tr>";
                            echo "<th scope='col'>#</th>";
                            echo "<th scope='col'>Nama</th>";
                            echo "<th scope='col'>NIM</th>";
                            echo"<th scope='col'>TUGAS</th>";
                            echo "<th scope='col'>UTS</th>";
                            echo "<th scope='col'>UAS</th>";
                            echo "<th scope='col'>Nilai_Akhir</th>";
                            echo "<th scope='col'>Setting</th>";
                           echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>"; 
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<tr>";
                            echo "<td>". $row['id'] ."</td>";
                            echo "<td>". $row['Nama'] ."</td>";
                            echo "<td>". $row['NIM'] ."</td>";
                            echo "<td>". $row['Tugas'] ."</td>";
                            echo "<td>". $row['UTS'] ."</td>";
                            echo "<td>". $row['UAS'] ."</td>";
                            echo "<td>". $row['nilaiAkhir'] ."</td>";
                            echo "<td>";
                                echo "<a href='view.php?id=". $row['id'] , "' title='View Record' data-toggle='tooltip'>
                                <span class='glyphicon glyphicon-user'></span></a>";
                                echo "<a href='update.php?id=". $row['id'] , "' title='Update Record' data-toggle='tooltip'>
                                <span class='glyphicon glyphicon-pencil'></span></a>";
                                echo "<a href='delete.php?id=". $row['id'] , "' title='Delete Record' data-toggle='tooltip'>
                                <span class='glyphicon glyphicon-remove'></span></a>";
                            echo"</td>";
                        echo"</tr>";
                    }
                    echo "</tbody>";
                    echo"</table>";

                    mysqli_free_result($result);    
                }else{
                    echo '<h2 class=text-danger>Data Not Found</h2>';

                }
                
            }
            mysqli_close($con);
        }
            ?>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>