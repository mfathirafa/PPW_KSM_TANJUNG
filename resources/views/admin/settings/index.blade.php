@extends('layouts.admin')

@section('title', 'Pengaturan - KSM Tanjung')

@section('content')

<div class="card shadow-sm page-header">
    <h4 class="fw-bold mb-0 text-center">Pengaturan</h4>
</div>

<div class="settings-container">
    <form>
        <h5 class="fw-bold mb-3">Notifikasi setting</h5>
        <div class="setting-item d-flex justify-content-between align-items-center">
            <div>
                <label class="form-check-label fw-bold">Whatsapp Notifikasi</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="whatsappNotif" checked>
            </div>
        </div>
        <div class="setting-item">
            <label for="notifTimeout" class="form-label fw-bold">Notifikasi timeout</label>
            <div class="input-group">
                <input type="number" class="form-control" id="notifTimeout" value="30">
                <span class="input-group-text">Sec</span>
            </div>
            <small class="form-text text-muted">Time before notification expired</small>
        </div>

        <hr class="my-4">

        <h5 class="fw-bold mb-3">Security setting</h5>
        <div class="setting-item">
             <button type="button" class="btn btn-light w-100 d-flex justify-content-between align-items-center">
                <span>Regeneret JWT Secret</span>
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
        <div class="setting-item d-flex justify-content-between align-items-center">
            <div>
                <label class="form-check-label fw-bold">Enable HTTPS Enforcement</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="httpsEnforcement" checked>
            </div>
        </div>

        <hr class="my-4">

        <h5 class="fw-bold mb-3">API Integration</h5>
        <div class="setting-item d-flex justify-content-between align-items-center">
            <div>
                <label class="form-check-label fw-bold">Midtrans</label>
                <p class="text-muted mb-0 small">Payment gateway</p>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="midtransApi" checked>
            </div>
        </div>
        <div class="setting-item">
             <div class="input-group">
                <input type="text" class="form-control" value="085676536463">
                <button class="btn btn-light" type="button"><i class="fas fa-pencil-alt"></i></button>
            </div>
        </div>
    </form>
</div>

@endsection