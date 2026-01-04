<!DOCTYPE html>
<html>
<head>
    <title>Edit Donasi</title>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, Helvetica, sans-serif; background:#f7f7f7; }
        .form-container { max-width:640px; margin:40px auto; background:#fff; padding:20px 24px; border-radius:8px; box-shadow:0 6px 18px rgba(0,0,0,0.06); }
        h2 { text-align:center; margin-top:0 }
        .field { margin-bottom:12px }
        .field input[type="text"], .field input[type="number"], .field textarea, .field input[type="file"] { width:100%; padding:8px 10px; border:1px solid #ddd; border-radius:4px; box-sizing:border-box }
        .actions { text-align:center; margin-top:14px }
        .btn { background:#3478f6; color:#fff; padding:8px 14px; border:none; border-radius:4px; cursor:pointer }
        .btn.secondary { background:#f3f3f3; color:#333; margin-left:8px }
        .errors { background:#ffe9e9; border:1px solid #f1c0c0; padding:10px; margin-bottom:12px; border-radius:4px }
        .errors ul { margin:0; padding-left:18px }
        label { font-weight:600; display:block; margin-bottom:6px }
        img.preview { display:block; margin-top:8px; border-radius:4px }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Edit Donasi</h2>

        @if ($errors->any())
            <div class="errors">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/donasi/{{ $donasi->id }}/update" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label for="nama_donatur">Nama Donatur</label>
                <input type="text" id="nama_donatur" name="nama_donatur" value="{{ old('nama_donatur', $donasi->nama_donatur) }}" required maxlength="255">
            </div>

            <div class="field">
                <label for="jenis_donasi">Jenis Donasi</label>
                <input type="text" id="jenis_donasi" name="jenis_donasi" value="{{ old('jenis_donasi', $donasi->jenis_donasi) }}" required maxlength="255">
            </div>

            <div class="field">
                <label for="jumlah">Jumlah </label>
                <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $donasi->jumlah) }}" required min="0">
            </div>

            <div class="field">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $donasi->deskripsi) }}</textarea>
            </div>

            <div class="field">
                <label>Gambar Saat Ini</label>
                @if($donasi->gambar)
                    <img src="/images/{{ $donasi->gambar }}" width="160" class="preview">
                @else
                    <div style="color:#666">(Tidak ada gambar)</div>
                @endif
            </div>

            <div class="field">
                <label for="gambar">Ganti Gambar (opsional)</label>
                <input type="file" id="gambar" name="gambar">
            </div>

            <div class="actions">
                <button type="submit" class="btn">Simpan Perubahan</button>
                <a href="/" class="btn secondary">← Batal</a>
            </div>

        </form>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fields = [
            {id: 'nama_donatur', message: 'Nama Donatur wajib diisi.'},
            {id: 'jenis_donasi', message: 'Jenis Donasi wajib diisi.'},
            {id: 'jumlah', message: 'Jumlah wajib diisi dan harus berupa angka.'},
            {id: 'deskripsi', message: 'Deskripsi wajib diisi.'},
            {id: 'gambar', message: 'Silakan unggah gambar jika ingin mengganti.'}
        ];

        fields.forEach(function(f) {
            const el = document.getElementById(f.id);
            if (!el) return;
            el.addEventListener('input', function() { el.setCustomValidity(''); });
            el.addEventListener('change', function() { el.setCustomValidity(''); });
            el.addEventListener('invalid', function() {
                const isEmptyFile = el.type === 'file' && el.files && el.files.length === 0;
                if (el.validity.valueMissing || isEmptyFile) {
                    el.setCustomValidity(f.message);
                } else if (el.validity.badInput) {
                    if (el.type === 'number') {
                        el.setCustomValidity('Jumlah harus berupa angka.');
                    } else {
                        el.setCustomValidity(f.message);
                    }
                } else {
                    el.setCustomValidity('');
                }
            });
        });
    });
    </script>

</body>
</html>
