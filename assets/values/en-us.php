<?php
  $values = [
    'home' => 'Home',
    'about_us' => 'About Us',
    'cost' => 'Tarif',
    'contact' => 'Kontak',
    'start' => 'Mulai',
    'home_p' => 'Unlimited internet solution without limits.',
    'featured_service_h1' => 'Stable Network',
    'featured_service_p1' => 'Very suitable for those of you who like playing games or live streaming',
    'featured_service_h2' => 'Affordable Rates',
    'featured_service_p2' => 'The rates we set are very friendly. Monthly rates start from IDR 200,000 and speeds up to 20mbps.',
    'featured_service_h3' => 'Free Maintenance',
    'featured_service_p3' => 'We will repair any damage without any charge.',
    'featured_service_h4' => 'Free Installation Fee',
    'featured_service_p4' => 'Our installation fee is free as long as the applicable terms and conditions are met.',
    'about_us_p' => '<b>PT Azkyal Network Madina</b> is engaged in the field of internet service providers. We strive to provide quality internet services and will continue to update according to the development of the digital era.',
    'our_superiority' => 'Our Advantages',
    'our_superiority_p' => 'We always prioritize customer comfort.',
    'our_superiority_1' => 'Quick installation',
    'our_superiority_2' => 'Repairs will be expedited',
    'our_superiority_3' => 'Free repair and replacement of tools',
    'our_superiority_p2' => 'Don\'t hesitate to join us!',
    'private_user' => 'Private customer',
    'ap_voucher' => 'AP Voucher',
    'admin_support' => 'Admin Support',
    'number_of_technicians' => 'Number of Technicians',
    'monthly_prices_h' => 'Tarif Bulanan',
    'monthly_prices_p' => 'The rates we set are very friendly and suitable even if you are still a student.',
    'idr_cost' => 'IDR :cost',
    'start_subscribe' => 'Start Subscription',
    'package_benefit_1' => 'Stable price',
    'package_benefit_2' => 'Unlimited quota',
    'package_benefit_3' => 'Speed up to :speedmbps',
    'package_benefit_4' => 'Ideal for :device-count devices',
    'package_benefit_5' => 'Tools are loaned',
    'package_benefit_6' => 'Free installation fee (terms and conditions apply)',
    'package_benefit_7' => 'Smart tv is supported',
    'contact_p' => 'If there is anything unclear and you want to ask, please contact us.',
    'address' => 'Address',
    'contact_us' => 'Our Contacts',
    'email_us' => 'Our Email',
    'additional_services' => 'Other Services',
    'additional_services_p' => 'We also provide other services that may interest you.',
    'cctv_installation' => 'CCTV Installation',
    'cctv_installation_p' => 'We provide CCTV installation services with rates starting from IDR 200,000 per point (costs excluding devices).',
    'wifi_voucher' => 'WiFi Voucher',
    'wifi_voucher_p' => 'You can be our wifi voucher reseller. Free installation fee for our wifi voucher access point with applicable terms and conditions. And will get 1 free voucher account. You will also get a fee as a reseller.',
    'affiliated_with' => 'Affiliated With',
    'gallery' => 'Gallery',
    'all' => 'All',
    'why_us' => 'Why Us?',
    'about_us_p2' => 'PT Azkyal Network Madina is the first and only local company engaged in the internet service provider sector in Mandailing Natal district.',
    'about_us_p3' => 'PT Azkyal Network Madina in running its business is supported by qualified human resources who are experienced in their fields, so you don\'t need to worry about our services.',
    'about_us_p4' => 'We are confident that with our high resources we can produce good quality work and service as expected.',
    'about_us_p5' => 'Our goal is to be the first choice for our business partners by contributing to each of our clients, exceeding their expectations, through our exceptional service with professionalism and full integrity.',
    'vision' => 'Visions',
    'vision_1' => 'Providing internet solutions to remote villages in Mandailing Natal district',
    'vision_2' => 'The realization of an internet network to support the development of digital technology in all corners of the villages of Mandailing Natal district',
    'mission' => 'Missions',
    'mission_1' => 'Providing new standards of quality internet services',
    'mission_2' => 'Providing products that distribute the internet easily, thereby accelerating the distribution of the internet to all corners of the villages in Mandailing Natal district.',
    'mission_3' => 'Providing access to digital technology information for the people of Mandailing Natal Regency',
    'history' => 'History',
    'history_p' => 'This is the result of our achievements from year to year. Without giving up providing internet access solutions to remote villages in Mandailing Natal district.',
    'history_2010_p' => 'We started our business from an internet cafe that was established in 2010 in Mandailing Natal district. The internet cafe has been developed into 3 branches.',
    'history_2019_p' => 'Starting from the roots as RTRWnet. In 2019, Azkyal obtained an internet distribution permit from Provider JINOM (PT. Jinom Network Indonesia) and is committed to obtaining an ISP permit so that the business can grow.',
    'history_2022_p' => 'Azkyal is licensed as an ISP and focuses on helping RTRWnet obtain permission to resell the internet until it develops into a reseller in Indonesia.',
    'history_2023_p' => 'Now, Azkyal is committed to internet marketing and sales to become the first local company in Mandailing Natal district to provide a list of internet products from various internet service providers.',
    'vission_mission' => 'Visions & Missions',
    'others' => 'Others',
    'electrical_system_repair' => 'Electrical System Maintenance',
    'electrical_system_repair_p' => 'We provide repair or installation services for electrical systems in your home. For installation, a rate of IDR 150,000 per point is charged. Rates are negotiable.',
    'build_web' => 'Web Creation',
    'build_web_p' => 'We provide web development services. Rates for this service are negotiable.'
  ];
  $gallery_db_path = '../img/gallery/gallery.json';
  if(is_file($gallery_db_path)){
    $gallery_db = json_decode(file_get_contents($gallery_db_path), true);
    $values['gallery_items'] = [];
    foreach($gallery_db as $album => $content){
      $pictures = [];
      if(isset($content['pictures'])){
        foreach($content['pictures'] as $filename => $picture){
          $pictures[$filename] = [
            'title' => $picture['title']['en-us'],
            'description' => $picture['description']['en-us']
          ];
        }
      }
      $values['gallery_items'][$album] = [
        'label' => $content['labels']['en-us'],
        'pictures' => $pictures
      ];
    }
  }
?>
VALUES['en-us'] = JSON.parse('<?=str_replace("'", "\\'", json_encode($values))?>');