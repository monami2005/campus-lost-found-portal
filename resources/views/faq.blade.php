@extends('layouts.app')

@section('title', 'Frequently Asked Questions')

@section('breadcrumb')
    <li class="breadcrumb-item active text-primary" aria-current="page">FAQ</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="text-center mb-5" data-aos="fade-up">
        <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 mb-2 rounded-pill">Need Assistance?</span>
        <h2 class="fw-bold">Frequently Asked Questions</h2>
        <p class="text-muted-custom">Find fast answers to common questions about report postings and claims verification.</p>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="accordion accordion-flush d-flex flex-column gap-3" id="faqAccordion">
                
                <div class="accordion-item glass-card border-0 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-transparent fw-bold text-primary py-4 px-4 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#faq-1">
                            <i class="fa-solid fa-circle-question me-3 fs-5"></i>Who can post items on this portal?
                        </button>
                    </h2>
                    <div id="faq-1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body px-4 pb-4 text-muted-custom">
                            Only verified students and campus staff members registered with a university email account can create and manage listings. Unauthenticated users can view listings but cannot request claims or create reports.
                        </div>
                    </div>
                </div>

                <div class="accordion-item glass-card border-0 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-transparent fw-bold text-primary py-4 px-4 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#faq-2">
                            <i class="fa-solid fa-circle-question me-3 fs-5"></i>How do I claim a found item?
                        </button>
                    </h2>
                    <div id="faq-2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body px-4 pb-4 text-muted-custom">
                            Navigate to the item listings, select the item details page, and click the "Claim Item" button. You will be prompted to enter a verification message detailing why you believe the item is yours (e.g. key details, passwords, marks). The owner or site administrators will verify and approve the claim.
                        </div>
                    </div>
                </div>

                <div class="accordion-item glass-card border-0 overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-transparent fw-bold text-primary py-4 px-4 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#faq-3">
                            <i class="fa-solid fa-circle-question me-3 fs-5"></i>What happens after a claim is approved?
                        </button>
                    </h2>
                    <div id="faq-3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body px-4 pb-4 text-muted-custom">
                            Once approved, you will receive a notification in your dashboard panel. You can then coordinate with the finder using the contact details provided to meet at a secure designated campus spot (e.g. Central Library reception) to collect your item.
                        </div>
                    </div>
                </div>

                <div class="accordion-item glass-card border-0 overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-transparent fw-bold text-primary py-4 px-4 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#faq-4">
                            <i class="fa-solid fa-circle-question me-3 fs-5"></i>Can I upload multiple photos of an item?
                        </button>
                    </h2>
                    <div id="faq-4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body px-4 pb-4 text-muted-custom">
                            Yes! Our new drag-and-drop file interface supports multiple image uploads. You can select or drag multiple images from your desktop when creating or updating listings, which will be styled in a beautiful details carousel.
                        </div>
                    </div>
                </div>

                <div class="accordion-item glass-card border-0 overflow-hidden" data-aos="fade-up" data-aos-delay="500">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-transparent fw-bold text-primary py-4 px-4 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#faq-5">
                            <i class="fa-solid fa-circle-question me-3 fs-5"></i>How do I reset my password?
                        </button>
                    </h2>
                    <div id="faq-5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body px-4 pb-4 text-muted-custom">
                            If you are logged out, click "Forgot Password" on the login page and fill in your registered email to receive a password reset connection link. If you are logged in, go to "Profile Settings" to update your password securely.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
