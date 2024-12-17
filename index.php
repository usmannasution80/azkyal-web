<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title config="brand"></title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link href="/assets/img/logo.png" rel="shortcut icon">
  <link href="/assets/img/logo.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/main2.css" rel="stylesheet"/>
  <script>
    const VALUES = {};
  </script>
  <script src="/assets/values/id.php"></script>
  <script src="/assets/values/en-us.php"></script>
  <script src="/config.js"></script>
  <script src="/assets/js/set_values.js"></script>
  <script src="/assets/js/config_helper.js"></script>

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/index.html" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">
          <img src="./assets/img/logo.png" width="40px"/>
        </h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active" val="home"></a></li>
          <li><a href="#about" val="about_us"></a></li>
          <li><a href="about-us.html" val="why_us"></a></li>
          <li><a href="#services" val="start_subscribe"></a></li>
          <li><a href="#contact" val="contact"></a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div
        class="dropdown btn-getstarted rounded p-0"
        id="change-language-dropdown">
        <button
          type="button"
          class="btn dropdown-toggle dropdown-toggle-split"
          data-bs-toggle="dropdown"
          aria-expanded="false">
          <img src="./assets/img/lang/id.png" width="27px"/>
        </button>
        <ul class="dropdown-menu"></ul>
      </div>
      <script>
        let changeLanguage;
        const refreshChangeLanguageButton = () => {
          let currentLang = localStorage.getItem('lang') || 'id';
          document
            .querySelector('#change-language-dropdown img')
            .src = `./assets/img/lang/${currentLang}.png`;
          let languages = {
            'id' : 'Bahasa Indonesia',
            'en-us' : 'English (US)'
          };
          let listElement = '';
          for(let code in languages){
            listElement += `<li>
              <button
                class="dropdown-item"
                onclick="changeLanguage('${code}')">
                <img
                  src="./assets/img/lang/${code}.png"
                  width="27px"/>
                <span
                  class="${code === currentLang ? 'text-success' : ''}">
                  ${languages[code]}
                </span>
              </button>
            </li>`;
          }
          document.querySelector('#change-language-dropdown .dropdown-menu').innerHTML = listElement;
        };
        refreshChangeLanguageButton();
        changeLanguage = lang => {
          localStorage.setItem('lang', lang);
          setValues();
          refreshChangeLanguageButton();
        };
      </script>

    </div>
  </header>

  <main class="main">

    <section id="hero" class="hero section">

      <div class="container" style="min-height:100vh">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
            <h1 style="font-size: 25px" config="brand"></h1>
            <p><span val="home_p"/></p>
            <div class="d-flex">
              <a href="#about" class="btn-get-started" val="start"></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section>

    <section id="featured-services" class="featured-services section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative w-100">
              <div class="icon"><i class="bi bi-router"></i></div>
              <h4><span class="stretched-link" val="featured_service_h1"></span></h4>
              <p val="featured_service_p1"></p>
            </div>
          </div>

          <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative w-100">
              <div class="icon"><i class="bi bi-cash-coin"></i></div>
              <h4><span class="stretched-link" val="featured_service_h2"></span></h4>
              <p val="featured_service_p2"></span></p>
            </div>
          </div>

          <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative w-100">
              <div class="icon"><i class="bi bi-tools"></i></div>
              <h4><span class="stretched-link" val="featured_service_h3"></span></h4>
              <p val="featured_service_p3"></p>
            </div>
          </div>

          <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative w-100">
              <div class="icon"><i class="bi bi-currency-dollar"></i></div>
              <h4><span class="stretched-link" val="featured_service_h4"></span></h4>
              <p val="featured_service_p4"></p>
            </div>
          </div>

        </div>

      </div>

    </section>

    <section id="about" class="about section">


      <div class="container section-title" data-aos="fade-up">
        <span val="about_us"></span>
        <h2 val="about_us"></h2>
        <p val="about_us_p"></p>
      </div>

      <div class="container">

        <div class="row gy-4"></div>
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
            <h3 val="our_superiority"></h3>
            <p class="fst-italic" val="our_superiority_p"></p>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span val="our_superiority_1"></span></li>
              <li><i class="bi bi-check2-all"></i> <span val="our_superiority_2"></span></li>
              <li><i class="bi bi-check2-all"></i> <span val="our_superiority_3"></span></li>
            </ul>
            <p val="our_superiority_p2"></p>
          </div>
        </div>

      </div>

    </section>

    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="103" data-purecounter-duration="1" class="purecounter"></span>
              <p val="private_user"></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p val="ap_voucher"></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
              <p val="admin_support"></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="4" data-purecounter-duration="1" class="purecounter"></span>
              <p val="number_of_technicians"></p>
            </div>
          </div>

        </div>

      </div>

    </section>

    <section id="services" class="services section light-background">

      <div class="container section-title" data-aos="fade-up">
        <span val="monthly_prices_h"></span>
        <h2 val="monthly_prices_h"></h2>
        <p val="monthly_prices_p"></p>
      </div>

      <div class="container">
        <div class="row" id="rates"></div>
      </div>
      <script>
        (() => {
          let rates_list = [
            {
              pack     : 'Bronze',
              rates    : '200.000',
              maxSpeed : '5',
              devices  : '4'
            },
            {
              pack     : 'Silver',
              rates    : '300.000',
              maxSpeed : '10',
              devices  : '8'
            },
            {
              pack     : 'Gold',
              rates    : '450.000',
              maxSpeed : '20',
              devices  : '15'
            }
          ];
          let ratesElement = document.getElementById('rates');
          ratesElementContent = '';
          let waLink = (pack, rates) => {
            let opening = '';
            let hours = new Date().getHours();
            if(hours >= 6 && hours < 11)
              opening = 'Selamat pagi';
            else if(hours >= 11 && hours < 16)
              opening = 'Selamat siang';
            else if(hours >= 16 && hours < 19)
              opening = 'Selamat sore';
            else
              opening = 'Selamat malam';
            return 'https://wa.me/send?phone=6281360449422&text=' + opening + '. Saya ingin berlangganan paket ' + pack + ' dengan tarif Rp. ' + rates + ' per bulan.';
          }
          for(let rates of rates_list){
            ratesElementContent += `
            <div class="col-12 col-lg-4 pt-5 text-center" data-aos="fade-up">
              <div class="card border-0 shadow mb-5 mt-5 d-inline-block text-start">
                <div
                  class="card-header-rates"
                  style="background:url('/assets/img/background/${rates.pack.toLowerCase()}.jpg')">
                  <h5 class="text-dark fw-bold">
                    ${rates.pack}
                  </h5>
                  <div class="bg-primary rounded">
                    <h3 class="text-light">
                      ${rates.maxSpeed}<br/>
                      mbps
                    </h3>
                  </div>
                </div>
                <div class="card-body">
                  <h2 class="text-success" style="font-size:50px"><span val="idr_cost" val-cost="${rates.rates}"></span></h2>
                  <h1 style="font-size:20px">per bulan</h1>
                  <table border="0">
                    ${(() => {
                      let listBenefit = '';
                      for(let i=1;i<=7;i++){
                        if(rates.pack === 'Bronze' && i ===7)
                          continue;
                        listBenefit += `<tr>
                          <td style="vertical-align:top">
                            <i class="bi bi-check-circle text-success"></i>
                          </td>
                          <td
                            style="padding-left:10px"
                            val="package_benefit_${i}"
                            val-speed="${rates.maxSpeed}"
                            val-device-count="${rates.devices}"></td>
                        </tr>`;
                      }
                      return listBenefit;
                    })()}
                  </table>
                  <a
                    href="${waLink(rates.pack, rates.rates)}"
                    class="btn btn-outline-success btn-lg rounded-pill"
                    val="start_subscribe"></a>
                </div>
              </div>
            </div>
            `;
          }
          ratesElement.innerHTML = ratesElementContent;
        })();
        setValues();
      </script>

    </section>


    <section id="services" class="services section light-background">

      <div class="container section-title" data-aos="fade-up">
        <span val="additional_services"></span>
        <h2 val="additional_services"></h2>
        <p val="additional_services_p"></p>
      </div>

      <div class="container">

        <div class="row gy-4" id="other-services-row"></div>

        <script>
          (() => {
            const otherServices = [
              {
                icon : 'bi bi-router',
                headerVal : 'wifi_voucher',
                pVal : 'wifi_voucher_p'
              },
              {
                icon : 'bi bi-webcam',
                headerVal : 'cctv_installation',
                pVal : 'cctv_installation_p'
              },
              {
                icon : 'bi bi-lightning-fill',
                headerVal : 'electrical_system_repair',
                pVal : 'electrical_system_repair_p'
              },
              {
                icon : 'bi bi-browser-chrome',
                headerVal : 'build_web',
                pVal : 'build_web_p'
              }
            ];
            let otherServicesContent = '';
            for(let otherService of otherServices){
              otherServicesContent += `<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-item position-relative">
                  <div class="icon">
                    <i class="${otherService.icon}"></i>
                  </div>
                  <span class="stretched-link">
                    <h3 val="${otherService.headerVal}"></h3>
                  </span>
                  <p val="${otherService.pVal}"></p>
                </div>
              </div>`;
            }
            document.getElementById('other-services-row').innerHTML = otherServicesContent;
            setValues();
          })();
        </script>
        

      </div>

    </section>

    <section id="contact" class="contact section">

      <div class="container section-title" data-aos="fade-up">
        <span val="contact"></span>
        <h2 val="contact"></h2>
        <p val="contact_p"></p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center">

          <div class="col-lg-5">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3 val="address"></h3>
                  <p config="office_address"></p>
                </div>
              </div>

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3 val="contact_us"></h3></h3>
                  <p config="admin_phone"></p>
                </div>
              </div>

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3 val="email_us"></h3>
                  <p config="offcie_email"></p>
                </div>
              </div>

              <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAeFW-f_ri8BRC1CKV4IAwT5-Ymp1jNhr8&q=PT AZKYAL NETWORK MADINA, Jl. Syekh Abdul Kadir Mandili, Panyabungan III, Kec. Panyabungan, Kabupaten Mandailing Natal, Sumatera Utara 22976" frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

        </div>

      </div>

    </section>
    <section id="affiliated-with">
      <div class="container section-title" data-aos="fade-up">
        <span val="affiliated_with"></span>
        <h2 val="affiliated_with"></h2>
      </div>
      <div data-aos="fade-up">
        <img src="/assets/img/kominfo.png"/>
        <img src="/assets/img/apjii.png"/>
        <img src="/assets/img/lintasarta.png"/>
      </div>

    </section>

    <section id="portfolio" class="portfolio section">

      <div class="container section-title" data-aos="fade-up">
        <span val="gallery"></span>
        <h2 val="gallery"></h2>
      </div>

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active" val="all"></li>
            <?php
              $gallery_path = 'assets/img/gallery/';
              $gallery = [];
              $isOther = false;
              foreach(scandir($gallery_path) as $album){
                if($album === 'others'){
                  $isOther = true;
                  continue;
                }
                if($album === '.' || $album === '..' || is_file($gallery_path . $album))
                  continue;
                $gallery [] = $album;
            ?>
            <li data-filter=".filter-<?=$album?>" val="gallery_items.<?=$album?>.label"></li>
            <?php
              }
              if($isOther){
            ?>
            <li data-filter=".filter-others" val="gallery_items.others.label"></li>
            <?php } ?>
          </ul>

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200" id="gallery-items-container">
            <?php
              if($isOther)
                $gallery[] = 'others';
              foreach($gallery as $album){
                foreach(scandir($gallery_path . $album) as $picture){
                  if($picture === '.' || $picture === '..')
                    continue;
                  $picture_path = "/$gallery_path$album/$picture";
                  $val = "gallery_items.$album.pictures." . str_replace('.', '\\.', $picture);
            ?>
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-<?=$album?>">
              <img src="<?=$picture_path?>" class="img-fluid" alt=""/>
              <div class="portfolio-info">
                <h4 val="<?="$val.title"?>"></h4>
                <p val="<?="$val.description"?>"></p>
                <a href="<?=$picture_path?>" title="<?=$picture?>" data-gallery="portfolio-gallery-<?=$album?>" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
            <?php }} ?>
          </div>

        </div>

      </div>

    </section>

  </main>

  <footer id="footer" class="footer">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">PT. Azkyal Network Madina</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a><br/>
        Developed by <a href="https://github.com/usmannasution80">Usman Nasution</a>
      </div>
    </div>

  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <script src="assets/js/main.js"></script>
  <script>
    setValues();
    setConfigs();
  </script>
</body>

</html>