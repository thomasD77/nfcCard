@if ( $company )
    @if( $account == 'active' )
        <script type="application/ld+json">
         { "@context": "https://schema.org",
         "@type": "Organization",
         "name": "{{ $company->companyName }}",
         "url": "http://{{ $company->url }}",
         "founders": [
         {
         "@type": "Person",
         "name": "{{ $company->firstname . "/" . $company->lastname }}"
         } ],
         "address": {
         "@type": "PostalAddress",
         "streetAddress": "{{ $company->address }}",
         "addressLocality": "{{ $company->city }}",
         "postalCode": "{{ $company->zip }}",
         "addressCountry": "{{ $company->country }}"
         },
         "contactPoint": {
         "@type": "ContactPoint",
         "contactType": "customer support",
         "telephone": "[{{ $company->mobile }}]",
         "email": "{{ $company->email }}"
         },
         "sameAs": [
         "{{{ $company->facebook }}}",
         "{{{ $company->instagram }}}",
         "{{{ $company->twitter }}}",
         "{{{ $company->linkedin }}}"
         ]}
        </script>
    @endif
@endif
