@if ( $company )
    @if( $account == 'active' )
        <script type="application/ld+json">
            {
            "@context": "http://schema.org",
            "@type": "WebSite",
              "name": "{{ $company->companyName }}",
              "url": "https://{{ $company->url }}"
            }
        </script>
    @endif
@endif
