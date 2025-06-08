@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1 class="mb-4">Terms of Service</h1>
            
            <div class="terms-content mb-4">
                <h5 class="mb-3">1. Acceptance of Terms</h5>
                <p class="mb-3">
                    By accessing or using our social media platform, you agree to be bound by these Terms of Service. 
                    If you do not agree to these terms, please do not use our service.
                </p>
                
                <h5 class="mb-3">2. User Responsibilities</h5>
                <p class="mb-3">
                    You are responsible for all content you post and any activity that occurs under your account. 
                    You must not post content that is illegal, harmful, threatening, abusive, or violates others' rights.
                </p>
                
                <h5 class="mb-3">3. Privacy</h5>
                <p class="mb-3">
                    Your privacy is important to us. Please review our Privacy Policy to understand how we collect, 
                    use, and disclose information about you.
                </p>
                
                <h5 class="mb-3">4. Content Ownership</h5>
                <p class="mb-3">
                    You retain ownership of any content you post, but by posting it you grant us a worldwide, 
                    non-exclusive license to use, display, and distribute your content on our platform.
                </p>
                
                <h5 class="mb-3">5. Modifications</h5>
                <p class="mb-3">
                    We may modify these terms at any time. We'll notify you of significant changes, 
                    and continued use of our service constitutes acceptance of the modified terms.
                </p>
                
                <h5 class="mb-3">6. Termination</h5>
                <p class="mb-3">
                    We reserve the right to suspend or terminate your account if you violate these terms 
                    or engage in behavior that we determine to be harmful to our community.
                </p>
            </div>
            
            <p class="text-muted">
                Last updated: {{ now()->format('F j, Y') }}
            </p>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection