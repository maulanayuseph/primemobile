<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--

Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
Tip 2: you can also add an image using data-image tag

-->
<div class="sidebar" data-color="red" data-image="assets/img/sidebar-5.jpg">
  <div class="sidebar-wrapper">
    <div class="logo">
      <a href="http://www.bintangsekolah.co.id" class="simple-text">
          Bintang Sekolah
      </a>
    </div>

    <ul class="nav">
        <li>
          <a href="dashboard.html">
              <i class="pe-7s-graph"></i>
              <p>Mata Pelajaran</p>
          </a>
        </li>

        <li class="sidebar-header">
          <span class="sidebar-header-title">Materi</span>
        </li>
        <li class="active">
          <a href="typography.html">
              <i class="pe-7s-news-paper"></i>
              <p>Materi</p>
          </a>
          <ul class="sub-nav">
            <li>
              <a href="typography.html">
                <p>Semua Materi</p>
              </a>
            </li>
            <li>
              <a href="typography.html">
                <p>Tambah Baru</p>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="typography.html">
              <i class="pe-7s-news-paper"></i>
              <p>Kategori</p>
          </a>
          <ul class="sub-nav">
            <li>
              <a href="typography.html">
                <p>Semua Kategori</p>
              </a>
            </li>
            <li>
              <a href="typography.html">
                <p>Tambah Baru</p>
              </a>
            </li>
          </ul>
        </li>

        <li>
          <a href="typography.html">
              <i class="pe-7s-news-paper"></i>
              <p>Latihan Soal</p>
          </a>
        </li>
        <li>
          <a href="table.html">
              <i class="pe-7s-note2"></i>
              <p>Kelas</p>
          </a>
        </li>
        <li>
          <a href="user.html">
              <i class="pe-7s-user"></i>
              <p>Siswa</p>
          </a>
        </li>
    </ul>
  </div>
</div>