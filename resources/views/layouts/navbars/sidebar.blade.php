<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('ACH') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('SEMEN PADANG HOSPITAL') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'users') class="active " @endif>
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-user"></i>
                    <p>{{ __('User') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'kamars') class="active " @endif>
                <a href="{{ route('pasien.index') }}">
                    <i class="fa fa-heart"></i>
                    <p>{{ __('Kamar') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
