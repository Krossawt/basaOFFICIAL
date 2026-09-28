{{-- Topbar breadcrumb injected via Filament render hook panels::topbar.start --}}
@php
    $route = request()->route()?->getName() ?? '';
    $map = [
        'filament.admin.pages.dashboard'       => 'Dashboard',
        'filament.admin.pages.microservices'   => 'Microservices',
        'filament.admin.pages.roles'           => 'Roles',
        'filament.admin.pages.permissions'     => 'Permissions',
        'filament.admin.pages.users'           => 'Users',
        'filament.admin.pages.custom-dropdown' => 'Custom Dropdown',
        'filament.admin.pages.configure'       => 'Configure',
    ];
    $page = $map[$route] ?? null;
@endphp

@if ($page)
    <nav class="basa-topbar-breadcrumb" aria-label="Breadcrumb">
        <span class="basa-bc-root">BASA</span>
        <span class="basa-bc-sep" aria-hidden="true">&rsaquo;</span>
        <span class="basa-bc-current">{{ $page }}</span>
    </nav>
@endif
