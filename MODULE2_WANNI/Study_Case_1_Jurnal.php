<?php
// tangkap nilai MK_KI1201, MK_KU1202, dan MK_KU1102 yang ada pada form html
// silakan taruh code kalian di bawah
if ($_POST) {
    $matkul1 = $_POST["MK_KI1201"];
    $matkul2 = $_POST["MK_KU1202"];
    $matkul3 = $_POST["MK_KU1102"];
}

// **********************  1  ************************** 


// buatkan sebuah perkondisian  
// jika MK_KI1201 atau MK_KU1202 atau MK_KU1102 kosong maka akan muncul pesan error
// silakan taruh code kalian di bawah
if (empty($matkul1) || empty($matkul2) || empty($matkul3)) {
    $error = "MK_KI1201 atau MK_KU1202 atau MK_KU1102 tidak boleh kosong.";

}


// buatkanlah perkondisian jika nilainya memenuhi akan mendapatkan peminatan yang sesuai di jurnal, 
// Untuk nilai peminatan sesuai dengan kondisi yang tertera pada jurnal
// silakan taruh code kalian di bawah
if (!empty($matkul1) && !empty($matkul2) && !empty($matkul3)) {
    if ($matkul1 == 'A') {
        $hasil = "Kamu masuk ke peminatan Kimia Umum";
    } elseif (($matkul2 == 'A' || $matkul2 == 'AB') && ($matkul3 == 'A' || $matkul3 == 'AB' || $matkul3 == 'B')) {
        $hasil = "Kamu masuk ke peminatan Kimia Pangan";
    } else {
        $hasil = "Nilai kamu tidak mencukupi untuk masuk di kedua peminatan";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peminatan</title>
    <link rel="stylesheet" href="css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Pilih Peminatan
                </div>
                <div class="card-body">
                <h3>Masukkan nilai mata kuliah anda pada form dibawah ini</h3>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="MK_KI1201" class="form-label">MK_KI1201</label>
                            <select class="form-select" id="matkul1" name="MK_KI1201" aria-label="Default select example">
                                <option selected value="">Masukkan Nilai</option>
                                <option value="A">A</option>
                                <option value="AB">AB</option>
                                <option value="B">B</option>
                                <option value="BC">BC</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="MK_KU1202" class="form-label">MK_KU1202</label>
                            <select class="form-select" id="matkul2" name="MK_KU1202" aria-label="Default select example">
                                <option selected value="">Masukkan Nilai</option>
                                <option value="A">A</option>
                                <option value="AB">AB</option>
                                <option value="B">B</option>
                                <option value="BC">BC</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="MK_KU1102" class="form-label">MK_KU1102</label>
                            <select class="form-select" id="matkul3" name="MK_KU1102" aria-label="Default select example">
                                <option selected value="">Masukkan Nilai</option>
                                <option value="A">A</option>
                                <option value="AB">AB</option>
                                <option value="B">B</option>
                                <option value="BC">BC</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                        <div class="submit">
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </div>
                    </form>

                    <?php
                    // Hasil dari peminatan yang didapatkan taruh di sini yaaa!!  
                    // silakan taruh code kalian di bawah 
                       
                    if (!empty($hasil)) {
                        echo "<div class='alert alert-success'>$hasil</div>";
                    }
                    ?>

                    <!--Hasil pesan error nya taruh di sini yaaa!!   
                    // silakan taruh code kalian di bawah 
                    
                   hasil error -->
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }     
                    ?>

                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>