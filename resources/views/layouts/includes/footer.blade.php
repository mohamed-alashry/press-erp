<footer class="app-footer">
    <div>
        &copy;
        <a href="https://www.namaait.com/" target="_blank" rel="noopener noreferrer" className="mx-2">
            <span style="font-size: 12px; letter-spacing: -1px">
                {{ __('messages.namaait') }}
            </span>
            <img src={{ asset($locale == 'ar' ? 'img/logo-dash-rtl.png' : 'img/logo-dash-ltr.png') }} alt="NamaIT"
                className="img-fluid mx-3 brand-img" style="width: 45px" />
        </a>
    </div>
</footer>
