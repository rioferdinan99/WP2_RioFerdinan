<div class="container">
 <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mxauto">
 <div class="card-body p-0">
 <!-- Nested Row within Card Body -->
 <div class="row">
 <div class="col-lg">
 <div class="p-5">
 <div class="text-center">
 <h1 class="h4 text-gray-900 mb4">Daftar Menjadi Member!</h1>
 </div>
 <form class="user" method="post"
action="<?= base_url('autentifikasi/registrasi'); ?>">
 <div class="form-group">
 <input type="text" class="formcontrol form-control-user" id="nama" name="nama" placeholder="Nama
Lengkap" value="<?= set_value('nama'); ?>">
 <?= form_error('nama', '<small
class="text-danger pl-3">', '</small>'); ?>
 </div>
 <div class="form-group">
 <input type="text" class="formcontrol form-control-user" id="email" name="email"
placeholder="Alamat Email" value="<?= set_value('email'); ?>">
 <?= form_error('email', '<small
class="text-danger pl-3">', '</small>'); ?>
 </div>
 <div class="form-group row">
 <div class="col-sm-6 mb-3 mb-sm0">
 <input type="password"
class="form-control form-control-user" id="password1"
name="password1" placeholder="Password">
 <?= form_error('password1',
'<small class="text-danger pl-3">', '</small>'); ?>
 </div>
 <div class="col-sm-6">
 <input type="password"
class="form-control form-control-user" id="password2"
name="password2" placeholder="Ulangi Password">
<?= form_error('password2',
'<small class="text-danger pl-3">', '</small>'); ?>
 </div>
 </div>
<button type="submit" class="btn btnprimary btn-user btn-block">
 Daftar Menjadi Member
 </button>
 </form>
 <hr>
 <div class="text-center">
 <a class="small" href="<?=
base_url('autentifikasi/lupaPassword'); ?>">Lupa Password?</a>
 </div>
 <div class="text-center">
 Sudah Menjadi Member?<a class="small"
href="<?= base_url('autentifikasi'); ?>"> Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

public function registrasi()
 {
 if ($this->session->userdata('email')) {
 redirect('user');
 }
 //membuat rule untuk inputan nama agar tidak boleh kosong
dengan membuat pesan error dengan
 //bahasa sendiri yaitu 'Nama Belum diisi'
 $this->form_validation->set_rules('nama', 'Nama Lengkap',
'required', [
 'required' => 'Nama Belum diis!!'
 ]);
 //membuat rule untuk inputan email agar tidak boleh kosong,
tidak ada spasi, format email harus valid
 //dan email belum pernah dipakai sama user lain dengan
membuat pesan error dengan bahasa sendiri
 //yaitu jika format email tidak benar maka pesannya 'Email
Tidak Benar!!'. jika email belum diisi,
 //maka pesannya adalah 'Email Belum diisi', dan jika email
yang diinput sudah dipakai user lain,
 //maka pesannya 'Email Sudah dipakai'
 $this->form_validation->set_rules('email', 'Alamat Email',
'required|trim|valid_email|is_unique[user.email]', [
 'valid_email' => 'Email Tidak Benar!!',
 'required' => 'Email Belum diisi!!',
 'is_unique' => 'Email Sudah Terdaftar!'
 ]);
 //membuat rule untuk inputan password agar tidak boleh
kosong, tidak ada spasi, tidak boleh kurang dari
 //dari 3 digit, dan password harus sama dengan repeat
password dengan membuat pesan error dengan
 //bahasa sendiri yaitu jika password dan repeat password
tidak diinput sama, maka pesannya
 //'Password Tidak Sama'. jika password diisi kurang dari 3
digit, maka pesannya adalah
 //'Password Terlalu Pendek'.
 $this->form_validation->set_rules('password1', 'Password',
'required|trim|min_length[3]|matches[password2]', [
 'matches' => 'Password Tidak Sama!!',
 'min_length' => 'Password Terlalu Pendek'
 ]);
 $this->form_validation->set_rules('password2', 'Repeat
Password', 'required|trim|matches[password1]');
 //jika jida disubmit kemudian validasi form diatas tidak
berjalan, maka akan tetap berada di
 //tampilan registrasi. tapi jika disubmit kemudian validasi
form diatas berjalan, maka data yang
 //diinput akan disimpan ke dalam tabel user
 if ($this->form_validation->run() == false) {
 $data['judul'] = 'Registrasi Member';
 $this->load->view('templates/aute_header', $data);
 $this->load->view('autentifikasi/registrasi');
 $this->load->view('templates/aute_footer');
 } else {
    $email = $this->input->post('email', true);
 $data = [
 'nama' => htmlspecialchars($this->input-
>post('nama', true)),
 'email' => htmlspecialchars($email),
 'image' => 'default.jpg',
 'password' => password_hash($this->input-
>post('password1'), PASSWORD_DEFAULT),
 'role_id' => 2,
 'is_active' => 0,
 'tanggal_input' => time()
 ];
 $this->ModelUser->simpanData($data); //menggunakan model

 $this->session->set_flashdata('pesan', '<div
class="alert alert-success alert-message" role="alert">Selamat!!
akun member anda sudah dibuat. Silahkan Aktivasi Akun anda</div>');
 redirect('autentifikasi');
 }
 }

