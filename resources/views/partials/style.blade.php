<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

<!-- AOS -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />

<!-- Custom Styles -->
<style>
  .gallery-card {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease;
  }

  .gallery-card:hover {
    transform: translateY(-5px);
  }

  .gallery-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    display: block;
    border-radius: 12px;
  }

  .overlay-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 2;
  }

  .gallery-card:hover .overlay-button {
    opacity: 1;
  }

  .overlay-button .btn {
    padding: 12px;
    border-radius: 50%;
    background-color: #2fc3ff;
    color: white;
    border: none;
  }

  .overlay-button .btn:hover {
    background-color: #1aaed8;
  }

  .section-title h4 {
    font-size: 26px;
    font-weight: 600;
  }

  .section-title p {
    font-size: 14px;
    color: #7B8AAB;
  }

  .service-item .img {
    height: 220px;
    overflow: hidden;
    border-radius: 8px;
  }

  .service-item .img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .layanan-title {
    font-size: 28px;
    font-weight: 700;
  }

  .layanan-subtitle {
    color: #7B8AAB;
    font-size: 15px;
    margin-top: 0.5rem;
  }

  .card-info {
    border: 1px solid #2FC3FF;
    padding: 2rem;
    border-radius: 12px;
    background-color: #ffffff;
    transition: all 0.3s ease;
    min-height: 340px;
  }

  .card-info:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    border-color: #2FC3FF;
  }

  .icon-box {
    background-color: #EAF8FF;
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    margin: 0 auto 16px auto;
  }

  .icon-box svg {
    stroke: #2FC3FF;
  }

  .card-title {
    font-weight: 600;
    font-size: 16px;
  }

  .card-desc {
    color: #7B8AAB;
    font-size: 14px;
    margin-top: 12px;
  }

  .footer-light {
    background-color: #1c2230;
    color: #d1d5db;
  }

  .footer-light a {
    color: #d1d5db;
    transition: color 0.3s ease;
  }

  .footer-light a:hover {
    color: #ffffff;
    text-decoration: underline;
  }

  .footer-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    margin-right: 10px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    color: #d1d5db;
    font-size: 16px;
    transition: all 0.3s ease;
  }

  .footer-icon:hover {
    background-color: #00b4ff;
    color: #fff;
    border-color: #00b4ff;
  }

  .footer-text {
    font-size: 15px;
  }

  .footer-logo {
    font-weight: 600;
    font-size: 18px;
    margin-left: 12px;
    color: #fff;
  }

  .footer-border-top {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
  }

.navmenu a {
  text-decoration: none !important;
  color: #ffffff; /* dari sebelumnya #333 */
  border-bottom: 2px solid transparent;
  transition: 0.3s;
  padding-bottom: 4px;
}


.navmenu a:hover {
  color: #2FC3FF;
  border-bottom: 2px solid #2FC3FF;
}

.navmenu a.active {
  color: #2FC3FF !important;
  border-bottom: 2px solid #2FC3FF;
}


.navmenu .dropdown.active > a > span {
  color: #2FC3FF;
}

.navmenu a[href="#hero"].active {
  border-bottom: none !important;
  color: inherit !important;
}



</style>
