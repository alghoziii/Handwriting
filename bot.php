<!-- Tombol klik -->
<?php
error_reporting(0);
if (isset($_POST["kirim"])) {
    $text = htmlspecialchars($_POST["tulisan"]);
    $font = htmlspecialchars($_POST["font"]);
    $trans = htmlspecialchars($_POST["trans"]);
    $ff = "font-family:" . $font . ";";
    $tt = "text-transform:" . $trans . ";";
    if (
        strlen($text) == null
        && strlen($font) == null
    ) {
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Lengkapi Text',
                    text: 'Text Tidak Boleh Bosong!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    location='index.php?page=bot'
                }
                })
                </script>
                ";
        return false;
    } else if (strlen($text) > 500) {
        echo
        "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Text Melebihi Batas',
                    text: 'text tidak boleh Lebih Dari 500 Karakter! Gunakan akun Premium ',
                    confirmButtonColor: '#30CC72',
                    confirmButtonText: 'Go To Premium'
                }).then((result) => {
                if (result.isConfirmed) {
                    location='premium.php?page=bot'
                }
                })
            </script>
            ";
        return false;
    }
}
?>


<!-- Start Main -->
<main class="is-flex-shrink-0">
    <section class="mt-6 mb-6">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-6">
                    <div class="card mb-3">
                        <header class="card-header">
                            <p class="card-header-title">
                                Form
                            </p>
                            <button class="card-header-icon" aria-label="more options">
                                <span class="icon">
                                    <i class="far fa-paper-plane" aria-hidden="true"></i>
                                </span>
                            </button>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <form action="" method="post">
                                    <div class="field">
                                        <label class="label">Choose Font</label>
                                        <div class="control">
                                            <div class="select">
                                                <select id="font" onchange="IsiFont()" name="font" required>
                                                    <option value="gaegu" <?= $font == "gaegu" ? 'selected' : '' ?>>gaegu (default)</option>
                                                    <option value="indie flower" <?= $font == "indie flower" ? 'selected' : '' ?>>indie flower</option>
                                                    <option value="Caveat" <?= $font == "Caveat" ? 'selected' : '' ?>>Caveat</option>
                                                    <option value="Comfortaa" <?= $font == "Comfortaa" ? 'selected' : '' ?>>Comfortaa</option>
                                                    <option value="Cookie" <?= $font == "Cookie" ? 'selected' : '' ?>>Cookie</option>
                                                    <option value="Gloria Hallelujah" <?= $font == "Gloria Hallelujah" ? 'selected' : '' ?>>Gloria Hallelujah</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Text Transform</label>
                                        <div class="control">
                                            <div class="select">
                                                <select id="trans" onchange="IsiTrans()" name="trans" required>
                                                    <option value="none" <?= $trans == "none" ? 'selected' : '' ?>>none (default)</option>
                                                    <option value="uppercase" <?= $trans == "uppercase" ? 'selected' : '' ?>>uppercase</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Text (Max 500 Character)</label>
                                        <div class="control">
                                            <textarea class="textarea" style="<?= $ff ?><?= $tt ?>" id="ex" onkeyup="DataTulis()" placeholder="Masukkan teks yang akan ditulis.." name="tulisan" required><?= $text ?></textarea>
                                        </div>
                                    </div>
                                    <div class="field is-grouped">
                                        <!-- <div class="control">
                                            <button type="button" role="button" class="button is-primary" onclick="suaraClick()" id="suara"><i class='fas fa-microphone mr-2'></i>Voice (Beta)</button>
                                        </div> -->
                                        <div class="control ml-auto">
                                            <button class="button is-link" type="submit" name="kirim" onclick="generateText()">Generate</button>
                                        </div>
                                        <div class="control">
                                            <button class="button is-link is-light" type="reset" onclick="location='index.php?page=bot tulis'">Reset</button>
                                        </div>
                                    </div>
                                    <!-- <article class="message is-primary">
                                        <div class="message-body">
                                            *Note : Jika memakai voice dan ingin menggunakan enter, selesaikan perekaman voice terlebih dahulu.
                                        </div>
                                    </article> -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                Preview
                            </p>
                            <button class="card-header-icon" aria-label="more options">
                                <span class="icon">
                                    <i class="far fa-images" aria-hidden="true"></i>
                                </span>
                            </button>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <figure class="p-0">
                                    <div id="capture">
                                        <div style="position:relative;overflow-y:hidden;display:block;">
                                            <img src="img/kertas.jpg" id="img">
                                            <div style="position:absolute;top:0;width:100%;height:99%;" id="div">
                                                <p style="font-size:16px;text-align:left;overflow:hidden;<?= $ff ?><?= $tt ?>" id="p"><?= nl2br($text) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                Download (Picture / Pdf)
                            </p>
                            <button class="card-header-icon" aria-label="more options">
                                <span class="icon">
                                    <i class="far fa-images" aria-hidden="true"></i>
                                </span>
                            </button>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <figure class="p-0">
                                    <div id="capture">
                                        <?php if (isset($_POST["kirim"])) : ?>
                                            <div id="blok"></div>
                                        <?php endif; ?>
                                    </div>
                                </figure>
                                <a id="download" class="button is-link">Download Picture</a>
                                <a id="pdf" class="button is-link">Download Pdf</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End Main -->
<script src="htmltocanvas.js"></script>
<script src="pdf.js"></script>
<script>
    // window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    // const recognition = new SpeechRecognition();

    function DataTulis() {
        var ex = document.getElementById("ex");
        var p = document.getElementById("p");
        p.innerText = ex.value;
    }

    function IsiFont() {
        var font = document.getElementById("font");
        var ex = document.getElementById("ex");
        var p = document.getElementById("p");
        p.style.fontFamily = font.value + ",gaegu";
        ex.style.fontFamily = font.value + ",gaegu";
    }

    function IsiTrans() {
        var trans = document.getElementById("trans");
        var ex = document.getElementById("ex");
        var p = document.getElementById("p");
        p.style.textTransform = trans.value;
        ex.style.textTransform = trans.value;
    }
</script>
<?php if (isset($_POST["kirim"])) : ?>
    <script>
        html2canvas(document.getElementById("capture")).then(function(canvas) {
            document.getElementById("blok").appendChild(canvas);
            var anchorTag = document.getElementById("download");
            var img = canvas.toDataURL("image/jpeg");
            anchorTag.href = img;
            anchorTag.target = '_blank';
            anchorTag.download = "belajar";
            var anchorTag2 = document.getElementById("pdf");
            var pdf = new jsPDF();
            var marginLeft = 20;
            var marginRight = 20;
            pdf.addImage(canvas.toDataURL("image/jpeg"), "jpeg", marginLeft, marginRight)
            var string = pdf.output('datauristring');
            anchorTag2.href = string;
            anchorTag2.target = '_blank';
            anchorTag2.download = "belajar";
        });
    </script>
<?php endif; ?>