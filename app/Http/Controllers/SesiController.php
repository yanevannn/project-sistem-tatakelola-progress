<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anggota;
use App\Models\Periode;
use App\Models\Keuangan;
use App\Models\Pengurus;
use App\Models\DokumenUkm;
use App\Models\Inventaris;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\DokumenEvent;
use Illuminate\Http\Request;
use App\Models\PrestasiAnggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class SesiController extends Controller
{

    public function login()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diiisi',
            'password.required' => 'password wajib diiisi'
        ]);

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infoLogin)) {
            if (Auth::user()->role == 'PengurusInti') {
                return redirect('/dashboard');
            }
            return redirect('/dashboard');
        } else {
            return redirect('/login')->withErrors('Email dan Password tidak sesuai !')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function resetPassword(Request $request)
    {
        // Ambil pengguna yang sedang login
        $user = User::find(Auth::id());

        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ], [
            'current_password.required' => 'Password lama wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password baru harus lebih dari 8 karakter',
            'confirm_password.required' => 'Konfirmasi password wajib diisi',
            'confirm_password.same' => 'Konfirmasi password harus sama dengan password baru'
        ]);
        

        // Verifikasi password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak cocok']);
        }

        // Update password
        $user->password = bcrypt($request->new_password);
        $user->save();

        // Redirect atau response sukses
        return redirect()->route('dashboard.profile')->with('success', 'Password berhasil diperbarui');
    }

    public function dashboard()
    {
        $user = Auth::user();

        // Mengambil periode pengguna saat ini
        $currentPeriodeId = $user->id_periode;

        // Menghitung data berdasarkan periode pengguna
        $periode = Periode::count();
        $pengurus = User::where('id_periode', $currentPeriodeId)->count();
        $suratmasuk = SuratMasuk::where('id_periode', $currentPeriodeId)->count();
        $suratkeluar = SuratKeluar::where('id_periode', $currentPeriodeId)->count();
        $dokumenukm = DokumenUkm::count() * 2;

        // Hitung jumlah dokumen berdasarkan keberadaan data di kolom proposal, lpj, dan lpjk
        $totalProposal = DokumenEvent::where('id_periode', $currentPeriodeId)
            ->whereNotNull('proposal')
            ->count();
        $totalLpj = DokumenEvent::where('id_periode', $currentPeriodeId)
            ->whereNotNull('lpj')
            ->count();
        $totalLpjk = DokumenEvent::where('id_periode', $currentPeriodeId)
            ->whereNotNull('lpjk')
            ->count();
        // Hitung total dokumen event (hanya hitung sekali untuk lpj dan lpjk)
        $dokumenevent = DokumenEvent::where('id_periode', $currentPeriodeId)
            ->where(function ($query) {
                $query->whereNotNull('proposal')
                    ->orWhereNotNull('lpj')
                    ->orWhereNotNull('lpjk');
            })
            ->count();

        $anggota = Anggota::where('id_periode', $currentPeriodeId)->count();
        $prestasi = PrestasiAnggota::whereHas('anggota', function ($query) use ($currentPeriodeId) {
            $query->where('id_periode', $currentPeriodeId);
        })->count();

        // Hitung total pemasukan dan pengeluaran untuk periode tertentu
        $totalPemasukan = Keuangan::where('id_periode', $currentPeriodeId)->sum('pemasukan');
        $totalPengeluaran = Keuangan::where('id_periode', $currentPeriodeId)->sum('pengeluaran');
        // Hitung saldo akhir
        $keuangan = $totalPemasukan - $totalPengeluaran;

        $dokumenevent = $totalProposal + $totalLpj + $totalLpjk;
        $inventaris = Inventaris::count();
        return view('dashboard', compact(
            'user',
            'periode',
            'pengurus',
            'suratmasuk',
            'suratkeluar',
            'dokumenukm',
            'dokumenevent',
            'anggota',
            'prestasi',
            'inventaris',
            'keuangan'
        ));
    }

    public function dashboardProfile()
    {
        $user = Auth::user();
        return view('dashboard-profile', compact('user'));
    }
}
