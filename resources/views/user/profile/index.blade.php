@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')

<div class="profile-container">
    
    <h2 class="profile-page-title">Profil Saya</h2>

    <div class="profile-card">
        
        <div class="profile-left">
            <div class="profile-avatar">F</div>
            <div class="profile-name-display">Fathi Setiawan</div>
            <div class="profile-org-display">KSM - Tanjung</div>
        </div>

        <div class="profile-right">
            <div class="profile-header-info">Informasi Pelanggan</div>

            <div class="profile-input-group">
                <label class="profile-label-small">Nama Lengkap</label>
                <input type="text" class="profile-input-field" value="Fathi Setiawan" readonly>
            </div>

            <div class="profile-input-group">
                <label class="profile-label-small">No. Whatsapp</label>
                <input type="text" class="profile-input-field" value="+62 876-0542-1234" readonly>
            </div>

            <div class="profile-input-group">
                <label class="profile-label-small">Alamat</label>
                <textarea class="profile-input-field" rows="2" readonly style="resize: none;">Jl. Tanjung Raya No. 45, RT 03/RW 02</textarea>
            </div>

            <div class="profile-input-group">
                <label class="profile-label-small">Role</label>
                <input type="text" class="profile-input-field" value="Pelanggan" readonly>
            </div>
        </div>
    </div>

    <a href="#" class="btn-logout">Keluar</a>

</div>

@endsection