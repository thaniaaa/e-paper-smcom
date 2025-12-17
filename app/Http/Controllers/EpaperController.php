<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Epaper;
use Illuminate\Support\Facades\Storage;

class EpaperController extends Controller
{
    /**
     * USER: daftar e-paper (hanya yang aktif)
     */
    public function index()
    {
        // hanya tampilkan e-paper yang aktif
        $epapers = Epaper::where('is_active', 1)
            ->orderByDesc('created_at')
            ->get();

        return view('epapers.index', compact('epapers'));
    }

    /**
     * ADMIN: form upload e-paper
     */
    public function create()
    {
        $this->ensureAdmin();

        return view('epapers.create');
    }

    /**
     * ADMIN: simpan e-paper baru
     */
    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|file|mimes:pdf|max:10240', // max ~10MB
        ]);

        $path = $request->file('file')->store('epapers', 'public');

        Epaper::create([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path'   => $path,
            // default: aktif saat baru dibuat
            'is_active'   => 1,
        ]);

        return redirect()
            ->route('epapers.manage')
            ->with('success', 'E-paper berhasil diupload.');
    }

    /**
     * USER: baca e-paper (hanya file + data)
     * (aksesnya sendiri sudah dijaga middleware subscription)
     */
    public function show(Epaper $epaper)
    {
        // kalau e-paper non-aktif, anggap tidak ada
    if (! $epaper->is_active) {
        abort(404);
    }

    $fileUrl = Storage::url($epaper->file_path);

    return view('epapers.show', [
        'epaper'  => $epaper,
        'fileUrl' => $fileUrl,
    ]);
    }

    /**
     * Helper: pastikan yang akses admin
     */
    private function ensureAdmin()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak punya akses.');
        }
    }

    // =======================
    //   ADMIN CRUD
    // =======================

    /**
     * ADMIN: daftar semua e-paper (aktif & nonaktif)
     */
    public function manage()
    {
        $this->ensureAdmin();

        $epapers = Epaper::orderByDesc('created_at')->get();

        return view('epapers.manage', compact('epapers'));
    }

    /**
     * ADMIN: form edit e-paper
     */
    public function edit(Epaper $epaper)
    {
        $this->ensureAdmin();

        return view('epapers.edit', compact('epaper'));
    }

    /**
     * ADMIN: update e-paper
     */
    public function update(Request $request, Epaper $epaper)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'nullable|file|mimes:pdf|max:5120', // max ~5MB
        ]);

        $epaper->title       = $validated['title'];
        $epaper->description = $validated['description'] ?? $epaper->description;

        // ambil status dari checkbox (kalau tidak dicentang = 0)
        $epaper->is_active = $request->has('is_active') ? 1 : 0;

        // kalau admin upload file baru, ganti file lama
        if ($request->hasFile('file')) {
            if ($epaper->file_path && Storage::disk('public')->exists($epaper->file_path)) {
                Storage::disk('public')->delete($epaper->file_path);
            }

            $path = $request->file('file')->store('epapers', 'public');
            $epaper->file_path = $path;
        }

        $epaper->save();

        return redirect()
            ->route('epapers.manage')
            ->with('success', 'E-paper berhasil diperbarui.');
    }

    /**
     * ADMIN: hapus e-paper
     */
    public function destroy(Epaper $epaper)
    {
        $this->ensureAdmin();

        if ($epaper->file_path && Storage::disk('public')->exists($epaper->file_path)) {
            Storage::disk('public')->delete($epaper->file_path);
        }

        $epaper->delete();

        return redirect()
            ->route('epapers.manage')
            ->with('success', 'E-paper berhasil dihapus.');
    }
}
