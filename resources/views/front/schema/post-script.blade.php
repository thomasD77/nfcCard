@if( $post )
    @if( $account == 'active' )
        <script type="application/ld+json">
            { "@context": "https://schema.org",
             "@type": "BlogPosting",
             "headline": "{{ $post->title }}",
             "alternativeHeadline": "{{ $post->alternativeTitle }}",
             "editor": "{{ $company->companyName }}",
             "genre": "{{ $post->postcategory->name }}",
             "keywords": "{{ $post->keywords }}",
             "wordcount": "{{ $post->wordCount }}",
             "publisher": "{{ $company->companyName }}",
             "url": "{{ $post->url }}",
             "datePublished": "{{ $post->book }}",
             "dateCreated": "{{ $post->created_at }}",
             "dateModified": "{{ $post->updated_at }}",
             "description": "{{ $post->description }}",
             "articleBody": "{{ $post->body }}",
               "author": {
                "@type": "Person",
                "name": "{{ $company->companyName }}"
              }
             }
        </script>
    @endif
@endif
