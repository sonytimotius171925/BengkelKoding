<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfilePasienController extends Controller
{
    /**
     * Tampilkan form edit profil dokter.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('pasien.profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update informasi profil dokter (termasuk id_poli).
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update semua field yang divalidasi (name, email, id_poli)
        $user->fill($request->validated());

        // Reset verifikasi email jika diubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('pasien.profile.edit')->with('status', 'Profil berhasil diperbarui.');
    }

    /**
     * Hapus akun user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'Akun berhasil dihapus.');
    }
}
