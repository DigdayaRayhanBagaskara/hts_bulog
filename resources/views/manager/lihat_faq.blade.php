@extends('manager.template')
@section('title', 'Lihat FAQ')

@section('content')
<div class="container-fluid">

    <div class="accordion" id="faqAccordion">
        @php $kategoriIndex = 0; @endphp
        @foreach($kategoriMasalah as $namaKategori => $subkategoris)
        <div class="card shadow mb-3">
            <a href="#collapseKategori{{ $kategoriIndex }}" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                role="button" aria-expanded="false" aria-controls="collapseKategori{{ $kategoriIndex }}">
                <h6 class="m-0 font-weight-bold text-primary">{{ $namaKategori }}</h6>
            </a>

            <div class="collapse" id="collapseKategori{{ $kategoriIndex }}" data-parent="#faqAccordion">
                <div class="card-body">
                    @php $subIndex = 0; @endphp
                    @foreach($subkategoris as $namaSubkategori => $faqs)
                        <div class="mb-3">
                            <a href="#collapseSub{{ $kategoriIndex }}_{{ $subIndex }}" data-toggle="collapse" class="text-dark font-weight-bold">
                                &gt; {{ $namaSubkategori }}
                            </a>
                            <div class="collapse mt-2" id="collapseSub{{ $kategoriIndex }}_{{ $subIndex }}">
                                <ul class="ml-3">
                                    @php $faqIndex = 0; @endphp
                                    @foreach($faqs as $faq)
                                        <li class="mb-2">
                                            <a href="#collapseFaq{{ $kategoriIndex }}_{{ $subIndex }}_{{ $faqIndex }}" data-toggle="collapse">
                                                &gt; <strong>{{ $faq->judul }}</strong>
                                            </a>
                                            <div class="collapse mt-1 ml-3" id="collapseFaq{{ $kategoriIndex }}_{{ $subIndex }}_{{ $faqIndex }}">
                                                <span class="text-muted">{{ $faq->deskripsi }}</span>
                                            </div>
                                        </li>
                                        @php $faqIndex++; @endphp
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @php $subIndex++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
        @php $kategoriIndex++; @endphp
        @endforeach
    </div>
</div>
@endsection
