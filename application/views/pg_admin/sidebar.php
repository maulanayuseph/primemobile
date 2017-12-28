<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--

Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
Tip 2: you can also add an image using data-image tag

-->
<?php
  //read uri segment to determine CSS active link
  $active = $this->uri->segment(2);
  $tambah = $this->uri->segment(4);
?>

<div class="sidebar" data-color="red" data-image="">
  <div class="sidebar-wrapper">
    <div class="logo">
      <a href="http://www.primemobile.co.id" class="simple-text">
          Prime Generation
      </a>
    </div>

    <ul class="nav">
    
        <li class="<?php echo ($active=='dashboard' ? 'active' : '')?>">
          <a href="<?php echo base_url('pg_admin/dashboard'); ?>">
              <i class="pe-7s-display1"></i>
              <p>Dashboard</p>
          </a>
        </li>
      <?php
      if($this->session->userdata('level') !== "qc"){
        ?>
          <?php
          $this->load->view("pg_admin/sidebar_manajemen");
          ?>
      <li class="<?php echo ($active=='kelas' ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-notebook"></i>
                <p>Rekapitulasi <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo site_url('pg_admin/rekap')?>">Rekapitulasi Konten</a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/rekap/soal_kolektif')?>">Download Soal Kolektif</a>
              </li>
            </ul>
          </li>
      
      <?php
        if($this->session->userdata('level') !== "adminqc"){
      ?>
      <li class="<?php echo ($active=='dashboard' ? 'active' : '')?>">
        <a href="<?php echo base_url('pg_admin/kurikulum'); ?>">
            <i class="pe-7s-display1"></i>
            <p>Kurikulum</p>
        </a>
      </li>
      <?php
        }
      ?>
      
      <?php
        if($this->session->userdata('level') == "adminqc" or $this->session->userdata('level') == "editor" or $this->session->userdata('level') == "administrator"){
          ?>
          <li>
            <a href="<?php echo base_url('pg_admin/quality'); ?>">
              <i class="pe-7s-display1"></i>
              <p>Quality Control</p>
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('pg_admin/materi')?>">
              <i class="pe-7s-display1"></i>
              <p>Semua Materi</p>
            </a>
          </li>
          <li>
                    <a href="<?php echo site_url('pg_admin/atribut')?>">
                        <i class="pe-7s-display1"></i>
                        <p>Atribut</p>
                    </a>
                  </li>
          <li>
            <a href="<?php echo base_url('pg_admin/materi/rekap_bobot'); ?>">
              <i class="pe-7s-display1"></i>
              <p>Rekapitulasi Bobot</p>
            </a>
          </li>
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="pe-7s-notebook"></i>
              <p>Migrasi <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
            <li>
              <a href="<?php echo site_url('pg_admin/migrasi/pindah')?>">Pindah Soal</a>
            </li>
            <li>
              <a href="<?php echo site_url('pg_admin/migrasi/duplikat')?>">Duplikat Soal</a>
            </li>
            <li>
              <a href="<?php echo site_url('pg_admin/migrasi/duplikat_bab')?>">Duplikat Bab</a>
            </li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url('pg_admin/rekap_penulis'); ?>">
              <i class="pe-7s-display1"></i>
              <p>Rekap Penulis</p>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('pg_admin/error_duplikasi'); ?>">
              <i class="pe-7s-display1"></i>
              <p>* Cek Error Duplikasi</p>
            </a>
          </li>
          <li class="<?php echo ($active=='tryout' ? 'active' : '')?>">
              <a href="<?php echo site_url('pg_admin/tryout') ?>">
                  <i class="pe-7s-note2"></i>
                  <p>Try Out</p>
              </a>
            </li>

            <li class="sidebar-header"><span>Manajemen Bank Soal</span></li>
            <li>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><p>Manajemen Bank Soal <b class="caret"></b></p>
              </a>
              <ul class="dropdown-menu sub-nav">
                <li>
                  <a href="<?php echo site_url('pg_admin/banksoal')?>">Bank Soal</a>
                </li>
                <li>
                  <a href="<?php echo site_url('pg_admin/banksoal/qc')?>">Quality Control</a>
                </li>
              </ul>
            </li>
          <?php
        }
      ?>
      
      <?php
        if($this->session->userdata('level') !== "adminqc"){
      ?>
          <li class="sidebar-header"><span>Materi</span></li>
      <!-- menu kelas -->
      <!-- hanya bisa diakses superadmin dan admin -->
      <!-- ############################-->
      <?php
        if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
      ?>
          <li class="<?php echo ($active=='kelas' ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-notebook"></i>
                <p>Kelas <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo site_url('pg_admin/kelas')?>">Semua Kelas</a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/kelas/manajemen/tambah')?>">Tambah Baru</a>
              </li>
            </ul>
          </li>
      <?php
        }
      ?>
      <!-- end menu kelas -->
      <!--############################-->
      
      <!-- menu mata pelajaran -->
      <!-- hanya bisa diakses superadmin dan admin -->
      <!-- ############################-->
      <?php
        if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
      ?>
          <li class="<?php echo ($active=='mapel' ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-notebook"></i>
                <p>Mata Pelajaran <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo site_url('pg_admin/mapel')?>">Semua Mata Pelajaran</a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/mapel/manajemen/tambah')?>">Tambah Baru</a>
              </li>
            </ul>
          </li>
      <?php
        }
      ?>
      <!-- end menu mata pelajaran -->
      <!-- ############################-->
      
      
          <li class="<?php echo ($active=='materi_pokok' ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-notebook"></i>
                <p>Materi Pokok <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo site_url('pg_admin/materi_pokok')?>">Semua Materi Pokok</a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/materi_pokok/manajemen/tambah')?>">Tambah Baru</a>
              </li>
            </ul>
          </li>

          <li class="<?php echo ($active=='materi' ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-notebook"></i>
                <p>Konten Materi <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo site_url('pg_admin/materi')?>">
                  Semua Materi
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/materi/manajemen/tambah')?>">
                  Tambah Baru
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/set_latihan')?>">
                  Set Latihan Soal
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/atribut')?>">
                  Atribut
                </a>
              </li>
        <li>
                <a href="<?php echo site_url('pg_admin/materi/poin')?>">
                  Poin Materi
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/materi/manajemen/tambah-bulk')?>">
                  Tambah Materi Bulk
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/materi/manajemen/tambah-soal-bulk')?>">
                  Tambah Latihan Soal Bulk
                </a>
              </li>
        <li>
          <a href="<?php echo site_url('pg_admin/materi/rekap_bobot')?>">
            Rekapitulasi Pembobotan
          </a>
        </li>
            </ul>
          </li>

          <li class="sidebar-header"><span>Latihan Soal</span></li>
          
          <li class="<?php echo ($active=='latihansoal' ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-note2"></i>
                <p>Latihan Soal <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo site_url('pg_admin/latihansoal')?>">
                  Semua Soal
                </a>
              </li>
              <?php 
              $hide = true;
              if($hide == false) { ?>
              <li>
                <a href="<?php echo site_url('pg_admin/latihansoal/manajemen/tambah')?>">
                  Tambah Baru
                </a>
                <?php } ?>
              </li>
            </ul>
          </li>
          <li class="<?php echo ($active=='dashboard' ? 'active' : '')?>">
            <a href="<?php echo base_url('pg_admin/komentar'); ?>">
                <i class="pe-7s-display1"></i>
                <p>Komentar Soal</p>
            </a>
          </li>
          
      <!-- Menu Try Out -->
        <!-- Menu Try Out -->
      <li class="sidebar-header"><span>CBT</span></li>
      
      <li class="<?php echo ($active=='banksoal' ? 'active' : '')?>">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-note2"></i>
                <p>Bank Soal <b class="caret"></b></p>
            </a>
      <ul class="dropdown-menu sub-nav">
        <li class="<?php echo ($active=='banksoal/kategori' ? 'active' : '')?>">
          <a href="<?php echo site_url('pg_admin/banksoal/kategori') ?>">
            <i class="pe-7s-note2"></i>
            <p>Kategori Bank Soal</p>
          </a>
        </li>
        <li class="<?php echo ($active=='banksoal' ? 'active' : '')?>">
          <a href="<?php echo site_url('pg_admin/banksoal') ?>">
            <i class="pe-7s-note2"></i>
            <p>Manage Bank Soal</p>
          </a>
        </li>
      </ul>
      </li>
      <li class="<?php echo ($active=='tryout' ? 'active' : '')?>">
            <a href="<?php echo site_url('pg_admin/tryout') ?>">
                <i class="pe-7s-note2"></i>
                <p>Try Out</p>
            </a>
          </li>
      <li class="<?php echo ($active=='cbtpsep' ? 'active' : '')?>">
            <a href="<?php echo site_url('pg_admin/tryout/aktivasi_psep') ?>">
                <i class="pe-7s-note2"></i>
                <p>Aktivasi CBT PSEP</p>
            </a>
          </li>
      <?php
        if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
      ?>
      <li class="<?php echo ($active=='Pembayaran cbt contest' ? 'active' : '')?>">
            <a href="<?php echo site_url('pg_admin/tryout/pembayarancbt') ?>">
                <i class="pe-7s-note2"></i>
                <p>Pembayaran CBT</p>
            </a>
          </li>
      <?php
        }
      ?>
      
      <?php
        if($this->session->userdata('level') == "superadmin"){
      ?>
      <li class="<?php echo ($active=='analisis' ? 'active' : '')?>">
            <a href="<?php echo site_url('pg_admin/analisis') ?>">
                <i class="pe-7s-note2"></i>
                <p>Pencapaian Siswa</p>
            </a>
          </li>
      <?php
        }
      ?>
          <!-- END MENU TRY OUT -->
          
           <!-- menu agcu test -->
          <li class="sidebar-header"><span>AGCU Test</span></li>
      <li class="<?php echo ($active=='diagnostictest' ? 'active' : '')?>">
            <a href="<?php echo site_url('pg_admin/diagnostictest') ?>">
                <i class="pe-7s-note2"></i>
                <p>Diagnostic Test</p>
            </a>
          </li>
      <!-- end menu agcu test -->
      
      <?php
        if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
      ?>
          <li class="sidebar-header"><span>Siswa</span></li>
          <li class="<?php echo ((($active=='siswa' && $tambah=='tambah') OR ($active=='log')) ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-id"></i>
                <p>Pendaftaran <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo site_url('pg_admin/siswa/manajemen/tambah')?>">Tambah Pendaftar</a>
              </li>
            </ul>
          </li>
          <li class="<?php echo (($active=='siswa' && $tambah!='tambah') ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-id"></i>
                <p>Siswa <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <?php 
              $hide2 = true;
              if($hide2 == false) { ?>
              <li>
                <a href="<?php echo site_url('pg_admin/siswa')?>">Semua Siswa</a>
              </li>
              <?php } ?>
              <li>
                <a href="<?php echo site_url('pg_admin/siswa/pendaftar')?>">Pendaftar</a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/siswa/aktif')?>">Siswa Aktif</a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/log')?>">Log Akses</a>
              </li>
              <?php 
              if($hide2 == false) { ?>
              <li>
                <a href="<?php echo site_url('pg_admin/siswa/manajemen/tambah')?>">Tambah Baru</a>
              </li>
              <?php } ?>
            </ul>
          </li>
      <?php
        }
      ?>
      
      <?php
        if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
      ?>
          <li class="<?php echo ($active=='sekolah' ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-study"></i>
                <p>Sekolah <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo site_url('pg_admin/sekolah')?>">Semua Sekolah</a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/sekolah/manajemen/tambah')?>">Tambah Baru</a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/sekolah/manajemen/import')?>">Import Data</a>
              </li>
            </ul>
          </li>
          <?php
        }
      ?>
      
      <?php
        if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
      ?>
          <li class="sidebar-header"><span>Paket</span></li>
          <li class="<?php echo ($active=='paket' ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-credit"></i>
                <p>Paket <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo site_url('pg_admin/paket')?>">Semua Paket</a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/paket/manajemen/tambah')?>">Tambah Baru</a>
              </li>
            </ul>
          </li>
          <li class="<?php echo ($active=='pembayaran' ? 'active' : '')?>">
            <a href="<?php echo site_url('pg_admin/transaksi') ?>">
                <i class="pe-7s-cash"></i>
                <p>Pembayaran</p>
            </a>
          </li>
      
      <?php /*
      <li class="<?php echo ($active=='voucher' ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-notebook"></i>
                <p>Voucher<b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo site_url('pg_admin/voucher')?>">
                  Semua Voucher
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/voucher/manajemen/tambah')?>">
                  Tambah Voucher
                </a>
              </li>
            </ul>
          </li>
          */ ?>
           
          <?php
        }
      ?>
      
          <!-- tambahan menu reward & bonus -->
      <!-- ############################ -->
      <!-- ############################ -->
      <?php
        if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
      ?>
      <li class="sidebar-header"><span>Rewards & Quotes</span></li>
      <li class="<?php echo ($active=='poin' ? 'active' : '')?>">
            <a href="<?php echo site_url('pg_admin/poin') ?>">
                <i class="pe-7s-server"></i>
                <p>Poin</p>
            </a>
          </li>
      <li class="<?php echo ($active=='bonus' ? 'active' : '')?>">
            <a href="<?php echo site_url('pg_admin/bonus') ?>">
                <i class="pe-7s-door-lock"></i>
                <p>Bonus</p>
            </a>
          </li>
      <li class="<?php echo ($active=='quote' ? 'active' : '')?>">
            <a href="<?php echo site_url('pg_admin/quote') ?>">
                <i class="pe-7s-chat"></i>
                <p>Quotes</p>
            </a>
          </li>
      <?php
        }
      ?>
      <!-- end -->
      <!-- ############################ -->
      <!-- ############################ -->
      
      <!-- tambahan menu untuk PSES dan manajemen login PSES -->
      <!-- ############################ -->
      <!-- ############################ -->
      <?php
        if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
      ?>
      <li class="sidebar-header"><span>Manajemen PSEP</span></li>
      <li class="<?php echo ($active=='Manajemen Akun PSEP' ? 'active' : '')?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="pe-7s-credit"></i>
          <p>Akun Sekolah <b class="caret"></b></p>
        </a>
        <ul class="dropdown-menu sub-nav">
        <li>
          <a href="<?php echo site_url('pg_admin/akun_psep/sekolah')?>">Semua Akun</a>
        </li>
        <li>
          <a href="<?php echo site_url('pg_admin/akun_psep/tambah_sekolah')?>">Tambah Baru</a>
        </li>
        </ul>
      </li>
      <li class="<?php echo ($active=='Manajemen Akun PSEP' ? 'active' : '')?>">
        <a href="<?php echo site_url('pg_admin/sekolah/import_siswa') ?>">
            <i class="pe-7s-chat"></i>
            <p>Import Siswa PSEP</p>
        </a>
      </li>

      <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="pe-7s-credit"></i>
          <p>Aktivasi PSEP <b class="caret"></b></p>
        </a>
        <ul class="dropdown-menu sub-nav">
          <li>
            <a href="<?php echo site_url('pg_admin/psep/pengajuan_psep') ?>">
                <i class="pe-7s-chat"></i>
                <p>Pengajuan Aktivasi PSEP</p>
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('pg_admin/sekolah/daftar_siswa') ?>">
                <i class="pe-7s-chat"></i>
                <p>Aktivasi Siswa</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="<?php echo ($active=='Manajemen Akun PSEP' ? 'active' : '')?>">
        <a href="<?php echo site_url('pg_admin/akun_psep/guru') ?>">
            <i class="pe-7s-chat"></i>
            <p>Manajemen Guru</p>
        </a>
      </li>
      <?php
        }
      ?>
      <!-- end -->
      <!-- ############################ -->
      <!-- ############################ -->
      
      <!-- tambahan menu untuk manajemen user -->
      <!-- ############################ -->
      <!-- ############################ -->
      <?php
        if($this->session->userdata('level') == "superadmin"){
      ?>
      <li class="sidebar-header"><span>Manajemen User</span></li>
      <li class="<?php echo ($active=='user' ? 'active' : '')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="pe-7s-credit"></i>
                <p>User <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo site_url('pg_admin/user')?>">Semua User</a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/user/tambah')?>">Tambah Baru</a>
              </li>
            </ul>
          </li>
      <?php
        }
        }
      ?>
      <!-- end -->
      <!-- ############################ -->
      <!-- ############################ -->
      
      <!-- menu untuk akun QC -->
      <!-- ############################ -->
      <!-- ############################ -->
      <?php
        if($this->session->userdata('level') == "adminqc"){
          ?>
          <li class="sidebar-header"><span>Manajemen User QC</span></li>
          <li>
            <a href="<?php echo site_url('pg_admin/qc_user') ?>">
                <i class="pe-7s-door-lock"></i>
                <p>Manajemen User</p>
            </a>
          </li>
          <?php
        }
      ?>
      <!-- end menu untuk akun QC -->
      <!-- ############################ -->
      <!-- ############################ -->
        <?php
      }else{
        ?>
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><p>Quality Control <b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu sub-nav">
              <li>
                <a href="<?php echo base_url('pg_admin/quality'); ?>">Latihan Soal</a>
              </li>
              <li>
                <a href="<?php echo site_url('pg_admin/banksoal/qc')?>">Bank Soal</a>
              </li>
            </ul>
          </li>
          
        <?php
      }
      ?>
        
    
    </ul>
  </div>
</div>
