<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenEvent;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DokumenEventController extends Controller
{
    public function index()
    {
        $dokumen_kegiatan = DokumenEvent::paginate(10);
        return view('dokumen_kegiatan.index', compact('dokumen_kegiatan'));
    }

    public function create()
    {
        $periode = Periode::all();
        return view('dokumen_kegiatan.create', compact('periode'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'periode' => 'required|exists:periode,id',
            'nama_kegiatan' => 'required|string|max:255',
            'proposal' => 'nullable|file|mimes:pdf|max:2048',
            'lpj' => 'nullable|file|mimes:pdf|max:2048',
            'lpjk' => 'nullable|file|mimes:pdf|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'required|in:Sedang Proses,Selesai,Ditunda,Dibatalkan',
        ], [
            'periode.required' => 'Kolom periode harus diisi.',
            'periode.exists' => 'Periode tidak valid.',
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi.',
            'nama_kegiatan.max' => 'Nama kegiatan maksimal 255 karakter.',
            'proposal.mimes' => 'Proposal harus berupa file PDF.',
            'proposal.max' => 'Ukuran file proposal maksimal 2MB.',
            'lpj.mimes' => 'LPJ harus berupa file PDF.',
            'lpj.max' => 'Ukuran file LPJ maksimal 2MB.',
            'lpjk.mimes' => 'LPJK harus berupa file PDF.',
            'lpjk.max' => 'Ukuran file LPJK maksimal 2MB.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_mulai.required' => 'Tanggal mulai harus Harus Diisi.',
            'tanggal_selesai.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'tanggal_selesai.required' => 'Tanggal selesai harus Diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            'keterangan.required' => 'Keterangan harus diisi.',
            'keterangan.in' => 'Keterangan tidak valid.',
        ]);



        if ($request->hasFile('proposal')) {
            $originalProposalName = $request->file('proposal')->getClientOriginalName();
            $proposalNameWithoutExtension = pathinfo($originalProposalName, PATHINFO_FILENAME);
            $formattedProposalName = str_replace(' ', '_', $proposalNameWithoutExtension);
            $proposalFileName = 'proposal-' . $formattedProposalName . '-' . uniqid() . '.pdf';
            $request->file('proposal')->move(public_path('dokumen/kegiatan/proposal/'), $proposalFileName);
        } else {
            $proposalFileName = null;
        }

        if ($request->hasFile('lpj')) {
            $originalLpjName = $request->file('lpj')->getClientOriginalName();
            $lpjNameWithoutExtension = pathinfo($originalLpjName, PATHINFO_FILENAME);
            $formattedLpjName = str_replace(' ', '_', $lpjNameWithoutExtension);
            $lpjFileName = 'lpj-' . $formattedLpjName . '-' . uniqid() . '.pdf';
            $request->file('lpj')->move(public_path('dokumen/kegiatan/lpj/'), $lpjFileName);
        } else {
            $lpjFileName = null;
        }

        if ($request->hasFile('lpjk')) {
            $originalLpjkName = $request->file('lpjk')->getClientOriginalName();
            $lpjkNameWithoutExtension = pathinfo($originalLpjkName, PATHINFO_FILENAME);
            $formattedLpjkName = str_replace(' ', '_', $lpjkNameWithoutExtension);
            $lpjkFileName = 'lpjk-' . $formattedLpjkName . '-' . uniqid() . '.pdf';
            $request->file('lpjk')->move(public_path('dokumen/kegiatan/lpjk/'), $lpjkFileName);
        } else {
            $lpjkFileName = null;
        }


        $data = [
            'id_user' => $user->id,
            'id_periode' => $request->periode,
            'nama_kegiatan' => $request->nama_kegiatan,
            'proposal' => $proposalFileName,
            'lpj' => $lpjFileName,
            'lpjk' => $lpjkFileName,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan' => $request->keterangan
        ];

        DokumenEvent::create($data);
        return redirect()->route('dokumen_kegiatan.index')->with('success', 'Data Kekiatan Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $dokumen_kegiatan = DokumenEvent::find($id);
        $periode = Periode::all();
        return view('dokumen_kegiatan.edit', compact('dokumen_kegiatan', 'periode'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $dokumen_kegiatan = DokumenEvent::find($id);
        $request->validate([
            'periode' => 'required|exists:periode,id',
            'nama_kegiatan' => 'required|string|max:255',
            'proposal' => 'nullable|file|mimes:pdf|max:2048',
            'lpj' => 'nullable|file|mimes:pdf|max:2048',
            'lpjk' => 'nullable|file|mimes:pdf|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'required|in:Sedang Proses,Selesai,Ditunda,Dibatalkan',
        ], [
            'periode.required' => 'Kolom periode harus diisi.',
            'periode.exists' => 'Periode tidak valid.',
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi.',
            'nama_kegiatan.max' => 'Nama kegiatan maksimal 255 karakter.',
            'proposal.mimes' => 'Proposal harus berupa file PDF.',
            'proposal.max' => 'Ukuran file proposal maksimal 2MB.',
            'lpj.mimes' => 'LPJ harus berupa file PDF.',
            'lpj.max' => 'Ukuran file LPJ maksimal 2MB.',
            'lpjk.mimes' => 'LPJK harus berupa file PDF.',
            'lpjk.max' => 'Ukuran file LPJK maksimal 2MB.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_mulai.required' => 'Tanggal mulai harus Harus Diisi.',
            'tanggal_selesai.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'tanggal_selesai.required' => 'Tanggal selesai harus Diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            'keterangan.required' => 'Keterangan harus diisi.',
            'keterangan.in' => 'Keterangan tidak valid.',
        ]);

        // Proses file proposal
        if ($request->hasFile('proposal')) {
            if ($dokumen_kegiatan->proposal && file_exists(public_path('dokumen/kegiatan/proposal/' . $dokumen_kegiatan->proposal))) {
                unlink(public_path('dokumen/kegiatan/proposal/' . $dokumen_kegiatan->proposal));
            }
            $originalProposalName = $request->file('proposal')->getClientOriginalName();
            $proposalNameWithoutExtension = pathinfo($originalProposalName, PATHINFO_FILENAME);
            $formattedProposalName = str_replace(' ', '_', $proposalNameWithoutExtension);
            $proposalFileName = 'proposal-' . $formattedProposalName . '-' . uniqid() . '.pdf';
            $request->file('proposal')->move(public_path('dokumen/kegiatan/proposal/'), $proposalFileName);
        } else {
            $proposalFileName = $dokumen_kegiatan->proposal;
        }

        // Proses file LPJ
        if ($request->hasFile('lpj')) {
            if ($dokumen_kegiatan->lpj && file_exists(public_path('dokumen/kegiatan/lpj/' . $dokumen_kegiatan->lpj))) {
                unlink(public_path('dokumen/kegiatan/lpj/' . $dokumen_kegiatan->lpj));
            }
            $originalLpjName = $request->file('lpj')->getClientOriginalName();
            $lpjNameWithoutExtension = pathinfo($originalLpjName, PATHINFO_FILENAME);
            $formattedLpjName = str_replace(' ', '_', $lpjNameWithoutExtension);
            $lpjFileName = 'lpj-' . $formattedLpjName . '-' . uniqid() . '.pdf';
            $request->file('lpj')->move(public_path('dokumen/kegiatan/lpj/'), $lpjFileName);
        } else {
            $lpjFileName = $dokumen_kegiatan->lpj;
        }

        // Proses file LPJK
        if ($request->hasFile('lpjk')) {
            if ($dokumen_kegiatan->lpjk && file_exists(public_path('dokumen/kegiatan/lpjk/' . $dokumen_kegiatan->lpjk))) {
                unlink(public_path('dokumen/kegiatan/lpjk/' . $dokumen_kegiatan->lpjk));
            }
            $originalLpjkName = $request->file('lpjk')->getClientOriginalName();
            $lpjkNameWithoutExtension = pathinfo($originalLpjkName, PATHINFO_FILENAME);
            $formattedLpjkName = str_replace(' ', '_', $lpjkNameWithoutExtension);
            $lpjkFileName = 'lpjk-' . $formattedLpjkName . '-' . uniqid() . '.pdf';
            $request->file('lpjk')->move(public_path('dokumen/kegiatan/lpjk/'), $lpjkFileName);
        } else {
            $lpjkFileName = $dokumen_kegiatan->lpjk;
        }

        $data = [
            'id_user' => $user->id,
            'id_periode' => $request->periode,
            'nama_kegiatan' => $request->nama_kegiatan,
            'proposal' => $proposalFileName,
            'lpj' => $lpjFileName,
            'lpjk' => $lpjkFileName,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan' => $request->keterangan
        ];

        $dokumen_kegiatan->update($data);
        return redirect()->route('dokumen_kegiatan.index')->with('success', ' Dokumen Kegiatan Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $dokumen_kegiatan = DokumenEvent::find($id);
        // Hapus file proposal jika ada
        if ($dokumen_kegiatan->proposal && file_exists(public_path('dokumen/kegiatan/proposal/' . $dokumen_kegiatan->proposal))) {
            unlink(public_path('dokumen/kegiatan/proposal/' . $dokumen_kegiatan->proposal));
        }

        // Hapus file LPJ jika ada
        if ($dokumen_kegiatan->lpj && file_exists(public_path('dokumen/kegiatan/lpj/' . $dokumen_kegiatan->lpj))) {
            unlink(public_path('dokumen/kegiatan/lpj/' . $dokumen_kegiatan->lpj));
        }

        // Hapus file LPJK jika ada
        if ($dokumen_kegiatan->lpjk && file_exists(public_path('dokumen/kegiatan/lpjk/' . $dokumen_kegiatan->lpjk))) {
            unlink(public_path('dokumen/kegiatan/lpjk/' . $dokumen_kegiatan->lpjk));
        }

        $dokumen_kegiatan->delete();
        return redirect()->route('dokumen_kegiatan.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
