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
        'filament.admin.pages.create-custom-dropdown' => 'Create Dropdown',
        'filament.admin.pages.custom-dropdown.{record}.edit' => 'Edit Dropdown',
        'filament.admin.pages.configure'       => 'Configure',
    ];
    $page = $map[$route] ?? null;
@endphp

@if ($page)
    <style>
        /* Keep the panel brand in the sidebar, but leave the header for navigation context. */
        .fi-topbar .fi-topbar-start > .fi-logo,
        .fi-topbar .fi-topbar-start > a:has(> .fi-logo) {
            display: none;
        }

        /* A compact visual gap on either side of each breadcrumb separator. */
        .basa-topbar-breadcrumb {
            gap: 0.75rem;
        }
    </style>

    <nav class="basa-topbar-breadcrumb" aria-label="Breadcrumb">
        <span class="basa-bc-root">BASA</span>
        <span class="basa-bc-sep" aria-hidden="true">&rsaquo;</span>
        <span class="basa-bc-current">{{ $page }}</span>
    </nav>
@endif
