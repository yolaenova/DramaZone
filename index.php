<?php 
//menyertakan code dari file koneksi
include "koneksi.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DramaZone</title>
    <link rel="icon" href="image/logo.png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
      background-color: #fff8fc;
      font-family: 'Poppins', sans-serif;
    }

    /* navbar */
    .navbar {
      background: linear-gradient(90deg, #ffb6f9, #b8b8ff);
    }
    .navbar-brand {
      font-weight: 700;
      color: #6c2eb9;
    }
    .nav-link {
      color: #4b0082;
      font-weight: 500;
    }
    .nav-link:hover {
      color: #6b00b3;
    }
    .navbar {
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    /* hero */
    .hero {
      background: linear-gradient(135deg, #ffe6fa, #c3d8ff);
      text-align: center;
      padding: 100px 20px;
    }
    .hero h1 {
      font-weight: 700;
      color: #6b00b3;
    }
    .hero p {
      color: #555;
      font-size: 1.1rem;
    }

    /* button */
    .btn-pastel {
      background-color: #c3d8ff;
      color: #4b0082;
      font-weight: 500;
      border-radius: 20px;
      transition: 0.3s;
    }
    .btn-pastel:hover {
      background-color: #b8b8ff;
      color: #fff;
    }

    /* card */
    .card {
      border: none;
      border-radius: 20px;
      transition: 0.3s;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    /* section */
    .section-title {
      text-align: center;
      margin: 60px 0 30px;
      color: #6b00b3;
      font-weight: 600;
    }

    /* bio card */
    .bio-card {
      background-color: #ffe6fa;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    /* actor */
    .actor-img {
      border-radius: 50%;
      width: 150px;
      height: 150px;
      object-fit: cover;
    }

    /* footer */
    footer {
      background-color: #d9c7ff;
      color: #4b0082;
      text-align: center;
      padding: 20px 0;
      margin-top: 60px;
    }
    .social-links a {
      color: #4b0082;
      margin: 0 10px;
      font-size: 1.3rem;
      text-decoration: none;
      transition: 0.3s;
    }
    .social-links a:hover {
      color: #6b00b3;
    }

    /* schedule */
    .schedule {
      background-color: #fff8fc;
    }
    .schedule h2 {
      color: black;
    }
    .schedule-card {
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      transition: 0.3s;
      border: none;
    }
    .schedule-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .schedule-card p {
      font-size: 0.95rem;
      color: #555;
    }
    .schedule-icon {
      font-size: 2rem;
      color: #ff0033;
    }

    /* about me */
    .about-section {
      background-color: #f8d7da;
      padding: 40px;
      border-radius: 10px;
      margin: 30px;
    }
    .about-title {
      text-align: center;
      font-weight: 700;
      margin-bottom: 20px;
    }
    .accordion-button:not(.collapsed) {
      background-color: #c82333;
      color: white;
      box-shadow: none;
    }
    .accordion-button:hover {
      background-color: #dc3545;
      color: white;
    }

    /* dark mode */
    .dark-mode {
      background-color: #1f1f1f !important;
      color: #ffffff !important;
    }
    .dark-mode *, 
    .dark-mode a:hover {
      color: #ffffff !important;
    }
    .dark-mode section,
    .dark-mode .hero,
    .dark-mode footer,
    .dark-mode .navbar {
      background-color: #262626 !important;
    }
    .dark-mode .card,
    .dark-mode .bio-card,
    .dark-mode .schedule-card,
    .dark-mode .accordion-item {
      background-color: #2e2e2e !important;
      border: 1px solid #3d3d3d !important;
      box-shadow: none !important;
    }
    .dark-mode .accordion-button {
      background-color: #4b4b4b !important;
    }
    .dark-mode .accordion-button:not(.collapsed) {
      background-color: #3a3a3a !important;
    }
    .dark-mode .btn-pastel {
      background-color: #3a3a3a !important;
      color: #ffffff !important;
    }
    .dark-mode * {
      background-image: none !important;
    }
    .dark-mode .navbar-toggler-icon {
      background-image: var(--bs-navbar-toggler-icon-bg) !important;
      filter: invert(1);
    }
    .dark-mode .navbar-toggler {
      border-color: #ffffff !important;
    }
    #btnDark {
      background-color: #000 !important;
      color: #fff !important;
    }
    #btnLight {
      background-color: #ff0000 !important;
      color: #fff !important;
    }
  </style>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#">DramaZone</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#about">Tentang Saya</a></li>
            <li class="nav-item"><a class="nav-link" href="#article">Drama</a></li>
            <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="#aktor">Aktor</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
            <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
            <li class="nav-item"><a class="nav-link" href="#aboutme">About Me</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php" target="_blank">Login</a></li>
            <li class="nav-item ms-3">
            <button id="btnDark" class="btn btn-dark btn-sm">
              <i class="bi bi-moon"></i>
            </button>
            </li>
            <li class="nav-item ms-2">
              <button id="btnLight" class="btn btn-light btn-sm">
                <i class="bi bi-brightness-high"></i>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- hero -->
    <section class="hero">
      <h1>Selamat Datang di DramaZone</h1>
      <p>Tempat terbaik untuk menemukan drama-drama pilihan dan aktor favoritmu.</p>
      <p>
      <span id="tanggal"></span>
      <span id="jam"></span>
      </p>
      <a href="#drama" class="btn btn-pastel mt-3">Lihat Drama</a>
    </section>

    <!-- tentang saya -->
    <section id="about" class="container my-5">
      <div class="bio-card d-flex flex-column flex-md-row align-items-center gap-4">
        <img src="image/foto.jpg" alt="Foto Profil" class="rounded-circle" width="180" height="180">
        <div>
          <h3 class="text-purple">Halo, Aku Yola Enova Sabilla</h3>
          <p>
            Aku seorang mahasiswi Informatika yang suka menonton drama Korea dan China. 
            Di sini, aku ingin berbagi beberapa drama favoritku dan para aktor yang aku kagumi. 
            Semoga kamu juga suka!
          </p>
        </div>
      </div>
    </section>

    <!-- drama -->
    <!-- article begin -->
    <section id="article" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Drama</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
            <?php
            $sql = "SELECT * FROM article ORDER BY tanggal DESC";
            $hasil = $conn->query($sql); 

            while($row = $hasil->fetch_assoc()){
            ?>
            <!-- col begin -->     
            <div class="col">
                     <div class="card h-100">
                        <img src="image/<?= $row["gambar"] ?>" class="card-img-top" alt="..." />
                        <div class="card-body">
                            <h5 class="card-title"><?= $row["judul"] ?></h5>
                            <p class="card-text">
                             <?= $row["isi"] ?>    
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">
                              <?= $row["tanggal"] ?> 
                            </small>
                        </div>
                    </div>
                </div>
            <!-- col end -->
             <?php
            }
            ?>
            </div>
        </div>
    </section>
    <!-- article end -->

    <!-- gallery begin -->
    <section id="gallery" class="text-center p-5 bg-light">
      <div class="container">
        <h1 class="fw-bold display-5 pb-4">Gallery</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
          <?php
          $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
          $hasil = $conn->query($sql);

          while ($row = $hasil->fetch_assoc()) {
          ?>
          <div class="col">
            <div class="card h-100">
              <img src="image/<?= $row['gambar']; ?>" class="card-img-top" alt="gallery">
              <div class="card-body">
                <p class="card-text"><?= $row['deskripsi']; ?></p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary">
                  <?= $row['tanggal']; ?><br>
                  oleh : <?= $row['username']; ?>
                </small>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <!-- gallery end -->

    <!-- aktor -->
    <section id="aktor" class="py-5 text-center bg-light">
      <div class="container">
        <h2 class="section-title">Aktor dan Aktris Utama</h2>
        <div class="row">
          <div class="col-md-4">
            <img src="image/tianxiwei.jpeg" class="actor-img mb-3" alt="Tian Xiwei">
            <h5>Tian Xiwei</h5>
            <p>Pemeran utama wanita yang dikenal dengan pesona lembut dan cerianya.</p>
          </div>
          <div class="col-md-4">
            <img src="image/zhanglinghe.jpeg" class="actor-img mb-3" alt="Zhang Linghe">
            <h5>Zhang Linghe</h5>
            <p>Aktor tampan yang memerankan karakter jenius e-sport penuh karisma.</p>
          </div>
          <div class="col-md-4">
            <img src="image/moongayoung.jpeg" class="actor-img mb-3" alt="Moon Ga Young">
            <h5>Moon Ga Young</h5>
            <p>Aktris multitalenta dengan peran pendukung yang kuat dan berkarakter.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- schedule -->
    <section class="schedule py-5" id="schedule">
      <div class="container">
        <h2 class="section-title">Schedule</h2>
        <div class="row g-4 justify-content-center">
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="schedule-card text-center p-3">
              <i class="bi bi-book schedule-icon"></i>
              <h5 class="mt-3">Membaca</h5>
              <p>Menambah wawasan setiap pagi sebelum beraktivitas.</p>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3">
            <div class="schedule-card text-center p-3">
              <i class="bi bi-pencil-square schedule-icon"></i>
              <h5 class="mt-3">Menulis</h5>
              <p>Mencatat setiap pengalaman harian di jurnal pribadi.</p>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3">
            <div class="schedule-card text-center p-3">
              <i class="bi bi-people schedule-icon"></i>
              <h5 class="mt-3">Diskusi</h5>
              <p>Bertukar ide dengan teman dalam kelompok belajar.</p>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3">
            <div class="schedule-card text-center p-3">
              <i class="bi bi-bicycle schedule-icon"></i>
              <h5 class="mt-3">Olahraga</h5>
              <p>Menjaga kesehatan dengan bersepeda sore hari.</p>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3">
            <div class="schedule-card text-center p-3">
              <i class="bi bi-film schedule-icon"></i>
              <h5 class="mt-3">Movie</h5>
              <p>Menonton film yang bagus di bioskop.</p>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-3">
            <div class="schedule-card text-center p-3">
              <i class="bi bi-bag schedule-icon"></i>
              <h5 class="mt-3">Belanja</h5>
              <p>Membeli kebutuhan bulanan di supermarket.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Me -->
    <section id="aboutme" class="about-section">
    <header>
      <h2 class="about-title">About Me</h2>
    </header>

    <div class="accordion" id="aboutAccordion">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Universitas Dian Nuswantoro Semarang (2024-Now)
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#aboutAccordion">
          <div class="accordion-body">
            <strong>This is the first item's accordion body.</strong> Saya mengambil Prodi S1 Teknik Informatika Fakultas Ilmu Komputer, sekarang saya sudah semester 3. Harapan saya bisa lulus cumlaude dalam 7 semester. 
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            SMK Negeri 1 Tengaran (2021-2024)
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#aboutAccordion">
          <div class="accordion-body">
            Di SMK Negeri 1 Tengaran saya mengambil jurusan Rekayasa Perangkat Lunak.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            SMP Negeri 1 Tengaran (2018-2021)
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#aboutAccordion">
          <div class="accordion-body">
            Di SMP Negeri 1 Tengaran saya masih berangkat menggunakan transportasi umum. Ketika saya pulang saya juga sering main ataupun jajan bersama teman-teman saya.
          </div>
        </div>
      </div>
    </div>
  </section>

    <!-- kontak -->
    <section id="contact" class="container my-5">
      <h2 class="section-title">Hubungi Aku</h2>
      <form class="mx-auto" style="max-width: 600px;">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" placeholder="Masukkan nama kamu">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Masukkan email kamu">
        </div>
        <div class="mb-3">
          <label for="pesan" class="form-label">Pesan</label>
          <textarea class="form-control" id="pesan" rows="4" placeholder="Tulis pesanmu di sini..."></textarea>
        </div>
        <button type="submit" class="btn btn-pastel">Kirim Pesan</button>
      </form>

      <div class="text-center mt-4">
        <p class="mb-2">Atau hubungi lewat media sosial:</p>
        <div class="social-links">
          <a href="mailto:yolaenova@example.com"><i class="bi bi-envelope"></i> Email</a>
          <a href="https://www.instagram.com/" target="_blank"><i class="bi bi-instagram"></i> Instagram</a>
          <a href="https://wa.me/6281234567890" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp</a>
        </div>
      </div>
    </section>

    <!-- footer -->
    <footer>
      <p>© 2025 DramaZone | Yola Enova Sabilla</p>
    </footer>

    		<!-- Tombol Back to Top -->
    <button
      id="backToTop"
      class="btn btn-danger rounded-circle position-fixed bottom-0 end-0 m-3">
      <i class="bi bi-arrow-up" title="Back to Top"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script type="text/javascript">
      function tampilWaktu(){
        const waktu = new Date();
        
        const tanggal = waktu.getDate();
        const bulan = waktu.getMonth();
        const tahun = waktu.getFullYear();
        const jam = waktu.getHours();
        const menit = waktu.getMinutes();
        const detik = waktu.getSeconds();

        const arrBulan = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];

        const tanggal_full = tanggal + "/" + arrBulan[bulan] + "/" + tahun;
        const jam_full = jam + ":" + menit + ":" + detik;

        document.getElementById("tanggal").innerHTML = tanggal_full;
        document.getElementById("jam").innerHTML = jam_full;
      }

      setInterval(tampilWaktu, 1000);
    </script>

    <script type="text/javascript"> 
      const backToTop = document.getElementById("backToTop");
      
      window.addEventListener("scroll", function () {
       	if (window.scrollY > 300) {
          backToTop.classList.remove("d-none");
          backToTop.classList.add("d-block");
        } else {
          backToTop.classList.remove("d-block");
          backToTop.classList.add("d-none");
        }
      });

      backToTop.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
      });
    </script>
    <script>
      const btnDark = document.getElementById("btnDark");
      const btnLight = document.getElementById("btnLight");

      btnDark.addEventListener("click", () => {
        document.body.classList.add("dark-mode");
      });

      btnLight.addEventListener("click", () => {
        document.body.classList.remove("dark-mode");
      });
    </script>
  </body>
</html>
