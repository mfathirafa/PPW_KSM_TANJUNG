@extends('layouts.admin')

@section('title', 'Pengaturan - KSM Tanjung')

@section('content')

<div class="card shadow-sm page-header">
    <h4 class="fw-bold mb-0 text-center">Pengaturan</h4>
</div>

<div class="settings-container">
    <form>
        <h5 class="fw-bold mb-3">Notifikasi</h5>

        <div class="setting-item d-flex justify-content-between align-items-center">
            <label class="fw-bold">WhatsApp Notification</label>
            <input type="checkbox" class="form-check-input" checked>
        </div>

        <hr>

        <h5 class="fw-bold mb-3">Keamanan</h5>

        <button type="button" class="btn btn-light w-100 mb-3">
            Regenerate API Key
        </button>
    </form>
</div>

@endsection